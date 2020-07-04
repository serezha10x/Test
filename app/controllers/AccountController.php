<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Router;
use app\models\AccountModel;

class AccountController extends Controller {

    public function __construct($route) {
        parent::__construct($route);
        $this->model->Register('seasd2323','f23213dasdsf','sdfdsf');
    }

	public function loginAction() {
        $vars = ['name' => $_SESSION['name']];
        $this->view->render('Вход', $vars);
	}

	public function registerAction() {
        $vars = ['name' => $_SESSION['name']];
        $this->view->render('Регистрация', $vars);
	}
}