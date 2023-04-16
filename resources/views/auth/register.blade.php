@extends('layouts.logout')

@section('content')

{!! Form::open() !!}

<div class="container">
<h2>新規ユーザー登録</h2>

{{ Form::label('username','UserName') }}
{{ Form::text('username',null,['class' => 'input','placeholder' => 'dawntown']) }}

{{ Form::label('mail','MailAdress') }}
{{ Form::email('mail',null,['class' => 'input','placeholder' => 'dawn@dawn.jp']) }}

{{ Form::label('password','Password') }}
{{ Form::password('password',null,['class' => 'input']) }}

{{ Form::label('password-confirm','Password confirm') }}
{{ Form::password('password-confirm',null,['class' => 'input']) }}

{!! Form::submit('REGISTER') !!}

<p><a href="/login">ログイン画面へ戻る</a></p>

{!! Form::close() !!}
</div>

@endsection
