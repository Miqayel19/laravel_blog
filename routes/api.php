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
Route::post('/login','LoginController@login');
Route::post('/register','RegisterController@register');
Route::get('/logout','LoginController@logout');
Route::get('/categories','CategoriesController@index');
Route::get('/me/categories','CategoriesController@mycategories');
Route::post('/me/categories/add','CategoriesController@add');
Route::get('/me/categories/{id}/edit','CategoriesController@edit');
Route::put('/me/categories/{id}','CategoriesController@update');
Route::delete('/me/categories/{id}/deleted','CategoriesController@destroy');



Route::get('/posts','PostsController@index');
Route::get('/me/posts','PostsController@myposts');
Route::post('/me/posts/add','PostsController@add');
Route::get('/me/posts/{id}/edit','PostsController@edit');
Route::put('/me/posts/{id}','PostsController@update');
Route::delete('/me/posts/{id}/deleted','PostsController@destroy');