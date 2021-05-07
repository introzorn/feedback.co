@extends('html')
@section('mtitle')Обратная связь - АРМ Менеджера@endsection

@section('content')

<div id="contentblock">

<!--contentblock-->
 <center>
<h5 style="color:white">Сообщения пользователей</h5>
  <br>
@foreach ($MSGS as $item)

    <div class="vkladka_{{$item->readed}}" id="vkl_{{ $item->id }}" style="">
        <h6>ID-{{ $item->id }} : {{ $item->user }} : {{ $item->email }} </h6>
        <h5>Тема :{{ $item->title }} </h5>
        <hr>
        {{ $item->msg}}
        <hr>
        @if ($item->file)
           прикрепленный файл : <a href="/public/uploads/{{$item->file}}">{{$item->file}}</a>
        <hr>
        @endif
        <span>
        @if ($item->readed==0)
            <div class="btnread" mid="{{ $item->id }}" onclick="ReadThis(this)">[ Отметить как прочитаное ]</div>
        @else
            <div class="btnreaded" >[ Прочитанное ]</div>
        @endif
         </span>
          Дата сообщения: {{date("d.m.y H:i:s", strtotime( $item->created_at))}}
    </div>




@endforeach


</center>
<!--contentblock-->

</div>
<div id="panginator">
<!--panginator-->
<center>
    <div style="display:block; width:max-content">
 {{$MSGS->links()}}
    </div>
</center>
<!--panginator-->
</div>
<script>
function ReadThis(el){

    id=$(el).attr('mid');
    $(el).parent().html('<div class="btnreaded" mid="'+id+'" ><img src="/public/img/ajax-loader.gif"> загрузка...</div>');
    data=new FormData;
    data.append('id', id);
    head={'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    aPost("{{route('readed')}}",data,head,function(data){
        if(data.state=='readok'){

            $('[mid='+data.id+']').parent().html('<div class="btnreaded" >[ Прочитанное ]</div>');
            $('#vkl_'+data.id+'').removeClass().addClass('vkladka_1');
        }
    });


}

function aPost(href,datas,header,callback){
    $.ajax({
       type: "POST",
      url: href,
      data: datas,
      async:true,
      headers:header,
      processData: false,
      contentType: false,
      error: callback,
      success: callback
      });
  }
  function aGet(href,callback){
    $.ajax({
       type: "GET",
      url: href,
      async:true,
      processData: false,
      contentType: false,
      error: callback,
      success: callback
      });
  }

function AjaxPanginate(el){
    $("#contentblock").css('opacity',0);
    href=$(el).attr('href');
    d='';
    aGet(href,function(data){
        arcont=data.split('<!--contentblock-->');
        apang=data.split('<!--panginator-->');
        $('#contentblock').html(arcont[1]);
        $('#panginator').html(apang[1]);
        $(".page-link").click(function(){AjaxPanginate(this);return false;})
        $("#contentblock").css('opacity',1);
    });


    return false;
}

$(".page-link").click(function(){AjaxPanginate(this);return false;})

</script>
@endsection
