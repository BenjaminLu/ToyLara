<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/7/19
 * Time: 下午 11:25
 */
class Route
{
    private static $getRules = array();
    private static $postRules = array();

    public static function get($pattern, $controllerAndAction)
    {
        static::$getRules[$pattern] = $controllerAndAction;
    }

    public static function post($pattern, $controllerAndAction)
    {
        static::$postRules[$pattern] = $controllerAndAction;
    }

    public static function getRules()
    {
        return static::$getRules;
    }

    public static function postRules()
    {
        return static::$postRules;
    }
}