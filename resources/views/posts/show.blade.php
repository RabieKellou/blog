@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-8">
        <h1>{{ $post->title }}</h1>

        <h2>{{$post->title}}</h2>
        @if($post->image)
             <img src={{$post->image->url()}} alt="" class="my-2 img-fluid rounded">
        @endif
        <p>{{ $post->content }}</p>
        <x-tags :tags="$post->tags"></x-tags>
        <em>{{$post->updated_at->diffForHumans()}}</em>
        <p>Status :
            @if($post->active)
            Enabled
            @else
            Disabled

            @endif
        </p>
        <h2>Comments</h2>
        <x-comment-form :action="route('posts.comments.store',['post' => $post->id])"></x-comment-form>
        <x-comment-list :comments="$post->comments"></x-comment-list>
    </div>
    <div class="col-4">
        @include('posts.sidebar')
    </div>
</div>

    @endsection
