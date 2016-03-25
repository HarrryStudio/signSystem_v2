<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => ['web']], function () {
//    Route::get('/',function(){
//        return 'Hello';
//    });

    Route::get('/', ['middleware' => 'admin_auth', 'uses' => 'Admin\IndexController@index', 'as' => 'admin_index']);

    Route::get('admin_login',  ['uses' => 'Admin\LoginController@index', 'as' => 'admin_login']);

    Route::get('captcha/{tmp}', 'Admin\LoginController@get_verifycode');

    Route::post('admin_post_login',  [
        'uses'       => 'Admin\LoginController@do_login',
        'as'         => 'admin_post_login'
    ]);

    Route::group(['prefix' => '/admin','namespace' => 'Admin','middleware' => 'admin_auth'], function() {

        Route::get('/', ['uses' => 'IndexController@index', 'as' => 'admin_index']);

        Route::get('index', ['uses' => 'IndexController@index', 'as' => 'admin_index']);

        Route::get('group',['uses' => 'GroupController@index', 'as' => 'admin_group']);

        Route::get('user',['uses' => 'UserController@index', 'as' => 'admin_user']);

    });

});