<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Socialite;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
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

        $user = User::firstOrCreate([ 'email' => $github->email ]);
        $user->name = $github->name;
        $user->avatar = $github->avatar;
        $user->login = $github->nickname;
        $user->email = $github->email;
        $user->bio = $github->user['bio'];
        $user->token = $github->token;
        $user->save();

        if(App::environment('testing'))
            return response()->json($user);

        return redirect("http://localhost:3000/settings;token={$user->token}");
        
    }
}
