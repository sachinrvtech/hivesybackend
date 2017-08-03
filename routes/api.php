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

Route::group(['namespace' => 'Api'], function(){
        Route::post('/login', 'UserController@login');
        Route::post('/signup', 'UserController@signup');
        Route::post('/sociallogin', 'UserController@facebooklogin');
        Route::post('/forget_password', 'UserController@forget_password');
        Route::group( ['middleware' => ['auth:api'] ], function(){
                Route::post('/getdealnearby', 'ApiController@getdealnearby');
                Route::post('/updateinterest', 'ApiController@updateinterest');
                Route::post('/updateprofilepic', 'ApiController@updateprofilepic');
                Route::post('/saveunsavetodeal', 'ApiController@saveunsavetodeal');
                Route::post('/togetsaveddeal', 'ApiController@togetsaveddeal');
                Route::post('/adddealtocart', 'ApiController@adddealtocart');
                Route::post('/togetcartddeals', 'ApiController@togetcartddeals');
                Route::post('/updatelatlong', 'ApiController@updatelatlong');
                Route::post('/updateprofile', 'ApiController@updateprofile');
                     });
});