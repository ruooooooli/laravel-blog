<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::group(array(
    'namespace' => 'Frontend',
    'as'        => 'frontend::',
), function () {
    Route::get('/', 'IndexController@index')->name('index.index');
});

Route::group(array(
    'namespace' => 'Auth',
    'as'        => 'backend::auth.',
    'prefix'    => 'backend',
), function () {
    Route::get('/auth/login', array(
        'uses'  => 'LoginController@getLogin',
        'as'    => 'login.get',
    ));

    Route::post('/auth/login', array(
        'uses'  => 'LoginController@postLogin',
        'as'    => 'login.post',
    ));

    Route::get('/auth/logout', array(
        'uses'  => 'LoginController@logout',
        'as'    => 'logout',
    ));
});

Route::group(array(
    'namespace' => 'Backend',
    'prefix'    => 'backend',
    'as'        => 'backend::',
    'middleware'=> 'auth',
), function () {
    Route::get('/', array(
        'uses'  => 'IndexController@index',
        'as'    => 'index.index',
    ));

    Route::post('/upload', array(
        'uses'  => 'UploadController@uploadImage',
        'as'    => 'upload',
    ));

    Route::resource('post', 'PostsController', array(
        'except' => array('show')
    ));

    Route::delete('/category/batch', array(
        'uses'  => 'CategoriesController@batch',
        'as'    => 'category.batch',
    ));

    Route::resource('category', 'CategoriesController', array(
        'except' => array('show')
    ));

    Route::resource('tag', 'TagsController', array(
        'except' => array('show')
    ));
});
