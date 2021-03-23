<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;



Auth::routes();

Route::get('search', 'SearchController@post')->name('search.post');
Route::prefix('/posts')->middleware('auth')->group(function () {

    Route::get('/', 'PostController@index')->name('posts.index');
    Route::get('/create', 'PostController@create')->name('posts.create');
    Route::post('/store', 'PostController@store')->name('posts.store');
    Route::get('/{post:slug}/edit', 'PostController@edit')->name('posts.edit');
    Route::patch('/{post:slug}/update', 'PostController@update')->name('posts.update');
    Route::delete('/{post:slug}/delete', 'PostController@destroy')->name('posts.delete');

   
});

Route::view('contact', 'contact');
Route::view('about', 'about');
Route::view('login', 'login');

Route::get('categories/{category:slug}', 'CategoryController@show')->name('categories.show');
Route::get('tags/{tag:slug}', 'TagController@show')->name('tags.show');

Route::get('posts/{post:slug}', 'PostController@show')->name('posts.show');

Auth::routes();

Route::get('/', 'PostController@home')->name('home');
;
