@extends('html')
@section('mtitle')Обратная связь - Авторизуйтесь@endsection

@section('content')

<div class="authForm">
    <form class="loginForm" style="display:none">
        <h4 class="center">Авторизация</h4>
        <span>Введите логин</span><br>
        <input type="text" name="login" id="login"><br>
        <span>Введите пароль</span><br>
        <input type="password" name="password" id="password"><br><br>
        <span class="center">
            <center><input type="button" value="Авторизоваться"></center>

        </span>
        <span class="loginError"></span>
    </form>

    <form class="RegForm" style="display:block">
        <h4 class="center">Регистрация</h4>
        <span>Введите логин</span><br>
        <input type="text" name="login" id="rlogin"><br>
        <span>Введите Электронную почту</span><br>
        <input type="text" name="mail" id="rmail"><br>
        <span>Введите пароль</span><br>
        <input type="password" name="password1" id="password1"><br>
        <span>Введите пароль еще раз</span><br>
        <input type="password" name="password2" id="password2"><br>
        <br>

        <span class="center">
            <center><input type="button" onclick="Regist()" value="Зарегистрироваться"></center>

        </span>
        <span class="loginError"></span>
    </form>


</div>
<script>
function Login(){
    login=encodeURI($("#login").val());
    password=encodeURI($("#password").val());
    postparam="login="+login+"&password="+password;
    head={'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    aPost("{{ route('login') }}",postparam,head,function(data){


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


</script>
@endsection
