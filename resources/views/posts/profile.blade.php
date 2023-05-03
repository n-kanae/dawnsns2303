@extends('layouts.login')

@section('content')
<div id="profile">
<form action="/profile/update" method="post"  enctype="multipart/form-data">
  @csrf
  <label for="username">UserName</label>
  <input type="text" name="username" id="username" value="{{$user->username}}">

  <label for="mail">MailAdress</label>
  <input type="mail" name="mail" id="mail" value="{{$user->mail}}">

  <label for="password">Password</label>
  <input type="password" name="password" id="password" value="<?php for ($num = 0; $num < $session; $num++){
            echo $num;
        };?>">

  <label for="new-password">new Password</label>
  <input type="password" name="new-password" id="new-password">

  <label for="bio">Bio</label>
  <input type="text" name="bio" id="bio" value="{{$user->bio}}">

  <label for="image">Icon Image</label>
  <input type="file" name="image" id="image">

  <input type="submit" value="更新">
</form>
</div>
@endsection
