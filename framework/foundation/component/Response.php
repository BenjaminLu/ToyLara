<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/7/18
 * Time: 上午 11:11
 */

namespace Foundation\Component;


class Response
{
    protected $headers = array();
    protected $content = null;
    protected $viewParameter = array();
    protected $statusCode = 404;

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

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function sendContent()
    {
        if (sizeof($this->viewParameter) > 0) {
            foreach ($this->viewParameter as $key => $value) {
                global $$key;
                $$key = $value;
            }
        }

        if ($this->content) {
            require $this->content;
        }
    }

    public function with($key, $value)
    {
        $this->viewParameter[$key] = $value;
        return $this;
    }
}