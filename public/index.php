<?php
require '../vendor/autoload.php';

use Kernel\Dispatcher;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/7/17
 * Time: 下午 08:14
 */

//Load global helper function
require dirname(__DIR__) . '/bootstrap/app.php';
$request = new Request();
$request->setBaseUrl($_SERVER['HTTP_HOST']);
$request->createRequest();
$response = Dispatcher::dispatch($request);
$response->sendContent();
$response->sendHeader();