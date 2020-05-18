<?php

namespace App\Http\Controllers;

use App\Events\CommentPosted as EventsCommentPosted;
use App\Http\Requests\StoreComment;
use App\Http\Resources\CommentResource;
use App\Jobs\NotifyUsersPostWasCommented;
use App\Mail\CommentPosted;
use App\Mail\CommentPostMarkdown;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PostCommentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only(['store']);
    }
    public function index(Post $post)
    {

        //lazy loaded relations
        // return CommentResource::collection($post->comments);
        //eager loaded relations
        return CommentResource::collection($post->comments()->with('user')->get());
    }
    public function show(Post $post)
    {
        //one record
        return new CommentResource($post->comments->first());
    }

    public function store(StoreComment $request, Post $post)
    {
        $comment = $post->comments()->create([
            'content' => $request->content,
            'user_id' => $request->user()->id
        ]);
        //plain
        // Mail::to($post->user->email)->send(new CommentPosted($comment));
        //Markdown
        //without a queue
        //Mail::to($post->user->email)->send(new CommentPostMarkdown($comment));
        //queue mail sending if CommentPostMarkdown implements ShouldQueue interface
        //Mail::to($post->user->email)->send(new CommentPostMarkdown($comment));
        //queue the email
        //Mail::to($post->user->email)->queue(new CommentPostMarkdown($comment));
        //delay email sending in a queue
        //$when = now()->addMinutes(1);
        //Mail::to($post->user->email)->later($when, new CommentPostMarkdown($comment));

        //fire comment posted event
        event(new EventsCommentPosted($comment));


        return redirect()->back();
    }
}
