<?php

use App\Post;
use App\User;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        if ($users->count() == 0) {
            $this->command->info('please create some users!');
            return;
        }

        $nbPosts = (int) $this->command->ask('How many posts do you want to generate', 30);

        factory(Post::class, $nbPosts)->make()->each(function ($post) use ($users) {
            $post->user_id = $users->random()->id;
            $post->save();
        });
    }
}
