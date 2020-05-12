<?php

namespace App\Http\Controllers;

use App\Post;
use App\Tag;
use Illuminate\Http\Request;

class PostTagController extends Controller
{
    public function index($id)
    {
        $tag = Tag::findOrFail($id);
        //dd($tag->posts;
        return view('posts.index', [
            'posts' => $tag->posts()->postWithUserCommentsTags()->get()
        ]);
    }
}
