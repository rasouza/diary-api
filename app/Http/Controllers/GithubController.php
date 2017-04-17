<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use GuzzleHttp\Client;
use Socialite;
use App\User;

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

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('github')->stateless()->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $github = Socialite::driver('github')->stateless()->user();

        $user = User::firstOrNew([ 'email' => $github->email ]);
        $user->name = $github->name;
        $user->avatar = $github->avatar;
        $user->login = $github->nickname;
        $user->email = $github->email;
        $user->bio = $github->user['bio'];
        $user->token = $github->token;
        $user->save();

        if(\App::environment('testing'))
            return response()->json($user);

        $frontend_url = env('FRONTEND_URL');
        return redirect("{$frontend_url}/settings;token={$user->token}");
        
    }
}
