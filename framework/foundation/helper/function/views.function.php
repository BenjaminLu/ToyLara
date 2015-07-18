<?php
use Foundation\Component\Response;

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
    //exec php code in view;
    ob_start();
    require VIEW_DIR . $viewPath . '.php';
    $unprocessedView = ob_get_clean();
    //replace {{$i}} to php echo function

    $pattern = array("{{", "}}");
    $replacement = array("<?php echo ", ";?>");

    $compiledView = str_replace($pattern, $replacement, $unprocessedView);
    $cacheFile = APP_DIR . 'cache/views/'. md5(time()) . '.php';
    //make cache view
    file_put_contents($cacheFile, $compiledView);

    $response->addHeader('Content-Type: text/html; charset=utf-8');
    $response->setContent($cacheFile);
    return $response;
}

function abort($code)
{
    require VIEW_DIR . 'error/' . $code . '.php';
}