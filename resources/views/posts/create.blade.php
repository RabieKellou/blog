@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
        @csrf
        <h1>Create Post</h1>
        @include('posts.form')

        <button class="btn btn-block btn-primary" type="submit">Add post</button>
    </form>
@endsection
