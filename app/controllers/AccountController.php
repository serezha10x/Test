<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Router;
use app\models\AccountModel;

class AccountController extends Controller {

    public function __construct($route) {
        parent::__construct($route);
    }

	public function loginAction() {
        $vars = ['login' => $_COOKIE['login']];
        $this->view->render('Вход', $vars);
	}

	public function registerAction() {
		$this->view->render('Регистрация');
	}
}