<?php

namespace Tests\Feature\API\Post;

use App\Models\Post;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class PostApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_index() {
        // load data in db
        $posts = Post::factory(10)->create();
        $postIds = $posts->map(fn ($post) => $post->id);

        // call index endpoint
        $response = $this->json('get', '/api/posts');
        
        // assert status
        $response->assertStatus(200);

        // verify records
        $data = $response->json('data');
        collect($data)->each(fn ($post) => $this->assertTrue(in_array($post['id'], $postIds->toArray())));
    }

    public function test_show() {
        $dummy = Post::factory()->create();
        $response = $this->json('get', '/api/posts/' . $dummy->id);

        $result = $response->assertStatus(200)->json('data');

        $this->assertEquals(data_get($result, 'id'), $dummy->id, 'Response ID not the same as expected');
    }

    public function test_create() {

        Event::fake();
        $dummy = Post::create()->make();

        $response = $this->json('post', '/api/posts/', $dummy->toArray());

        $result = $response->assertStatus(201)->json('data');

        Event::assertDispatched(PostCreated::class);

        $result = collect($result)->only(array_keys($dummy->getAttribures()));

        $result->each(function ($value, $field) use($dummy) {
            $this->assertSame(data_get($dummy, $field), $value, 'Fillable is not same');
        });
    }

    public function test_update() {

        $dummy = Post::factory()->create();
        $dummy2 = Post::factory()->make();
        Event::fake();
        $fillables = collect((new Post))->getFillables();

        $fillables->each(function ($toUpdate) use($dummy, $dummy2) {
            $response = $this->json('patch', '/api/posts/' . $dummy->id, [
                $toUpdate => data_get($dummy2, $toUpdate),
            ]);

            $result = $response->assertStatus(200)->json('data');
            $this->assertSame(data_get($dummy2, $toUpdate), data_get($dummy->refresh(), $toUpdate));
        });

    }

    public function test_delete() {

        $dummy = Post::factory()->create();

        $response = $this->json('delete', '/api/posts/' . $dummy->id);

        $result = $response->assertStatus(200);

        $this->expectException(ModelNotFoundException::class);
        Post::query()->findOrFail($dummy->id);

    }
}
