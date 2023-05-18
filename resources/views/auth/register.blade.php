@extends('layouts.logout')

@section('content')

{!! Form::open() !!}

<div class="container">
<h2>新規ユーザー登録</h2>

{{ Form::label('username','UserName') }}
{{ Form::text('username',null,['class' => 'input','placeholder' => 'dawntown']) }}
@if($errors->has('name'))
 <p>{{$errors->first('username')}}</p>
@endif

{{ Form::label('mail','MailAdress') }}
{{ Form::email('mail',null,['class' => 'input','placeholder' => 'dawn@dawn.jp']) }}
@if($errors->has('mail'))
 <p>{{$errors->first('mail')}}</p>
@endif

{{ Form::label('password','Password') }}
{{ Form::password('password',null,['class' => 'input']) }}
@if($errors->has('password'))
 <p>{{$errors->first('password')}}</p>
@endif

{{ Form::label('password-confirm','Password confirm') }}
{{ Form::password('password-confirm',null,['class' => 'input']) }}
@if($errors->has('password-confirm'))
 <p>{{$errors->first('password-confirm')}}</p>
@endif

{!! Form::submit('REGISTER') !!}

<p><a href="/login">ログイン画面へ戻る</a></p>

{!! Form::close() !!}
</div>

@endsection
