<?php

namespace App\Http\ViewComposers;

use App\Post;
use App\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class ActivityComposer
{
    public function compose(View $view)
    {
        $mostCommented = Cache::remember('mostCommented', now()->addMinutes(10), function () {
            return Post::MostCommented()->take(5)->get();
        });
        $mostActiveUsers = Cache::remember('mostActiveUsers', now()->addMinute(10), function () {
            return User::ActiveUsers()->take(5)->get();
        });
        $mostActiveUsersInLastMonth = Cache::remember('mostActiveUsersInLastMonth', now()->addMinute(10), function () {
            return User::ActiveUsersInLastMonth()->take(5)->get();
        });

        $view->with([
            'mostCommented' => $mostCommented,
            'mostActiveUsers' => $mostActiveUsers,
            'mostActiveUsersInLastMonth' => $mostActiveUsersInLastMonth
        ]);
    }
}
