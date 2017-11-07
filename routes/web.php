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

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/posts/', 'PostsController@index');
Route::get('/categories/', 'CategoriesController@index');
Route::get('/categories/create', 'CategoriesController@create');
Route::get('/posts/create', 'PostsController@create');
Route::post('/categories/store', 'CategoriesController@store');
Route::post('/posts/store', 'PostsController@store');
Route::delete('/posts/{id}','PostsController@destroy');
Route::delete('/categories/{id}','CategoriesController@destroy');
Route::get('/categories/{id}/edit','CategoriesController@edit');
Route::get('/posts/{id}/edit', 'PostsController@edit');
Route::put('/categories/{id}','CategoriesController@update');
Route::put('/posts/{id}','PostsController@update');
Route::get('login/{provider}', 'Auth\RegisterController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\RegisterController@handleProviderCallback');