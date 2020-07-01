<?php

    require_once $_SERVER['DOCUMENT_ROOT'].'/app/core/Router.php';

    if (isset($_GET['submit'])) {
        $_SESSION['sort'] = $_GET['sort'];
        \app\core\Router::redirect('/');
    }
