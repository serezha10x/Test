<?php

namespace app\core;

use app\core\View;

class Router {

    protected $routes = [];
    protected $params = [];

    public function __construct() {
        $arr = [];
        $arr[] = require 'app/routes/web.php';
        $arr[] = require 'app/routes/api.php';
        foreach ($arr as $routes) {
            foreach ($routes as $key => $val) {
                $this->add($key, $val);
            }
        }
    }

    public function add($route, $params) {
        $route = '#(^'.$route.'$)|('.$route.'\?.*)#';
        $this->routes[$route] = $params;
    }

    public function match() {
        // delete first slash
        $url = trim($_SERVER['REQUEST_URI'], '/');
        // delete get params
        //$url = mb_substr($url, 0, mb_stripos($url, '?'));

        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                $this->params = $params;
                return true;
            }
        }
        return false;
    }

    public function run() {
        if ($this->match()) {
            $path = 'app\controllers\\'.ucfirst($this->params['controller']).'Controller';
            if (class_exists($path)) {
                $action = $this->params['action'].'Action';
                if (method_exists($path, $action)) {
                    $controller = new $path($this->params);
                    $controller->$action();
                } else {
                    View::errorCode(404);
                }
            } else {
                View::errorCode(404);
            }
        } else {
           View::errorCode(404);
        }
    }

    static public function redirect($url) {
        header('Location: ' . $url);
        session_write_close();
        exit();
    }
}