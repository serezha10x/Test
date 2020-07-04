<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/app/util/CsrfToken.php';
    $csrf = new \app\util\CsrfToken();
?>
<h3>Аутентификация</h3><br/>
<form method="post" id="ajax_form">
    <input name="csrf_token" type="hidden" value="<?= $csrf->getToken(); ?>"/>
    <h5 id="answer"></h5>
	<div class="form-group">
        <label for="inputName">Логин</label>
        <input id="inputName" name="name" class="form-control" type="text" placeholder="Введите логин">
        <small id="nameHelp" class="form-text text-muted"></small>
    </div>
    <div class="form-group">
        <label for="inputEmail">Email</label>
        <input name="email" type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp" placeholder="Введите email">
        <small id="emailHelp" class="form-text text-muted"></small>
    </div>
    <br/><button id="submit" name="submit" type="submit" class="btn btn-primary btn-lg">Войти</button>
</form>
<script src="../app/views/ajax/ajax_login_validation.js"></script>