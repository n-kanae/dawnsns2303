@extends('layouts.login')

@section('content')
<div id="user-profile">
  @foreach ($profiles as $profile)
  <img src="/storage/{{$profile->image}}">
  <p>Name</p>
  <p>{{$profile->username}}</p>
  <p>Bio</p>
  <p>{{$profile->bio}}</p>
  @if($followings->contains('follow_id',$profile->id))
 <form action="/follow/delete" method="post">
  @csrf
  <input type="hidden" name="id" value="{{$profile->id}}">
  <input type="submit" value="フォローを外す">
</form>
@else
 <!--aタグはGET送信になるためformタグを使用-->
 <form action="/follow/create" method="post">
  @csrf
  <!--▼フォローする人のIDをとばす-->
  <input type="hidden" name="id" value="{{$profile->id}}">
  <input type="submit" value="フォローする">
</form>
@endif
  @endforeach
</div>
<table id="post-show">
 @foreach ($posts as $post)
   <tr>
     <td><img src="/storage/{{$post->image}}"></td>
       <td>{{ $post -> username }}</td>
       <td>{{ $post -> post }}</td>
       <td>{{ $post -> created_at }}</td>
   </tr>
  @endforeach
</table>
@endsection
