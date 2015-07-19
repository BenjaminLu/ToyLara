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
    $viewPath = str_replace('.', '/', $viewFile);
    $unprocessedView = file_get_contents(VIEW_DIR . $viewPath . '.php');
    //replace {{$i}} to php echo function
    $pattern = array("{{", "}}");
    $replacement = array("<?php echo htmlentities(", ");?>");

    $compiledView = str_replace($pattern, $replacement, $unprocessedView);
    $cacheFile = APP_DIR . 'cache/views/' . md5(time()) . '.php';
    //make cache view
    file_put_contents($cacheFile, $compiledView);

    $response->addHeader('Content-Type: text/html; charset=utf-8');
    $response->setContent($cacheFile);
    $response->setStatusCode(200);
    return $response;
}

function abort($code)
{
    $response = new Response();
    $response->addHeader('Content-Type: text/html; charset=utf-8');
    $response->setStatusCode(200);
    $errorPagePath = VIEW_DIR . 'error/' . $code . '.php';
    $response->setContent($errorPagePath);
    return $response;
}

function redirect($url)
{
    $response = new Response();
    $completeURL = url($url);
    $response->addHeader('HTTP/1.1 302 Found');
    $response->addHeader("Location: " . $completeURL);
    $response->setStatusCode(301);
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
    $response->setIsHtml(false);
    $response->setStatusCode(200);
    return $response;
}