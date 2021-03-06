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

Route::get('/', 'PagesController@index');
Route::get('/itemList', 'ItemController@index');
Route::get('/itemCategories', 'PagesController@itemCategories');
Route::get('/itemCategories/{id}', 'ItemCategoriesController@show');
Route::get('/itemCategories/edit/{id}', 'ItemCategoriesController@edit');
Route::get('/itemCategories/sort/{sortField}/{sortType}', 'ItemCategoriesController@sort');
Route::get('/itemCategories/encrypt/{id}', 'ItemCategoriesController@encryptId');
Route::get('/itemCategories/edit/{id}', 'ItemCategoriesController@edit');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
