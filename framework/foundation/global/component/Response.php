<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/7/18
 * Time: 上午 11:11
 */

use App\AppLoader;

class Response
{
    protected $headers = array();
    protected $content = null;
    protected $exceptions = array();
    protected $errors = array();
    protected $viewParameter = array();
    protected $statusCode = 404;
    protected $isHtml = true;
    protected $bladeView;

    public function setIsHtml($boolean)
    {
        $this->isHtml = $boolean;
    }

    public function addHeader($value)
    {
        array_push($this->headers, $value);
    }

    public function setStatusCode($code)
    {
        $this->statusCode = $code;
    }

    public function sendHeader()
    {
        switch ($this->statusCode) {
            case 200 :
                if (is_array($this->headers) and !empty($this->headers)) {
                    foreach ($this->headers as $value) {
                        header($value);
                    }
                }
                break;
            case 301 :
                if (is_array($this->headers) and !empty($this->headers)) {
                    foreach ($this->headers as $value) {
                        header($value);
                    }
                    die();
                }
                break;
            case 302 :
                if (is_array($this->headers) and !empty($this->headers)) {
                    foreach ($this->headers as $value) {
                        header($value);
                    }
                    die();
                }
                break;
        }
    }

    public function setContent($viewFile)
    {
        $this->bladeView = AppLoader::blade()->view();
        $this->content = $viewFile;
    }

    public function sendContent()
    {
        if ($this->content) {
            if ($this->isHtml) {
                if (($this->content)) {
                    try {
                        echo $this->bladeView->make($this->content, $this->viewParameter)->render();
                        $this->setStatusCode(200);
                    } catch (Exception $e) {
                        $this->setStatusCode(500);
                    }

                } else {
                    $this->exceptions[] = new Exception('File : ' . $this->content . ' not found.');
                }
            } else {
                echo $this->content;
            }
        }

        $hasError = (count($this->errors) > 0) ? true : false;
        $hasException = (count($this->exceptions) > 0) ? true : false;

        if (DEBUG_MODE) {
            if ($hasError) {
                $this->setStatusCode(500);
                echo '<b>ERRORS : </b><br/>';
                foreach ($this->errors as $error) {
                    echo $error['errno'] . ' ' . $error['errstr'] . ', ';
                    echo '  Fatal error on line ' . $error['errline'] . ' in file ' . $error['errfile'];
                    echo ', PHP ' . PHP_VERSION . ' (' . PHP_OS . ')<br/>';
                }
            }

            if ($hasException) {
                echo '<b>EXCEPTIONS : </b><br/>';
                foreach ($this->exceptions as $exception) {
                    echo $exception->getMessage() . '<br/>';
                }
            }

            if (!$hasError and !$hasException) {
                $this->setStatusCode(200);
            }
        } else {
            if ($hasError or $hasException) {
                echo 'There is something wrong.';
            }
        }
    }

    public function addError($error)
    {
        $this->errors[] = $error;
    }

    public function addException($exception)
    {
        $this->exceptions[] = $exception;
    }

    public function with($key, $value)
    {
        $this->viewParameter[$key] = $value;
        return $this;
    }

    public function json($array)
    {
        try {
            $this->addHeader('Content-Type: application/json; charset=utf-8');
            $this->content = json_encode($array);
            $this->setIsHtml(false);
            $this->setStatusCode(200);
        } catch (Exception $e) {
            $this->setStatusCode(500);
        }
        return $this;
    }

    public function xml($array)
    {
        try {
            $this->addHeader('Content-Type: application/xml; charset=utf-8');
            $this->content = $this->toXml($array, 'root');
            $this->setIsHtml(false);
            $this->setStatusCode(200);
        } catch (Exception $e) {
            $this->setStatusCode(500);
        }
        return $this;
    }

    public function toXml($data, $rootNodeName = 'data', $xml = null)
    {
        if (ini_get('zend.ze1_compatibility_mode') == 1) {
            ini_set('zend.ze1_compatibility_mode', 0);
        }

        if ($xml == null) {
            $xml = simplexml_load_string("<?xml version='1.0' encoding='utf-8'?><$rootNodeName />");
        }

        foreach ($data as $key => $value) {
            if (is_numeric($key)) {
                $key = "unknownNode_" . (string)$key;
            }
            $key = preg_replace('/[^a-z]/i', '', $key);
            if (is_array($value)) {
                $node = $xml->addChild($key);
                // recrusive call.
                $this->toXml($value, $rootNodeName, $node);
            } else {
                $value = htmlentities($value);
                $xml->addChild($key, $value);
            }

        }
        return $xml->asXML();
    }
}