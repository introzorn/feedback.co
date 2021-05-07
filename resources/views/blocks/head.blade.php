<div class="headcontent2" >
    <div class="mainf_platform"></div>


</div>


<div class="headcontent" >
<h2>Сервис Обратной связи</h2>
@if (Auth::check())
    @if (Auth::user()->role==0)
        <h5>Написать сообщение</h5>
    @else
         <h5>Панель Менеджмента сообщений</h5>
    @endif

<a   class="logaut btn btn-primary btn-lg" href="{{route('logout')}}">Выйти</a>

@else
 <h5>Зарегистрируйтесь или автаризуйтесь</h5>
@endif


</div>
