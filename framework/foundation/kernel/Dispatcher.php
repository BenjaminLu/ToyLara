<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/7/17
 * Time: 下午 11:11
 */

namespace Kernel;

use ErrorHandler;
use Request;
use Response;
use Route;

class Dispatcher
{
    public function dispatch(Request $request)
    {
        $parameter = null;
        $controllerName = null;
        $action = null;
        //read user routing
        require APP_DIR . 'routes.php';

        $postParameters = $request->postParameters();
        if (sizeof($postParameters) <= 0) {
            //GET
            $request->setType(Request::TYPE_GET);
            $getRules = Route::getRules();
            $uri = $request->getUri();
            $response = $this->matchAndExec($request, $uri, $getRules);
            return $response;
        } else {
            //POST
            $request->setType(Request::TYPE_POST);
            $postRules = Route::postRules();
            $uri = $request->getUri();
            $response = $this->matchAndExec($request, $uri, $postRules);
            return $response;
        }
    }

    private function matchAndExec(Request $request, $uri, $rules)
    {
        $firstMatched = $this->matchFirstUriRule($uri, $rules);
        if (isset($firstMatched)) {
            $temp = explode('@', $firstMatched['rule']);
            $urlParameter = $firstMatched['parameter'];

            foreach ($urlParameter as $key => $value) {
                if ($request->getType() == Request::TYPE_GET) {
                    $request->setGetParameter($key, $value);
                } else {
                    $request->setPostParameter($key, $value);
                }
            }
            $controllerName = '\Controllers\\' . $temp[0];
            $action = $temp[1];
            if (class_exists($controllerName)) {
                //install independent error handler to each request scope
                $errorHandler = new ErrorHandler();
                set_error_handler(array($errorHandler, 'handleError'));
                $controller = new $controllerName;
                $response = $controller->$action($request);
                $errorHandler->attachErrorToResponse($response);
                return $response;
            }
        }
        return abort(404);
    }

    private function matchFirstUriRule($uri, $rules)
    {
        $uriParts = explode('/', $uri);
        $parameter = array();
        //get rules
        foreach ($rules as $key => $value) {
            $keyParts = explode('/', $key);
            //remove null before first slash
            array_splice($keyParts, 0, 1);

            if (count($uriParts) != count($keyParts)) {
                continue;
            }
            //match strings between slash
            $length = count($keyParts);
            $lastIndex = ($length - 1);
            for ($i = 0; $i < $length; $i++) {
                $matches = $this->getStringBetweenCurlyBrackets($keyParts[$i]);
                if (count($matches)) {
                    $variableName = $matches[0];
                    //store parameter key => value for controller action parameter
                    $parameter[$variableName] = $uriParts[$i];
                } else {
                    //if not the curly bracket, strings between slashes needs to be the same;
                    if (strcmp($keyParts[$i], $uriParts[$i]) !== 0) {
                        break;
                    }
                }

                if ($i == $lastIndex) {
                    //match routes rule
                    return array(
                        'rule' => $value,
                        'parameter' => $parameter
                    );
                }
            }
        }
        return null;
    }

    function getStringBetweenCurlyBrackets($string)
    {
        preg_match_all('/{(.*?)}/', $string, $matches);
        return $matches[1];
    }
}