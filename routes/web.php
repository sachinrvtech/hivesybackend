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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin/dashboard', [
	'middleware' => ['auth','role'], // A 'roles' middleware must be specified
	'uses' => 'AdminController@dashboard',
]);
/*start for users*/
Route::any('/admin/addedituser/{id?}', [
	'middleware' => ['auth','role'], // A 'roles' middleware must be specified
	'uses' => 'AdminController@addedituser',
]);

Route::any('/admin/updateactive/{id?}/{key?}', [
	'middleware' => ['auth','role'], // A 'roles' middleware must be specified
	'uses' => 'AdminController@updateactive',
]);
Route::any('/admin/deleteuser/{id?}', [
	'middleware' => ['auth','role'], // A 'roles' middleware must be specified
	'uses' => 'AdminController@deleteuser',
]);

Route::any('/admin/users/{key?}', [
	'middleware' => ['auth','role'], // A 'roles' middleware must be specified
	'uses' => 'AdminController@users',
]);


/*end for users*/
/*start for business*/
Route::any('/admin/updateactivebusiness/{id?}/{key?}', [
	'middleware' => ['auth','role'], // A 'roles' middleware must be specified
	'uses' => 'AdminController@updateactivebusiness',
]);
Route::any('/admin/deletebusiness/{id?}', [
	'middleware' => ['auth','role'], // A 'roles' middleware must be specified
	'uses' => 'AdminController@deletebusiness',
]);

Route::any('/admin/businesses', [
	'middleware' => ['auth','role'], // A 'roles' middleware must be specified
	'uses' => 'AdminController@businesses',
]);

Route::any('/admin/addeditbusiness/{id?}', [
	'middleware' => ['auth','role'], // A 'roles' middleware must be specified
	'uses' => 'AdminController@addeditbusiness',
]);
/*end for business*/

/*start for deal*/
Route::any('/admin/updateactivedeal/{id?}/{key?}', [
	'middleware' => ['auth','role'], // A 'roles' middleware must be specified
	'uses' => 'AdminController@updateactivedeal',
]);
Route::any('/admin/deletedeal/{id?}', [
	'middleware' => ['auth','role'], // A 'roles' middleware must be specified
	'uses' => 'AdminController@deletedeal',
]);

Route::any('/admin/deals', [
	'middleware' => ['auth','role'], // A 'roles' middleware must be specified
	'uses' => 'AdminController@deals',
]);

Route::any('/admin/addeditdeal/{id?}', [
	'middleware' => ['auth','role'], // A 'roles' middleware must be specified
	'uses' => 'AdminController@addeditdeal',
]);
Route::post('/admin/addeditcategory', [
	'middleware' => ['auth','role'], // A 'roles' middleware must be specified
	'uses' => 'AdminController@addeditcategory',
]);
Route::post('/admin/deletecategory', [
	'middleware' => ['auth','role'], // A 'roles' middleware must be specified
	'uses' => 'AdminController@deletecategory',
]);

Route::post('/admin/viewdealimages', [
	'middleware' => ['auth','role'], // A 'roles' middleware must be specified
	'uses' => 'AdminController@viewdealimages',
]);
Route::post('/admin/deletedealimage', [
	'middleware' => ['auth','role'], // A 'roles' middleware must be specified
	'uses' => 'AdminController@deletedealimage',
]);
/*end for deal*/