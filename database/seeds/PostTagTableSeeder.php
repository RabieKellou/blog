<?php

use App\Post;
use App\Tag;
use Illuminate\Database\Seeder;

class PostTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tagCount = Tag::count();

        Post::all()->each(function ($post) use ($tagCount) {
            $take = random_int(1, $tagCount);
            $tagsIds = Tag::InRandomOrder()->take($take)->get()->pluck('id');
            $post->tags()->sync($tagsIds);
        });
    }
}
