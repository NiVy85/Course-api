<?php

namespace Courses\Core;

class Request {
    const GET = 'GET';
    const POST = 'POST';
    const PUT = 'PUT';
    const DELETE = 'DELETE';

    private $domain;
    private $path;
    private $method;
    private $params;
    private $cookies;

    public function __construct() {
        $this->domain = $_SERVER['HTTP_HOST'];
        $this->path = explode('?', ['REQUEST_URI'])[0];
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->params = new FilterMap(array_merge($_GET, $_POST));
        $this->cookies = new FilterMap($_COOKIE);
    }

    public function getUrl() : string {
        return $this->domain . $this->path;
    }

    public function getDomain() : string {
        return $this->domain;
    }

    public function getPath() : string {
        return $this->path;
    }

    public function getMethod() : string {
        return $this->method;
    }

    public function isGet() : bool {
        return $this->method === self::GET;
    }

    public function isPost() : bool {
        return $this->method === self::POST;
    }

    public function isPut() : bool {
        return $this->method === self::PUT;
    }

    public function isDelete() : bool {
        return $this->method === self::DELETE;
    }

    public function getParams(): FilterMap
    {
        return $this->params;
    }

    public function getCookies(): FilterMap
    {
        return $this->cookies;
    }
}

