<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/7/17
 * Time: 下午 09:06
 */

namespace Controllers;

use Foundation\Component\Request;

class HomeController extends Controller {

    public function index(Request $request)
    {
        return view('home')->with('hi', 'hi message')->with('cool', 'cool message');
    }
}