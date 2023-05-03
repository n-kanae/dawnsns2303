@extends('layouts.login')

@section('content')
<div id="post-form">
        {!! Form::open(['url' => '/post']) !!}
       <img src="/storage/{{$user->image}}">
        <div class="form-group">
            {!! Form::input('text', 'newPost', null, ['required', 'class' => 'form-control', 'placeholder' => '何をつぶやこうか…？']) !!}
        </div>
        <button type="submit" class=""><img src="images/post.png"></button>
        {!! Form::close() !!}
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
