<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Abraham\TwitterOAuth\TwitterOAuth;
use Socialite;
use App\TwitterUser;

class TwitterController extends Controller
{
    public function tweet(Request $request) {
        $twitter = new TwitterOAuth(
            env('TWITTER_CONSUMER_KEY'),
            env('TWITTER_CONSUMER_SECRET'),
            $request->input('token'),
            $request->input('token_secret')
        );

        $tweet = $twitter->post('statuses/update', ['status' => $request->input('tweet')]);
        return response()->json($tweet);
    }

    public function user(Request $request) {
        $twitter = new TwitterOAuth(
            env('TWITTER_CONSUMER_KEY'),
            env('TWITTER_CONSUMER_SECRET'),
            $request->input('token'),
            $request->input('token_secret')
        );

        $user = $twitter->get('account/verify_credentials');
        return response()->json($user);
    }
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('twitter')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $twitter = Socialite::driver('twitter')->user();

        $user = TwitterUser::firstOrNew([ 'login' => $twitter->nickname ]);
        $user->name = $twitter->name;
        $user->avatar = $twitter->avatar;
        $user->login = $twitter->nickname;
        $user->bio = $twitter->user['description'];
        $user->token = $twitter->token;
        $user->token_secret = $twitter->tokenSecret;
        $user->save();

        if(\App::environment('testing'))
            return response()->json($user);

        $frontend_url = env('FRONTEND_URL');
        return redirect("{$frontend_url}/settings;twitter_token={$user->token};twitter_token_secret={$user->token_secret}");
        
    }
}
