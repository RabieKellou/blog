<?php

namespace App;

use App\Scopes\LatestScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    protected $fillable = ['content', 'user_id'];

    public function post()
    {
        return $this->belongsTo('App\Post');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function commentable()
    {
        return $this->morphTo();
    }
    public function tags()
    {
        return $this->morphToMany('App\Tag', 'taggable')->withTimestamps();
    }
    //create a local scope
    public function scopeDernier(Builder $query)
    {
        return $query->orderBy(static::UPDATED_AT, 'desc');
    }

    public static function boot()
    {
        parent::boot();

        //create a global scope
        //static::addGlobalScope(new LatestScope);
    }
}
