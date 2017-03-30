<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GithubTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetUserRepos()
    {
        $res = $this->post('/api/github/repos', ['token' => '26a7b35d02ec8f9587506081b257889aedb716d4']);
        $res->assertJsonStructure([
            '*' => ['name', 'full_name', 'owner', 'url']
        ]);
    }
}
