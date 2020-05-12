<?php

namespace Tests\Feature;

use App\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use illuminate\Support\Str;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function testSavePost()
    {
        $post = new Post();
        $post->title = 'Learn Java';
        $post->content = 'Learn Java the right way!';
        $post->slug = Str::slug($post->title, '-');
        $post->active = false;

        $post->save();

        $this->assertDatabaseHas('posts', ['title' => 'Learn Java']);
    }

    public function testPostStoreValid()
    {
        $data = [
            'title' => 'Learn Java',
            'content' => 'Learn Java the right way!',
            'slug' => Str::slug('Learn Java', '-'),
            'active' => false
        ];
        $this->post('/posts', $data)
            ->assertStatus(302)
            ->assertSessionHas('status');
        $this->assertEquals(session('status'), 'post was created!');
    }
    public function testPostStoreFail()
    {
        $data = [
            'title' => '',
            'content' => '',
        ];
        $this->post('/posts', $data)
            ->assertStatus(302)
            ->assertSessionHas('errors');

        $messages = session('errors')->getmessages();

        $this->assertEquals($messages['title'][0], 'The title must be at least 4 characters.');
        $this->assertEquals($messages['title'][1], 'The title field is required.');
        $this->assertEquals($messages['content'][0], 'The content field is required.');
    }
    public function testPostUpdate()
    {
        $post = new Post();
        $post->title = 'testing';
        $post->content = 'Learn testing the right way!';
        $post->slug = Str::slug($post->title, '-');
        $post->active = true;

        $post->save();

        $this->assertDatabaseHas('posts', $post->toArray());

        $data = [
            'title' => 'testing updated',
            'content' => 'Learn Java the right way!',
            'slug' => Str::slug('Learn Java', '-'),
            'active' => false
        ];
        $this->put("/posts/{$post->id}", $data)
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertDatabaseHas('posts', ['title' => $data['title']]);
        $this->assertDatabaseMissing('posts', ['title' => $post->title]);
    }
    public function testPostDelete()
    {
        $post = new Post();
        $post->title = 'testing';
        $post->content = 'Learn testing the right way!';
        $post->slug = Str::slug($post->title, '-');
        $post->active = true;

        $post->save();

        $this->assertDatabaseHas('posts', $post->toArray());

        $this->delete("/posts/{$post->id}")
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertDatabaseMissing('posts', $post->toArray());
    }
}
