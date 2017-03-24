<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use \App\Story;

class StoryTest extends TestCase
{
    use DatabaseMigrations;

    public function testGetAllStories()
    {
        factory(Story::class, 10)->create();
        $res = $this->get('/api/stories');

        $res->assertStatus(200)
            ->assertJsonStructure([
            '*' => ['title', 'description', 'date']
        ]);
    }

    public function testStoreStory()
    {
        $story = factory(Story::class)->states('custom date')->make();
        $res = $this->post('/api/stories', $story->toArray());

        $res->assertStatus(200)
            ->assertJsonStructure([
            'title',
            'description',
            'date'
        ]);
    }
}
