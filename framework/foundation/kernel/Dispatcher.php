<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/7/17
 * Time: 下午 11:11
 */

namespace Kernel;


use Foundation\Component\Request;
use Foundation\Component\Response;

class Dispatcher
{
    public function dispatch(Request $request)
    {
        $parameter = null;
        $controllerName = null;
        $action = null;
        $response = new Response();
        require APP_DIR . 'routes.php';
        $rules = Route::rules();
        $uri = $request->getUri();
        $firstMatched = $this->matchFirstUriRule($uri, $rules);
        if(isset($firstMatched)) {
            $temp = explode('@', $firstMatched['rule']);
            $parameter = $firstMatched['parameter'];
            $controllerName = '\Controllers\\' . $temp[0];
            $action = $temp[1];
        }

        if (class_exists($controllerName)) {
            $controller = new $controllerName;
            $response = $controller->$action($parameter);
            return $response;
        } else {
            return abort(404);
        }
    }

    private function matchFirstUriRule($uri, $rules)
    {
        $uriParts = explode('/', $uri);

        $parameter = array();
        foreach($rules as $key => $value) {
            $isMatched = true;
            $keyParts = explode('/', $key);
            //remove null before first slash
            array_splice($keyParts, 0 , 1);

            if(sizeof($uriParts) != sizeof($keyParts)) {
                continue;
            }

            for($i = 0 ; $i < sizeof($keyParts); $i++) {
                $matches = $this->getStringBetweenCurlyBrackets($keyParts[$i]);
                if(sizeof($matches) == 1) {
                    $variableName = $matches[0];
                    //store parameter key => value for controller action parameter
                    $parameter[$variableName] = $uriParts[$i];
                } else {
                    //if not the curly bracket, strings between slashes needs to be the same;
                    if(strcmp($keyParts[$i], $uriParts[$i]) === 0) {
                        continue;
                    } else {
                        $isMatched = false;
                    }
                }
            }

            if($isMatched == true) {
                return array(
                    'rule' => $value,
                    'parameter' => $parameter
                );
            } else {
                return null;
            }
        }
    }

    function getStringBetweenCurlyBrackets($string)
    {
        preg_match_all('/{(.*?)}/', $string, $matches);
        return $matches[1];
    }

}