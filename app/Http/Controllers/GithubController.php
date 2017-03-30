<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use GuzzleHttp\Client;

class GithubController extends Controller
{
    public function repos(Request $request)
    {
        $client = new Client();
        $token = $request->input('token');

        $headers = [ 'headers' => [ 'Authorization' => "bearer {$token}"]];

        $repos = $client->request('GET', "https://api.github.com/user/repos", $headers)->getBody();
        return response()->json($repos);
    }
}
