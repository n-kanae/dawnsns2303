@extends('layouts.login')

@section('content')
<div id="post-form">
        {!! Form::open(['url' => '/post']) !!}
       <img src="/storage/{{$user->image}}">
        <div class="form-group">
            {!! Form::input('text', 'newPost', null, ['required', 'class' => 'form-control', 'placeholder' => '何をつぶやこうか…？']) !!}
        </div>
        @if($errors->has('newPost'))
        <p>{{$errors->first('newPost')}}</p>
        @endif
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

       @if($post->user_id ===Auth::id())
       <td><a href="/post/{{ $post->id }}/update-form"><img src="/images/edit.png"></a></td>
       <td class="trash"><a href="/post/{{ $post->id }}/delete-form"><img src="/images/trash.png" onmouseover="this.src='/images/trash_h.png'" onmouseout="this.src='/images/trash.png'" /></a></td>
       @else
       <td></td>
       <td></td>
       @endif
   </tr>
  @endforeach
</table>
@endsection
