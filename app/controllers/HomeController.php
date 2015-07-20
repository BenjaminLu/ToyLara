<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/7/17
 * Time: 下午 09:06
 */

namespace Controllers;

use DB;

class HomeController extends Controller
{
    public function index()
    {
        return view('home')->with('name', 'Ben');
    }

    public function showXml()
    {
        $array = [
            'Good guy' => [
                'name' => 'Luke Skywalker',
                'weapon' => 'Lightsaber'
            ],
            'Bad guy' => [
                'name' => 'Sauron',
                'weapon' => 'Evil Eye'
            ]
        ];
        return response()->xml($array);
    }

    public function showJson()
    {
        $data = array(
            'para1' => 'data1',
            'para2' => 'data2',
            'para3' => 'data3',
            'para4' => 'data4',
            'para5' => array(
                'innerPara' => array(
                    '1', '2', '3'
                )
            ),
        );
        return response()->json($data);
    }
}