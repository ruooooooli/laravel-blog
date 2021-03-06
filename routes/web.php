<?php

Route::group([
    'namespace' => 'Frontend',
    'as'        => 'frontend::',
], function () {
    Route::get('/', 'IndexController@index')->name('index.index');
});

Route::group([
    'namespace' => 'Auth',
    'as'        => 'backend::auth.',
    'prefix'    => 'backend',
], function () {

    Route::get('auth/login', [
        'uses'  => 'LoginController@getLogin',
        'as'    => 'login.get',
    ]);

    Route::post('auth/login', [
        'uses'  => 'LoginController@postLogin',
        'as'    => 'login.post',
    ]);

    Route::get('auth/logout', [
        'uses'  => 'LoginController@logout',
        'as'    => 'logout',
    ]);

});

Route::group([
    'namespace'     => 'Backend',
    'prefix'        => 'backend',
    'as'            => 'backend::',
    'middleware'    => 'auth',
], function () {

    Route::get('/', [
        'uses'  => 'IndexController@index',
        'as'    => 'index.index',
    ]);

    Route::match(['post', 'put'], 'upload', [
        'uses'  => 'UploadController@uploadImage',
        'as'    => 'upload',
    ]);

    Route::delete('post/batch', [
        'uses'  => 'PostsController@batch',
        'as'    => 'post.batch',
    ]);

    Route::resource('post', 'PostsController', [
        'except' => ['show']
    ]);

    Route::delete('category/batch', [
        'uses'  => 'CategoriesController@batch',
        'as'    => 'category.batch',
    ]);

    Route::resource('category', 'CategoriesController', [
        'except' => ['show']
    ]);

    Route::delete('tag/batch', [
        'uses'  => 'TagsController@batch',
        'as'    => 'tag.batch',
    ]);

    Route::resource('tag', 'TagsController', [
        'except' => ['show']
    ]);

    Route::delete('user/batch', [
        'uses'  => 'UsersController@batch',
        'as'    => 'user.batch',
    ]);

    Route::resource('user', 'UsersController', [
        'except' => ['show']
    ]);
});
