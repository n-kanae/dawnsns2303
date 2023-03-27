@extends('layouts.logout')

@section('content')

{!! Form::open() !!}

<div class="container">
<h2>新規ユーザー登録</h2>

{{ Form::label('username','ユーザー名') }}
{{ Form::text('username',null,['class' => 'input','placeholder' => 'dawntown']) }}

{{ Form::label('mail','メールアドレス') }}
{{ Form::email('mail',null,['class' => 'input','placeholder' => 'dawn@dawn.jp']) }}

{{ Form::label('password','パスワード') }}
{{ Form::password('password',null,['class' => 'input']) }}

{{ Form::label('password-confirm','パスワード確認') }}
{{ Form::password('password-confirm',null,['class' => 'input']) }}

{!! Form::submit('登録') !!}

<p><a href="/login">ログイン画面へ戻る</a></p>

{!! Form::close() !!}
</div>

@endsection
