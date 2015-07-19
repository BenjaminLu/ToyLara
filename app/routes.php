<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/7/17
 * Time: 下午 11:30
 */

Route::get('/', 'HomeController@index');
Route::get('/show/xml', 'HomeController@showXml');
Route::get('/show/json', 'HomeController@showJson');

Route::get('/user', 'UserController@index');
Route::get('/user/{id}', 'UserController@show');
Route::post('/user/{id}', 'UserController@store');