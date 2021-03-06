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

// Homepage
Route::get('/', 'PageController@welcome')->name('welcome');
Route::get('permission-denied', 'PageController@permissionDenied')->name('permission-denied');

// Authentication Routes
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

// User Routes
Route::resource('user', 'UserController', ['only' => ['update', 'edit']]);
Route::get('user/{user}/{tab?}', 'UserController@show')->name('user.show');

// Course Routes
Route::resource('course', 'CourseController', ['only' => ['show', 'create', 'store', 'update', 'edit']]);
Route::get('course/{course}/chapters', 'CourseController@chapters')->name('course.chapters');

// Topic Routes
Route::resource('topic', 'TopicController', ['only' => ['create', 'store', 'update', 'edit', 'destroy']]);
Route::get('course/{course}/topic/{topic}/{slug?}', 'TopicController@show')->name('topic.show');
Route::post('upload_image', 'TopicController@uploadImage')->name('topic.upload_image');
Route::get('topic/{topic}/vote', 'TopicController@vote')->name('topic.vote');

// Comment Routes
Route::resource('comment', 'CommentController', ['only' => ['store', 'destroy']]);
Route::get('comment/{comment}/vote/{action?}', 'CommentController@vote')->name('comment.vote');