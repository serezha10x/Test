<?php


spl_autoload_register(function($class) {
    $path = $_SERVER['DOCUMENT_ROOT'] . '/' . str_replace('\\', '/', $class.'.php');
    if (file_exists($path)) {
            require $path;
    }
});


function login(string $name, string $email) {
    if (strlen($name) != 0 AND strlen($email) != 0) {
        $acc_model = new \app\models\AccountModel();
        if (!$acc_model->Login($name, $email)) {
            //\app\core\View::errorCode('403');
        }
    }
}


if (isset($_POST['submit'])) {
    if (isset($_GET['exit']) AND $_GET['exit'] == 1) {
        session_start();
        session_unset();
        \app\core\Router::redirect('/');
    } else {
        login($_POST['name'], $_POST['email']);
    }
}