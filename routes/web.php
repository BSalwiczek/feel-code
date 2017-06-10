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

//pages
Route::get('/', 'PagesController@getHome');
Route::get('about', ['as'=>'about','uses'=>'PagesController@getAbout']);
Route::post('about', ['as'=>'send-about','uses'=>'PagesController@postAbout']);
Route::get('categories',['as'=>'categories','uses'=>'PagesController@getCategories']);

//login
Route::get('admin', 'LoginController@getLogin');
Route::post('admin', ['uses'=>'LoginController@checkIfAdmin','as'=>'login']);
Route::get('logout','LoginController@logout');
Route::get('blog/{slug}',['as'=>'blog.single','uses'=>'PagesController@getSingle'])->where('slug','[\w\d\-\_]+');

//resources
Route::resource('posts', 'PostsController');
Route::resource('categories-manager', 'CategoryController');
Route::resource('images', 'ImagesController');
Route::resource('quotes', 'QuotesController');
Route::resource('comments-admin','CommentsAdminController');

//publish/hide post
Route::post('posts/{post}/publish',['as'=>'posts.publish','uses'=>'PostsController@publish']);
Route::post('posts/{post}/hide',['as'=>'posts.hide','uses'=>'PostsController@hide']);

//comments
Route::post('comments/{post_id}',['uses'=>'CommentsController@store', 'as'=>'comments.store']);
Route::post('postComments','CommentsController@postComments');

//subcomments
Route::post('sub-comments/{comm_id}',['uses'=>'SubCommentsController@store', 'as'=>'sub-comments.store']);
Route::post('postSubComments','SubCommentsController@postSubComments');
