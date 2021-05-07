@extends('html')
@section('mtitle')Обратная связь - Авторизуйтесь@endsection

@section('content')

<div class="authForm" >
    <div >
        <span name="" id="" onclick="showpg(1)" class="logbtn btn btn-primary" href="#" role="button">Войти</span>
        <span name="" id=""  onclick="showpg(2)" class="logbtn btn btn-primary" href="#" role="button">Зарегистрироваться</span>
    <form class="loginForm formbox" id="logForm" style="display:block">
        <h4 class="center">Авторизация</h4>
        <span>Введите логин</span><br>
        <input type="text"  class="form-control"  name="login" id="login">
        <span>Введите пароль</span><br>
        <input type="password"  class="form-control"  name="password" id="password"><br>
        <span class="center">
            <center><input type="button" style="font-size:12pt" onclick="Login()" value="Авторизоваться"></center>

        </span>

       <span class="" style="background-color:white; color:red;" id="logerror">&nbsp;
        </span>
    </form>

    <form class="RegForm formbox" id="RegForm" style="display:none">
        <h4 class="center">Регистрация</h4>
        <span>Введите логин</span><br>


        <input type="text"  class="form-control"  name="login" id="rlogin">
        <span>Введите Электронную почту</span><br>
        <input type="text"  class="form-control"  name="mail" id="mail">
        <span>Введите пароль</span><br>
        <input type="password" class="form-control"  name="password1" id="password1">
        <span>Введите пароль еще раз</span><br>
        <input type="password" class="form-control"  name="password2" id="password2">
        <br>


        <span class="center">
            <center><input type="button"  style="font-size:12pt" onclick="Regist()" value="Зарегистрироваться"></center>

        </span>
        <span class="" style="background-color:white; color:red; " id="regerror">&nbsp;
        </span>

    </form>

    </div>
</div>
<div style=" height:500px"></div>
<script>
function Login(){
    login=encodeURI($("#login").val());
    password=encodeURI($("#password").val());
    postparam="login="+login+"&password="+password;
    head={'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    aPost("{{ route('login') }}",postparam,head,function(data){
        if(data.state=='logok'){location.href=data.url; return;}
        if(data.state=='logerror'){
            $("#logerror").css("display","block").html(data.errors);
            return;
        }
        $("#logerror").css("display","block").html("Ошибка Авторизации");
    })
}

function Regist(){

    login=encodeURI($("#rlogin").val());
    mail=encodeURI($("#mail").val());
    password1=encodeURI($("#password1").val());
    password2=encodeURI($("#password2").val());
    postparam="login="+login+"&mail="+mail+"&password1="+password1+"&password2="+password2;
    head={'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    aPost("{{ route('reg') }}",postparam,head,function(data){
        if(data.state=='regok'){location.href=data.url; return;}
        if(data.state=='regerror'){
            $("#regerror").css("display","block").html(data.errors);
            return;
        }
        $("#regerror").css("display","block").html("Ошибка регистрации");
    })
}


function aPost(href,datas,header,callback){
   $.ajax({
 	 type: "POST",
	 url: href,
	 data: datas,
	 async:true,
     headers:header,
	 error: callback,
	 success: callback
	 });
 }

function showpg(pg){
    if(pg==1){
        $('#logForm').css('display', 'block');
        $('#RegForm').css('display', 'none');
        }else{
        $('#logForm').css('display', 'none');
        $('#RegForm').css({'display': 'block'});


    }
}


</script>
@endsection
