@extends('html')
@section('mtitle')Обратная связь - Написать Сообщение@endsection

@section('content')


<div class="authForm">
    <form id="msgform">
        <h3>Написать менеджеру</h3><br>
        Тема сообщения: <input type="text" name="title" id="title"><br>
        Tекст сообщения:<br>
        <textarea name="msg" id="msg" cols="30" rows="10" style="width:500px; height:200px"></textarea><br>


        прикрепить файл:<input type="file" name="file" id="file"><br>
        <center><br>



@if ($canWrite)
     <input type="button" value="Отправить" onclick="postMSG()">

@else
    <span>Вы не можете больше отправлять сообщения сегодня. <br> приходите завтра</span>

@endif





        </center>
        <span id="msgerror" style="display:none"></span>
    </form>
    <div id="msgOk" style="display:block"></div>
</div>

<script>

function postMSG(){
    title=$("#title").val();
    msg=$("#msg").val();
    file=$("#file").prop('files')[0];

    data=new FormData;
    data.append('title',title);
    data.append('msg',msg);
    data.append('file', file);
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
