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

// Route::get('/', function () {
//     return view('welcome');
// });



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


// translate routes


Route::get('/translate','ApiController@translate');
Route::get('/detect','ApiController@detect');
Route::get('/languages','ApiController@languages');
Route::get('/target','ApiController@target');


// vocabulary routes

Route::get('/words','VocabularyController@words');
Route::get('/words/{cat}', 'VocabularyController@words_by_category');
Route::get('/','VocabularyController@categories');

Route::get('/storecategories' , 'CategoryController@store');


