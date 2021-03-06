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

Route::get('/', function () {
    return view('home.home');
})->name('home');

Route::resource('post', 'PostController');
Route::group(['prefix' => 'post'], function() {
    Route::post('search', 'PostController@search')->name('post.search');
    });
Route::resource('category', 'CategoryController');
Route::group(['prefix' => 'category'], function () {
    Route::post('search','CategoryController@search')->name('category.search');
});
