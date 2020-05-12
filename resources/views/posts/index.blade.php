@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-8">

        <div class="my-3">
            <h4>
                {{ $posts->count() }} Post(s)
            </h4>
        </div>

        <ul class="list-group">
            @forelse ($posts as $post)
            <li class="list-group-item">
                @if($post->created_at->diffInHours()<1)
                    <x-badge type="success"> New </x-badge>
                @else
                    <x-badge type="dark"> Old</x-badge>
                 @endif
                    {{-- {{dump(Storage::url($post->image->path ??null)) }} --}}

                @if($post->image)
                    <img src={{$post->image->url()}} alt="" class="my-2 img-fluid rounded">
                @endif
                <h3>
                    <a href="{{ route('posts.show',['post'=>$post->id])}}">
                        @if($post->trashed())
                        <del>
                            {{ $post->title}}
                        </del>
                        @else
                        {{ $post->title}}
                        @endif
                    </a>
                </h3>

                <x-tags :tags="$post->tags"></x-tags>

                <p>{{ $post->content }}</p>
                @if ($post->comments_count)
                <div>
                    <span class="badge badge-success">{{ $post->comments_count . ' comment(s)' }}</span>
                </div>

                @else
                <div class="m-2">
                    <span class="badge badge-dark">No comments yet</span>
                </div>
                @endif

                <x-updated :date="$post->created_at" :name="$post->user->name"></x-updated>
                <x-updated :date="$post->created_at" >Updated</x-updated>

                @auth
                @can('update',$post)
                    <a class="btn btn-sm btn-warning" href="{{ route('posts.edit',['post'=>$post->id]) }}">Edit</a>
                @endcan

                @cannot('delete',$post)
                <x-badge type="danger">
                    You can't delete this post
                </x-badge>
                @endcannot
                @if(!$post->deleted_at)
                @can('delete',$post)
                <form class="fm-inline" method="POST" action="{{ route('posts.destroy',['post'=>$post->id]) }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                </form>
                @endcan
                @else
                @can('restore',$post)
                <form class="fm-inline" method="POST" action="{{ url('/posts/'. $post->id .'/restore') }}">
                    @csrf
                    @method('PATCH')
                    <button class="btn btn-sm btn-success" type="submit">restore</button>
                </form>
                @endcan
                @can('forceDelete',$post)
                <form class="form-inline" method="POST" action="{{ url('/posts/'. $post->id .'/forcedelete') }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" type="submit">Force delete</button>
                </form>
                @endcan
                @endif
            @endauth
            </li>
            @empty
            <span class="badge-danger">No posts</span>
            @endforelse
        </ul>
    </div>
    <div class="col-4">
        @include('posts.sidebar')
    </div>

        @endsection

