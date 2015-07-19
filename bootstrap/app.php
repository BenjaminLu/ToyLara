<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/7/18
 * Time: 上午 11:03
 */

use App\AppLoader;

define('APP_DIR', dirname(__DIR__) . '/app/');
define('VIEW_DIR', APP_DIR . 'views/');
define('DEBUG_MODE', true);

new AppLoader();