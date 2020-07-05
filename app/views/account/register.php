<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/app/util/CsrfToken.php';
    $csrf = new \app\util\CsrfToken();
?>
<h3>Регистрация</h3>
<h5>*Для лучшего отображения вашего фото рекомендуем использовать соотношение 1:1</h5><br/>
<form method="post" id="ajax_form" enctype="multipart/form-data">
    <input name="csrf_token" type="hidden" value="<?= $csrf->getToken(); ?>"/>
    <div class="form-group">
        <label for="inputName">Логин</label>
        <input id="inputName" name="name" class="form-control" type="text" placeholder="Введите логин">
        <small id="nameHelp" class="form-text text-danger"></small>
    </div>
    <div class="form-group">
        <label for="inputEmail">Email</label>
        <input name="email" type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp" placeholder="Введите email">
        <small id="emailHelp" class="form-text text-danger">Вы будем распространять ваш электронный адрес</small>
    </div>
    <div class="custom-file">
        <label class="custom-file-label" for="customFile">Выбрать файл</label>
        <input id='image' name="image" type="file" class="custom-file-input" id="customFile">
        <small id="imageHelp" class="form-text text-danger"></small>
    </div>
    <?php
        $captcha = new \app\util\Captcha();
        $captcha->createImage();
        $captcha->display();
    ?>
    <div class="form-group">
        <label for="inputCaptcha">Капча</label>
        <input id="inputCaptcha" name="captcha" class="form-control" type="text" placeholder="Введите капчу">
        <small id="captchaHelp" class="form-text text-danger"></small>
    </div>
    <br/><button id="submit" name="submit" type="submit" class="btn btn-primary btn-lg">Зарегистрироваться</button>
</form>
<script src="../app/views/ajax/ajax_register_validation.js"></script>