<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/7/18
 * Time: 上午 01:39
 */

namespace App;


use Philo\Blade\Blade;

class AppLoader
{
    private static $blade;

    public static function initialize()
    {
        static::$blade = new Blade(VIEW_DIR, CACHE_DIR);
        static::loadDatabaseConnections();
        static::loadComponents();
        static::loadRoutes();
        static::loadViewHelpers();
    }

    public static function blade()
    {
        return static::$blade;
    }

    public static function loadDatabaseConnections()
    {
        require 'database/Database.php';
    }

    public static function loadComponents()
    {
        require 'component/ErrorHandler.php';
        require 'component/Log.php';
        require 'component/Request.php';
        require 'component/Response.php';
    }

    public static function loadRoutes()
    {
        require 'route/route.php';
    }

    public static function loadViewHelpers()
    {
        require 'helper/response.helper.php';
    }
}