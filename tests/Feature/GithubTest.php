<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GithubTest extends TestCase
{
    
    public function testHasEnvKey()
    {
        $this->assertRegExp("/[A-Za-z0-9]+/", getenv('GITHUB_TOKEN'));
    }

    public function testGetUserRepos()
    {
        global $argc, $argv;
        $res = $this->post('api/github/repos', ['token' => getenv('GITHUB_TOKEN') ]);
        $res->assertJsonStructure([
            '*' => ['name', 'full_name', 'owner', 'url']
        ]);
    }
}
