<?php

namespace app\core;


abstract class Controller {

    public $route;
    public $view;
    public $acl;
    protected $model;


    public function __construct($route) {
        $this->route = $route;
        if (!$this->checkAcl()) {
            //View::errorCode(403);
        }
        $this->model = $this->loadModel($route['controller']);
        $this->view = new View($route);
    }

    public function loadModel($name) {
        $path = 'app\models\\'.ucfirst($name).'Model';
        if (class_exists($path)) {
            return new $path;
        }
    }

    public function checkAcl()  {
        //var_dump($_POST);
        if ($this->route['controller'] === 'api') {
            $info = $_REQUEST;
        } else {
            $info = $_SESSION;
        }
        $this->acl = require 'app/acl/'.$this->route['controller'].'.php';

        if ($this->isAcl('all')) {
            return true;
        }
        elseif (isset($info['name']) and isset($info['email']) and $this->isAcl('authorize')) {
            return true;
        }
        elseif (!isset($info['name']) and !isset($info['email']) and $this->isAcl('guest')) {
            return true;
        }
        elseif (isset($info['name']) and $info['email'] != 0 and $this->isAcl('admin')) {
            return true;
        }
        return false;
    }

    public function isAcl($key) {
        return in_array($this->route['action'], $this->acl[$key]);
    }
}