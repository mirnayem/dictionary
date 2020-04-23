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


// Route::get('/translate','ApiController@translate');
// Route::get('/detect','ApiController@detect');
// Route::get('/languages','ApiController@languages');
// Route::get('/target','ApiController@target');





// Admin Routes

Route::get('/admin','Admin\AdminController@index')->name('dashboard');
Route::get('/admin/word/{categroy_name}','Admin\AdminController@categoryWord');
Route::get('/admin/words','Admin\AdminController@allWords')->name('adminWord');

// vocabulary routes scraping

Route::get('parsing/words','VocabularyController@words');
Route::get('parsing/words/{cat}', 'VocabularyController@words_by_category');
Route::get('parsing/','VocabularyController@categories');


// store category
Route::get('parsing/storecategories' , 'VocabularyController@storecategory');
// store word
Route::get('parsing/storewords' , 'VocabularyController@storeword');


// homepage 

Route::view('/', 'homepage')->name('vocabulary');

//Word Route

Route::resource('words', 'Word\WordController');


//Category Route

Route::resource('categories', 'Category\CategoryController');
Route::get('categories/word/{category_name}', 'Category\CategoryController@category_word');

