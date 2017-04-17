<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('oauth/twitter', 'TwitterController@redirectToProvider');
Route::get('oauth/twitter/callback', 'TwitterController@handleProviderCallback');
Route::get('oauth/github', 'GithubController@redirectToProvider');
Route::get('oauth/github/callback', 'GithubController@handleProviderCallback');