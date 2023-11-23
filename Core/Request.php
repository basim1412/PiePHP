<?php

namespace Core;

class Request
{
    private $get;
    private $post;

    public function __construct()
    {
        $this->get = $this->clear($_GET);
        $this->post = $this->clear($_POST);
    }

    public function get($key)
    {
        return isset($this->get[$key]) ? $this->get[$key] : null;
    }

    public function GetParams()
    {
        return $this->post;
    }

    public function GetQueryParams()
    {
        return $this->get;
    }

    public function post($key)
    {
        return isset($this->post[$key]) ? $this->post[$key] : null;
    }

    private function clear($data)
    {
        $clearData = [];
        foreach ($data as $key => $value) {
            $clearData[$key] = htmlspecialchars(stripslashes(trim($value)));
        }
        return $clearData;
    }
}
