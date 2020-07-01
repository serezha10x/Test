<?php

namespace app\controllers;

use app\core\Controller;

class MainController extends Controller {

	public function indexAction() {
	    $vars = [];
	    if (isset($_SESSION['name']) AND isset($_SESSION['email'])) {
	        if ($_SESSION['sort_type'] != NULL) {
                $users = $this->model->ReadUsers($_SESSION['sort_type']);
            } else {
                $users = $this->model->ReadUsers();
            }
            $vars = [
                'name' => $_SESSION['name'],
                'users' => $users
            ];
        }
        $this->view->render('Главная страница', $vars);
    }
}