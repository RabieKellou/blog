<?php

namespace App\Listeners;

use App\Events\CommentPosted;
use App\Jobs\NotifyUsersPostWasCommented;
use App\Mail\CommentPostMarkdown;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class NotifyUserAboutComment
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(CommentPosted $event)
    {
        Mail::to($event->comment->commentable->user->email)->queue(new CommentPostMarkdown($event->comment));
        //call a custom job
        NotifyUsersPostWasCommented::dispatch($event->comment);
    }
}
