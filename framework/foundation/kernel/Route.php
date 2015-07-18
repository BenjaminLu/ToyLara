<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/7/17
 * Time: 下午 11:31
 */

namespace Kernel;


class Route {
    private static $rules = array();
    public static function get($pattern = '', $controllerAndAction = '')
    {
        static::$rules[$pattern] = $controllerAndAction;
    }

    public static function rules()
    {
        return static::$rules;
    }
}