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
        @include('comments.form',['id'=>$post->id])
        @forelse ($post->comments as $comment)
            <p>{{ $comment->content }}</p>
            <p class="text-muted">
                <x-updated :date="$comment->created_at" :name="$comment->user->name"></x-updated>

            </p>
        @empty
            <p>No comments yet</p>
        @endforelse
    </div>
    <div class="col-4">
        @include('posts.sidebar')
    </div>
</div>

    @endsection
