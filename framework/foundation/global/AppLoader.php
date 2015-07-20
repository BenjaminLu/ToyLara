<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/7/18
 * Time: 上午 01:39
 */

namespace App;


class AppLoader
{
    public static function initialize()
    {
        static::loadDatabaseConnections();
        static::loadComponents();
        static::loadRoutes();
        static::loadViewHelpers();
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