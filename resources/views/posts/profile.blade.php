@extends('layouts.login')

@section('content')
<div id="profile">
<form action="/profile/update" method="post"  enctype="multipart/form-data">
  @csrf
  <label for="username">UserName</label>
  <input type="text" name="username" id="username" value="{{$user->username}}">
@if($errors->has('name'))
 <p>{{$errors->first('name')}}</p>
@endif

  <label for="mail">MailAdress</label>
  <input type="mail" name="mail" id="mail" value="{{$user->mail}}">
@if($errors->has('mail'))
 <p>{{$errors->first('mail')}}</p>
@endif

  <label for="password">Password</label>
  <input type="password" name="password" id="password" value="<?php for ($num = 0; $num < $session; $num++){
            echo $num;
        };?>">

  <label for="new-password">new Password</label>
  <input type="password" name="new-password" id="new-password">
  @if($errors->has('new-password'))
 <p>{{$errors->first('new-password')}}</p>
@endif

  <label for="bio">Bio</label>
  <input type="text" name="bio" id="bio" value="{{$user->bio}}">
  @if($errors->has('bio'))
 <p>{{$errors->first('bio')}}</p>
@endif

  <label for="image">Icon Image</label>
  <input type="file" name="image" id="image">

  <input type="submit" value="更新">
</form>
</div>
@endsection
