<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/7/18
 * Time: 上午 02:08
 */

namespace Controllers;


use Foundation\Component\Request;

class UserController extends Controller {
    public function index()
    {
        return view('user.home');
    }

    public function show(Request $request)
    {
        $params = $request->getParameters();
        return view('user.home')->with('params' , $params);
    }

    public function store(Request $request)
    {
        $postParameters = $request->postParameters();
        return view('user.home')->with('params', $postParameters);
    }
}