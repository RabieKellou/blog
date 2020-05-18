<?php

namespace App\Observers;

use App\Post;
use Illuminate\Support\Facades\Cache;

class PostObserver
{
    /**
     * Handle the post "created" event.
     *
     * @param  \App\Post  $post
     * @return void
     */
    public function created(Post $post)
    {
        //
    }

    /**
     * Handle the post "updating" event.
     *
     * @param  \App\Post  $post
     * @return void
     */

    public function updating(Post $post)
    {
        Cache::forget("post-show-{$post->id}");
    }

    /**
     * Handle the post "deleted" event.
     *
     * @param  \App\Post  $post
     * @return void
     */
    public function deleting(Post $post)
    {
        //delete comments before deleting a post
        $post->comments()->delete();
    }

    /**
     * Handle the post "restoring" event.
     *
     * @param  \App\Post  $post
     * @return void
     */
    public function restoring(Post $post)
    {
        $post->comments()->restore();
    }

    /**
     * Handle the post "force deleted" event.
     *
     * @param  \App\Post  $post
     * @return void
     */
    public function forceDeleted(Post $post)
    {
        //
    }
}
