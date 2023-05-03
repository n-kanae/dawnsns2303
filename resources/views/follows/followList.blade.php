@extends('layouts.login')

@section('content')
<div id="follow_show">
@foreach($follow_users as $follow_user)
 <a href="/user-profile/{{$follow_user->id}}"><img src="/storage/{{$follow_user->image}}"></a>
  @endforeach
</div>

<!-- ▼index.bladeから引用 -->
<table id="post-show">
 @foreach ($posts as $post)
   <tr>
     <!-- <td><img src="/images/{{$user->image}}"></td>
       <td>{{ $user -> username }}</td> -->
       <td>{{ $post -> post }}</td>
       <td>{{ $post -> created_at }}</td>
   </tr>
  @endforeach
</table>
@endsection
