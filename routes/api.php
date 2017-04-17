<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('oauth/github', 'GithubController@redirectToProvider');
Route::get('oauth/github/callback', 'GithubController@handleProviderCallback');

Route::post('/github/repos', 'GithubController@repos');

Route::resource('stories', 'StoryController');