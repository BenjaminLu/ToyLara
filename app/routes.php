<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/7/17
 * Time: 下午 11:30
 */
use Kernel\Route;

Route::get('/', 'HomeController@index');
Route::get('/user/{id}', 'UserController@show');

