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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();


//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login')->name('login');
Route::post('/login', 'Auth\LoginController@login');

Route::get('/register', 'Auth\RegisterController@validator');
Route::post('/register', 'Auth\RegisterController@validator');

Route::get('/added', 'Auth\RegisterController@added');

Route::get('/logout', 'Auth\LoginController@logout');
Route::post('/logout', 'Auth\LoginController@login');

//ログイン中のページ
Route::get('/top','PostsController@index');

Route::get('/user-profile/{id}','UsersController@userProfile');

Route::get('/profile','PostsController@profile');
Route::post('/profile/update', 'PostsController@update');

Route::get('/search','UsersController@search');
Route::post('/search','UsersController@search');

Route::get('/follow-list','FollowsController@followList');
Route::get('/follower-list','FollowsController@followerList');

Route::post('/post', 'PostsController@create');

Route::post('/follow/create', 'FollowsController@create');

Route::post('/follow/delete', 'FollowsController@delete');
