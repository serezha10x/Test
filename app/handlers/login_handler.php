<?php

session_start();

spl_autoload_register(function($class) {
    $path = $_SERVER['DOCUMENT_ROOT'] . '/' . str_replace('\\', '/', $class.'.php');
    if (file_exists($path)) {
        require $path;
    }
});


function login(string $name, string $email) {
    $json_answer = [];
    if (strlen($name) === 0) {
        $json_answer += ['name' => 'Заполните поле "Имя"'];
    }
    if (strlen($email) === 0) {
        $json_answer += ['email' => 'Заполните поле "Email"'];
    }
    $acc_model = new \app\models\AccountModel();
    if (count($json_answer) === 0) {
        if (!$acc_model->Login($name, $email)) {
            $json_answer += ['answer' => 'Пользователь с такими данными не найден...'];
        }
    }
    echo json_encode($json_answer);
}


if (isset($_SESSION['csrf_token']) AND $_SESSION['csrf_token'] === $_POST['csrf_token']) {
    if (isset($_GET['exit']) AND $_GET['exit'] == 1) {
        session_start();
        session_unset();
        \app\core\Router::redirect('/');
    } else {
        login($_POST['name'], $_POST['email']);
    }
}