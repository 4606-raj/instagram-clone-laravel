<?php

use Illuminate\Support\Facades\Route;

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

use App\Mail\NewUserWelcomeMail;

Auth::routes();

Route::get('/email', function() {
	return new NewUserWelcomeMail();
});

Route::get('/welcome', 'PostsController@userWelcomePosts');

Route::post('follow/{user}', 'FollowsController@store');

Route::get('/profile/some/{user}', 'ProfilesController@some');

Route::get('/profile/{user}', 'ProfilesController@index')->name('profile.show');

Route::patch('/profile/{user}', 'ProfilesController@update')->name('profile.update');

Route::get('/profile/{user}/edit', 'ProfilesController@edit')->name('profile.edit');

Route::get('/', 'PostsController@index');

Route::get('/p/create', 'PostsController@create');

Route::get('/p/{post}', 'PostsController@show');

Route::post('/p', 'PostsController@store');

