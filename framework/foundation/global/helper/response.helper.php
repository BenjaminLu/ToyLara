<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/7/18
 * Time: 上午 01:39
 */

function view($viewFile)
{
    $response = new Response();
    $response->addHeader('Content-Type: text/html; charset=utf-8');
    $response->setIsHtml(true);
    $response->setContent($viewFile);
    return $response;
}

function abort($code)
{
    $response = new Response();
    $response->addHeader('Content-Type: text/html; charset=utf-8');
    $response->setIsHtml(true);
    $response->setContent('error.' . $code);
    return $response;
}

function redirect($url)
{
    $response = new Response();
    $completeURL = url($url);
    $response->addHeader('HTTP/1.1 302 Found');
    $response->addHeader("Location: " . $completeURL);
    $response->setStatusCode(302);
    return $response;
}

function url($url)
{
    $domain = $_SERVER['HTTP_HOST'];
    $completeURL = "http://" . $domain . $url;
    return $completeURL;
}

function response()
{
    $response = new Response();
    return $response;
}