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
@endforeach
@endsection
