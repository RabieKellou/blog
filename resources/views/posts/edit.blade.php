@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('posts.update',['post'=>$post->id]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <h1>Edit Post</h1>

        @include('posts.form')

        <button class="btn btn-block btn-warning" type="submit">Update post</button>
    </form>
@endsection
