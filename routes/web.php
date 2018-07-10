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

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('logout', 'Auth\LoginController@logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('/', 'HomeController@index');

Route::get('/account',      'Auth\AccountSettingsController@index');
Route::patch('/account',    'Auth\AccountSettingsController@update');

/**
 *  Book Routes
 */

Route::get('/books',    'BooksController@index');
Route::get('/search',   'SearchController@index');

// All routes that the user needs to be logged in to access
Route::middleware('auth')->group(function () {

    Route::get('/my_books',             'BooksController@myBooks');
    Route::get('/books/create',         'BooksController@create');
    Route::post('/books',               'BooksController@store');

    Route::get('/books/{book}/edit',    'BooksController@edit');
    Route::patch('/books/{book}',       'BooksController@update');

    Route::delete('/books/{book}',      'BooksController@destroy');

});

Route::get('/books/{book}', 'BooksController@show');

/**
 *  List Routes
 */

Route::get('/lists', 'BookListController@index');

// All routes that the user needs to be logged in to access
Route::middleware('auth')->group(function () {

    Route::get('/my_lists',                     'BookListController@myLists');
    Route::get('/lists/create',                 'BookListController@create');
    Route::post('/lists',                       'BookListController@store');

    Route::get('/lists/{list}/add_book',        'BookListController@showAddBook');
    Route::post('/lists/{list}/add_book',       'BookListController@addBook');
    Route::delete('/lists/{list}/remove_book',  'BookListController@removeBook');

    Route::patch('/lists/{list}/books',         'BookListController@updateBooks');

    Route::get('/lists/{list}/edit',            'BookListController@edit');
    Route::patch('/lists/{list}',               'BookListController@update');

    Route::delete('/lists/{list}',              'BookListController@destroy');

});

Route::get('/lists/{list}', 'BookListController@show');

