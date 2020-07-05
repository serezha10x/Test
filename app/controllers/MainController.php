<?php

namespace app\controllers;

use app\core\Controller;
use app\util\Mailer;

class MainController extends Controller {

	public function indexAction() {

        $vars = [];
	    if (isset($_SESSION['name']) AND isset($_SESSION['email'])) {
	        if ($_SESSION['sort_type'] != NULL) {
                $users = $this->model->ReadUsers($_SESSION['sort_type'], $this->model->offset, $this->model->limit);
            } else {
                $users = $this->model->ReadUsers($this->model->sort_default, $this->model->offset, $this->model->limit);
            }
            $vars = [
                'name'         => $_SESSION['name'],
                'users'        => $users,
                'count'        => $this->model->getCountPage(),
                'current_page' => $this->model->getCurrentPage()
            ];
        } else {
	        $vars = [
	            'message' => 'Авторизуйтесь для просмотра других пользователей'
            ];
        }
        $this->view->render('Главная страница', $vars);
    }
}