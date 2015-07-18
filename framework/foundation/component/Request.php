<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/7/17
 * Time: 下午 08:48
 */

namespace Foundation\Component;


class Request
{
    protected $baseUrl;
    protected $uri;
    protected $parameters;

    public function setBaseUrl($url)
    {
        $this->baseUrl = $url;
        return $this;
    }

    public function setParameters($params)
    {
        $this->parameters = $params;
        return $this;
    }

    public function getParameters()
    {
        if ($this->parameters == null) {
            $this->parameters = array();
        }
        return $this->parameters;
    }

    public function getParam($name, $default = null)
    {
        if (isset($this->parameters[$name])) {
            return $this->parameters[$name];
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