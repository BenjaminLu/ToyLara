<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/7/17
 * Time: 下午 08:48
 */
class Request
{
    const TYPE_GET = 0;
    const TYPE_POST = 1;
    protected $type = Request::TYPE_GET;
    protected $baseUrl;
    protected $uri;
    protected $getParametersArray = array();
    protected $postParametersArray = array();

    public function __construct()
    {
        foreach ($_POST as $key => $value) {
            $this->postParametersArray[$key] = $value;
        }

        foreach ($_GET as $key => $value) {
            $this->getParametersArray[$key] = $value;
        }
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function setBaseUrl($url)
    {
        $this->baseUrl = $url;
        return $this;
    }

    public function setGetParameter($key, $value)
    {
        $this->getParametersArray[$key] = $value;
        return $this;
    }

    public function setPostParameter($key, $value)
    {
        $this->postParametersArray[$key] = $value;
        return $this;
    }

    public function getParameters()
    {
        if ($this->getParametersArray == null) {
            $this->getParametersArray = array();
        }
        return $this->getParametersArray;
    }

    public function postParameters()
    {
        if ($this->postParametersArray == null) {
            $this->postParametersArray = array();
        }
        return $this->postParametersArray;
    }

    public function getParameter($name, $default = null)
    {
        if (isset($this->getParametersArray[$name])) {
            return $this->getParametersArray[$name];
        }
        return $default;
    }

    public function getRequestUri()
    {
        if (!isset($_SERVER['REQUEST_URI'])) {
            return '';
        }

        $uri = $_SERVER['REQUEST_URI'];
        $uri = trim(str_replace($this->baseUrl, '', $uri), '/');
        $hasTraditionalURLParametersIndex = strpos($uri, '?');
        if ($hasTraditionalURLParametersIndex) {
            $uri = substr($uri, 0, $hasTraditionalURLParametersIndex);
        }

        return $uri;
    }

    public function createRequest()
    {
        $uri = $this->getRequestUri();
        $this->uri = $uri;
        return $this;
    }

    public function getUri()
    {
        return $this->uri;
    }
}