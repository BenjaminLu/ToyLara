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
    public function __construct()
    {
        $this->loadComponents();
        $this->loadRoutes();
        $this->loadViewHelpers();
    }

    public function loadComponents()
    {
        require 'component/ErrorHandler.php';
        require 'component/ExceptionHandler.php';
        require 'component/Log.php';
        require 'component/Request.php';
        require 'component/Response.php';
    }

    public function loadRoutes()
    {
        require 'route/route.php';
    }

    public function loadViewHelpers()
    {
        require 'helper/response.helper.php';
    }
}