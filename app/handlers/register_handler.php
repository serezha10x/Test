<?php


session_start();

spl_autoload_register(function($class) {
    $path = $_SERVER['DOCUMENT_ROOT'] . '/' . str_replace('\\', '/', $class.'.php');
    if (file_exists($path)) {
        require $path;
    }
});



function register(string $name, string $email, $image) {
    $image_formater = new \app\util\ImageFormater();
    $new_image_name = $image_formater->saveImage($image, 125, 75, $_SERVER['DOCUMENT_ROOT'] . '/photos/', 'webp');
    $acc_model = new \app\models\AccountModel();
    $acc_model->Register($name, $email, $new_image_name);
}


function checkTextField(string $name, string $email, string $captcha)
{
    $json_answer = ['checkTextField' => 'on'];
    if (strlen($name) < 2) {
        $json_answer += ['name' => 'Заполните поле "Имя"'];
    } else if (strlen($name) > 30) {
        $json_answer += ['name' => 'Поле "Имя" не может превышать 30 символов'];
    }
    if (strlen($email) === 0) {
        $json_answer += ['email' => 'Заполните поле "Email"'];
    } elseif (strlen($email) > 50) {
        $json_answer += ['email' => 'Поле "Email" не может превышать 50 символов'];
    } else if (!preg_match("@\b[A-Za-z0-9._%+-]+\@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}\b@u", $email)) {
        $json_answer += ['email' => 'Введите корректный email"'];
    }
    if (strlen($captcha) === 0) {
        $json_answer += ['captcha' => 'Заполните поле "Captcha"'];
    } else if ($_SESSION['captcha'] !== $captcha) {
        $json_answer += ['captcha' => 'Captcha введена неверно'];
    }
    return $json_answer;
}


function checkFileField($file) {
    $json_answer = ['checkFileField' => 'on'];
    if ($file === null) {
        $json_answer += ['image' => 'Выберите фотографию'];
    } else if (!\app\util\FileVerification::CheckFormat($file['type'])) {
        $json_answer += ['image' => 'Данный формат изображения не поддерживается'];
    }
    return $json_answer;
}


if (isset($_POST['name'])) {
    $text_check = checkTextField($_POST['name'], $_POST['email'], $_POST['captcha']);
    if (count($text_check) === 1) {
        $_SESSION['text_check'] = true;
        $_SESSION['name']       = $_POST['name'];
        $_SESSION['email']      = $_POST['email'];
    } else {
        $_SESSION['text_check'] = false;
        echo json_encode($text_check);
    }
} else {
    $image_check = checkFileField($_FILES['image']);
    if (count($image_check) === 1) {
        $_SESSION['image_check'] = true;
    } else {
        $_SESSION['image_check'] = false;
        echo json_encode($image_check);
    }
}


if ($_SESSION['text_check'] === true AND $_SESSION['image_check'] === true AND isset($_FILES['image'])) {
    register($_SESSION['name'], $_SESSION['email'], $_FILES['image']);
    echo json_encode(['status'=>'ok']);
}

session_write_close();