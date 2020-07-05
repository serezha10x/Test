<?php

    session_start();
    require_once $_SERVER['DOCUMENT_ROOT'].'/app/core/Router.php';

    if (isset($_POST['submit'])) {
        $_SESSION['sort_type'] = $_POST['sort'];
        \app\core\Router::redirect('/');
    }
