@extends('layouts.login')

@section('content')
<form action="/search" method="post">
  @csrf<!--formタグの中に入れる-->
<input type="text" name="search" placeholder="ユーザー名" >
<input type="submit" value="検索">
</form>
@foreach($all_users as $user)
 <img src="/images/{{$user->image}}">
 <p>{{$user->username}}</p>
 @if($followings->contains('follow_id',$user->id))
 <form action="/follow/delete" method="post">
  @csrf
  <input type="hidden" name="id" value="{{$user->id}}">
  <input type="submit" value="フォローを外す">
</form>
@else
 <!--aタグはGET送信になるためformタグを使用-->
 <form action="/follow/create" method="post">
  @csrf
  <!--▼フォローする人のIDをとばす-->
  <input type="hidden" name="id" value="{{$user->id}}">
  <input type="submit" value="フォローする">
</form>
@endif
@endforeach
@endsection
