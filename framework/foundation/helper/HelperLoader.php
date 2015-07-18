<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/7/18
 * Time: 上午 01:39
 */

namespace Helper;


class HelperLoader {
    public function __construct ()
    {
        $this->loadViewFunctions();
    }

    public function loadViewFunctions()
    {
        require 'function/views.function.php';
    }
}