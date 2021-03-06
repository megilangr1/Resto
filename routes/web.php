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

Route::get('/', 'HomeController@index');

Auth::routes(['register' => false]);
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {
	Route::group(['middleware' => ['role:Admin']], function () {	
		Route::resource('role', 'Admin\RoleController');
		Route::resource('user', 'Admin\UserController');
		Route::resource('units', 'Master\UnitsController');
		Route::resource('category', 'Master\CategoryController');
		Route::resource('ingredients', 'Master\IngredientsController');
		Route::resource('suppliers', 'Master\SupplierController');
	});
});