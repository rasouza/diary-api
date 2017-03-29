<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use \App\Story;

class StoryTest extends TestCase
{
    use DatabaseMigrations;

    public function testCreatesOneStory()
    {
        $story = factory(Story::class)->make([
            'title' => 'Today\'s title',
            'date'  => '2017-03-29T01:22:06.827Z'
        ]);

        $this->assertInstanceOf(Story::class, $story);
        $this->assertEquals($story->title, 'Today\'s title');
        $this->assertEquals($story->date, '2017-03-29 01:22:06');
    }

    public function testStoreOneStory()
    {
        factory(Story::class)->create([
            'title' => 'Title'
        ]);

        $this->assertDatabaseHas('stories', [
            'title' => 'Title'
        ]);
    }

    public function testStoreStories()
    {
        $stories = factory(Story::class, 3)->create();

        $this->assertTrue($stories->first()->description != null);
        $this->assertEquals(Story::count(), 3);
    }

    public function testGetAllStories()
    {
        factory(Story::class, 10)->create();

        $this->assertCount(10, Story::all());
    }

    public function testGetOneStory()
    {
        factory(Story::class, 10)->create();

        $story = Story::all()->get(rand(0, 9));

        $this->assertInstanceOf(Story::class, $story);
    }

}
