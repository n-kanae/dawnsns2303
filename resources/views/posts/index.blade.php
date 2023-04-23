@extends('layouts.login')

@section('content')
{!! Form::open(['url' => '/post']) !!}
<img src="images/dawn.png">
        <div class="form-group">
            {!! Form::input('text', 'newPost', null, ['required', 'class' => 'form-control', 'placeholder' => '何をつぶやこうか…？']) !!}
        </div>
        <button type="submit" class=""><img src="images/post.png"></button>
        {!! Form::close() !!}

@endsection
