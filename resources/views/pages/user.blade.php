@extends('html')
@section('mtitle')Обратная связь - Написать Сообщение@endsection

@section('content')

<center>
<div class="pagepage">
    <form id="msgform">
        <h3>Написать менеджеру</h3><br>
        Тема сообщения: <input  class="form-control"  type="text" name="title" id="title">
        Tекст сообщения:<br>
        <textarea name="msg"   class="form-control"  id="msg"  style=" height:200px"></textarea>


        прикрепить файл:<input  class="form-control"  type="file" name="file" id="file">
        <center><br>



@if ($canWrite)
     <input type="button" value="Отправить" class="form-control" onclick="postMSG()">

@else
    <span>Вы не можете больше отправлять сообщения сегодня. <br> приходите завтра</span>

@endif





        </center>
        <span id="msgerror" style="color:red">&nbsp;</span>
    </form>
    <div id="msgOk" style="display:block"></div>
</div>
</center>
<script>

function postMSG(){
    title=$("#title").val();
    msg=$("#msg").val();
    file=$("#file").prop('files')[0];

    data=new FormData;
    data.append('title',title);
    data.append('msg',msg);
    data.append('ufile', file);
    head={'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}

    aPost("{{route('addmsg')}}",data,head,function(data){
        if(data.state=='redirect'){
            location.href=data.url;

            return;
        }

        if(data.state=='msgok'){
            $('#msgform').css("display","none");
            $('#msgOk').css("display","block").html(`

            Ваше сообщение: "`+$("#title").val()+`" успешно отправленно.<br>
             Ожидайте ответного сообщения на вашу электронную почту

            `);
            $('.pagepage')css('margin-bottom','300px')
            return;
        }
        if(data.state=='msgerror'){
            $("#msgerror").css("display","block").html(data.errors);

            return;
        }

        $("#msgerror").css("display","block").html('Ошибка отправки сообщения');
    })

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


 </script>

@endsection
