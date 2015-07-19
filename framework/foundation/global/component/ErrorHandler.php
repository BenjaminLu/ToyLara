<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/7/19
 * Time: 下午 11:58
 */

class ErrorHandler {
    private $errors = array();

    public function attachErrorToResponse(Response $response)
    {
        foreach($this->errors as $error) {
            $response->addError($error);
        }
    }

    public function handleError($errno, $errstr, $errfile, $errline)
    {
        if (!(error_reporting() & $errno)) {
            // This error code is not included in error_reporting
            return;
        }
        /* these marked code will be moved to Response object later
        switch ($errno) {
            case E_USER_ERROR:
                echo "<b>My ERROR</b> [$errno] $errstr<br />\n";
                echo "  Fatal error on line $errline in file $errfile";
                echo ", PHP " . PHP_VERSION . " (" . PHP_OS . ")<br />\n";
                echo "Aborting...<br />\n";
                exit(1);
                break;

            case E_USER_WARNING:
                echo "<b>My WARNING</b> [$errno] $errstr<br />\n";
                break;

            case E_USER_NOTICE:
                echo "<b>My NOTICE</b> [$errno] $errstr<br />\n";
                break;

            default:
                echo "Unknown error type: [$errno] $errstr<br />\n";
                break;
        }*/

        //add error to response
        //$this->response->addError();
        array_push($this->errors, array(
            'errno' => $errno,
            'errstr' => $errstr,
            'errfile' => $errfile,
            'errline' =>$errline
        ));

        /* Don't execute PHP internal error handler */
        return true;
    }
}