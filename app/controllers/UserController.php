<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/7/18
 * Time: 上午 02:08
 */

namespace Controllers;


class UserController extends Controller {
    public function index()
    {
        return view('user.home');
    }

    public function show($parameter)
    {
        return view('user.home')->with('id' , $parameter['id']);
    }
}