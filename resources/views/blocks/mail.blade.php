<h3>Здравствуйте уважаемый менеджер сайта</h3>

Вам поступило новое сообщение : <br>

<h3>Пользователь {{ $maildata->user }}</h3>
<h3>Эл. Почта  {{ $maildata->email }}</h3>
<hr>
<h4>{{ $maildata->title }}</h4>
<hr>

{{ $maildata->msg }}

<hr>

дата: {{ $maildata->created_at] }}
<br><br>

Перейдите по ссылки в панель менеджмента: {{route('manager')}}
<br><br>
