@extends('html')
@section('mtitle')Обратная связь - АРМ Менеджера@endsection

@section('content')

<div id="contentblock">
<!--contentblock-->

@foreach ($MSGS as $item)

    <div class="vkladka_{{$item->readed}}" style="">
        <h3>ID-{{ $item->id }} : {{ $item->user }} : {{ $item->email }} </h3>
        <h3>{{ $item->title }} </h3>
        <hr>
        {{ $item->msg}}
        <hr>
        @if ($item->file)
           прикрепленный файл : <a href="/public/uploads/{{$item->file}}">{{$item->file}}</a>
        <hr>
        @endif
        <span>
        @if ($item->readed==0)
            <div style="color:green" mid="{{ $item->id }}" onclick="ReadThis(this)">[ Отметить как прочитаное ]</div>
        @else
            <div style="color:grey" >[ Прочитанное ]</div>
        @endif
    </span>
    </div>




@endforeach



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
    data=new FormData;
    data.append('id', id);
    head={'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    aPost("{{route('readed')}}",data,head,function(data){
        if(data.state=='readok'){

            $('[mid='+data.id+']').parent().html('<div style="color:grey" >[ Прочитанное ]</div>');

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

    href=$(el).attr('href');
    d='';
    aGet(href,function(data){
        arcont=data.split('<!--contentblock-->');
        apang=data.split('<!--panginator-->');
        $('#contentblock').html(arcont[1]);
        $('#panginator').html(apang[1]);
        $(".page-link").click(function(){AjaxPanginate(this);return false;})
    });


    return false;
}

$(".page-link").click(function(){AjaxPanginate(this);return false;})

</script>
@endsection
