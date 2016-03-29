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


Route::get('/', function () {
    return view('welcome');
});
/*Route::post('/admin/addUser', function() {
    return "hello";
});//添加用户*/

Route::group(['middleware' => ['web']], function () {
//    Route::get('/',function(){
//        return 'Hello';
//    });

    Route::get('/', ['middleware' => 'admin_auth', 'uses' => 'Admin\IndexController@index', 'as' => 'admin_index']);

    Route::get('admin_login', ['uses' => 'Admin\LoginController@index', 'as' => 'admin_login']);

    Route::get('captcha/{tmp}', 'Admin\LoginController@get_verifycode');

    Route::post('admin_post_login', [
        'uses' => 'Admin\LoginController@do_login',
        'as' => 'admin_post_login'
    ]);
//,'middleware' => 'admin_auth' 中间件
    Route::group(['prefix' => '/admin', 'namespace' => 'Admin'], function () {

        Route::get('/', ['uses' => 'IndexController@index', 'as' => 'admin_index']);

        Route::get('index', ['uses' => 'IndexController@index', 'as' => 'admin_index']);

        //组别系列操作
        Route::get('group', ['uses' => 'GroupController@index', 'as' => 'admin_group']);
        Route::get('selectGroupUsers/{id}','GroupController@selectGroupUsers');
        Route::get('createGroup/{name}','GroupController@createGroup');
        Route::get('updateGroup/{id}/{name}','GroupController@updateGroup');

        Route::get('user', ['uses' => 'UserController@index', 'as' => 'admin_user']);

        Route::get('showUsers', 'UserController@showUsers');//显示用户

        Route::get('create', 'UserController@create');//创建用户

        Route::post('addUser', 'UserController@addUsers');//添加用户

    });

});