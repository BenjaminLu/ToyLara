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
    public function addHeader($value) {
        array_push($this->headers, $value);
    }

    public function sendHeader()
    {
        if(is_array($this->headers) && !empty($this->headers)) {
            foreach($this->headers as $value) {
                header($value);
            }
        }
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function sendContent()
    {
        foreach($this->viewParameter as $key => $value) {
            global $$key;
            $$key = $value;
        }

        require $this->content;
    }

    public function with($key, $value)
    {
        $this->viewParameter[$key] = $value;
        return $this;
    }
}