<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/7/18
 * Time: 下午 09:35
 */

namespace Foundation\Component;

class Log
{
    public static function info($message)
    {
        $filename = APP_DIR . 'log/' . date('Y-m-d') . '.txt';
        $datetime = date("Y-m-d H:i:s");
        $level = ' info ';
        $logContent = $message . PHP_EOL;
        file_put_contents($filename, $datetime . $level . $logContent, FILE_APPEND | LOCK_EX);
    }

    public static function warning($message)
    {
        $filename = APP_DIR . 'log/' . date('Y-m-d') . '.txt';
        $datetime = date("Y-m-d H:i:s");
        $level = ' warning ';
        $logContent = $message . PHP_EOL;
        file_put_contents($filename, $datetime . $level . $logContent, FILE_APPEND | LOCK_EX);
    }

    public static function error($message)
    {
        $filename = APP_DIR . 'log/' . date('Y-m-d') . '.txt';
        $datetime = date("Y-m-d H:i:s");
        $level = ' error ';
        $logContent = $message . PHP_EOL;
        file_put_contents($filename, $datetime . $level . $logContent, FILE_APPEND | LOCK_EX);
    }
}