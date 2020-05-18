<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    public const LOCALES = [
        'en' => 'English',
        'ar' => 'Arabe',
        'fr' => 'French'
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    //one to many polymorphic relationship
    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable')->dernier(); //using comment's Dernier local scope
    }
    //one to one polymorphic relationship
    public function image()
    {
        return $this->morphOne('App\Image', 'imageable');
    }

    public function scopeActiveUsers(Builder $query)
    {
        return $query->withCount('posts')->orderBy('posts_count', 'desc');
    }

    public function scopeActiveUsersInLastMonth(Builder $query)
    {
        return $query->withCount(['posts' => function (Builder $query) {
            $query->whereBetween(static::CREATED_AT, [now()->subMonth(1), now()]);
        }])
            ->having('posts_count', '>', 3)
            ->orderBy('posts_count', 'desc');
    }
}
