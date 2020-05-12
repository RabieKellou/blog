<?php

namespace App;

use App\Scopes\AdminShowDeleteScope;
use App\Scopes\LatestScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'content', 'slug', 'active', 'user_id'];

    //relationships
    public function comments()
    {
        return $this->hasMany('App\Comment')->dernier(); //using comment's Dernier local scope
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function image()
    {
        return $this->hasOne(Image::class);
    }
    public function tags()
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }
    //create a local post
    public function scopeMostCommented(Builder $query)
    {
        return $query->withCount('comments')->orderBy('comments_count', 'desc');
    }

    public function scopePostWithUserCommentsTags(Builder $query)
    {
        return $query->withCount('comments')->with(['user', 'tags']);
    }

    public static function boot()
    {
        static::addGlobalScope(new AdminShowDeleteScope);
        parent::boot();
        //create a global scope
        static::addGlobalScope(new LatestScope);

        //delete comments before deleting a post
        static::deleting(function (Post $post) {
            //dd('deleting');
            $post->comments()->delete();
        });
        static::restoring(function (Post $post) {
            //dd('deleting');
            $post->comments()->restore();
        });

        static::updating(function (Post $post) {
            //dd('deleting');
            Cache::forget("post-show-{$post->id}");
        });
    }
}
