<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Post' => 'App\Policies\PostPolicy',
        'App\User' => 'App\Policies\UserPolicy'
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        /* Policies */
        // Gate::define('post.update', 'App\Policies\PostPolicy@update');
        // Gate::define('post.delete', 'App\Policies\PostPolicy@delete');
        //Gate::resource('post', 'App\Policies\PostPolicy');
        // Or use the policy mappings
        /* Gates */

        //Update Authorization
        /*   Gate::define('post.update', function ($user, $post) {
                return $user->id === $post->user_id;
            }); */

        //Delete Authorization
        /* Gate::define('post.delete', function ($user, $post) {
                return $user->id === $post->user_id;
            });
 */

        Gate::define('secret.page', function ($user) {
            return $user->is_admin;
        });
        //before checking any authorization if true skip authz else ckeck
        Gate::before(function ($user, $ability) {
            if ($user->is_admin && in_array($ability, ['update', 'restore', 'delete'])) {
                return true;
            }
        });
    }
}
