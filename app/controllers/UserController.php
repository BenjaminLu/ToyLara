<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/7/18
 * Time: 上午 02:08
 */

namespace Controllers;

use Request;

class UserController extends Controller
{
    public function index()
    {
       1/0;
        return abort(402);
    }

    public function show(Request $request)
    {
        $params = $request->getParameters();
        return view('user.home')->with('params', $params);
    }

    public function store(Request $request)
    {
        $postParameters = $request->postParameters();
        return view('user.home')->with('params', $postParameters);
    }
}