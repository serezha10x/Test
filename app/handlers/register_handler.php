<?php

session_start();

spl_autoload_register(function($class) {
    $path = $_SERVER['DOCUMENT_ROOT'] . '/' . str_replace('\\', '/', $class.'.php');
    if (file_exists($path)) {
        require $path;
    }
});


function register(string $name, string $email, $image) {
    /*$hash = preg_replace('@[/\\|]@', '', password_hash(microtime(), PASSWORD_DEFAULT));
    $uploads_dir = $_SERVER['DOCUMENT_ROOT'] . '/photos/';
    $_FILES['image']['name'] = $hash;
    $uploadfile = ($uploads_dir . basename($_FILES['image']['name']) . '.jpg');
    $img = imagecreatefromjpeg($_FILES['image']['tmp_name']);
    $new_image_name = $hash . '.webp';

    imagepalettetotruecolor($img);
    imagealphablending($img, true);
    imagesavealpha($img, true);

    $im1 = imagecreatetruecolor(100, 100);
    imagecopyresampled($im1, $img, 0, 0, 0, 0, 100, 100, imagesx($img), imagesy($img));

    imagewebp($im1, $uploads_dir . $new_image_name, 75);
    imagedestroy($img);
    imagedestroy($im1);*/
    $image_formater = new \app\util\ImageFormater();
    $new_image_name = $image_formater->saveImage($image, 125, 75, $_SERVER['DOCUMENT_ROOT'] . '/photos/', 'webp');

    $acc_model = new \app\models\AccountModel();
    $acc_model->Register($name, $email, $new_image_name);
    session_write_close();
}


function checkTextField(string $name, string $email, string $captcha)
{
    $json_answer = [];
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
    $json_answer = [];
    $image_arr = pathinfo($file['name']);
    $image_ext = $image_arr['extension'];
    $formats = require $_SERVER['DOCUMENT_ROOT'].'/app/config/image_formats.php';
    if ($file === null) {
        $json_answer += ['image' => 'Выберите фотограцию'];
    } else if (!in_array($image_ext, $formats)) {
        $json_answer += ['image' => 'Данный формат изображения не поддерживается'];
    }
    return $json_answer;
}


if (isset($_POST['name'])) {
    $text_check = checkTextField($_POST['name'], $_POST['email'], $_POST['captcha']);
    if (count($text_check) == 0) {
        $_SESSION['text_check'] = true;
        $_SESSION['name']       = $_POST['name'];
        $_SESSION['email']      = $_POST['email'];
    } else {
        $_SESSION['text_check'] = false;
        echo json_encode($text_check);
    }
} else {
    $image_check = checkFileField($_FILES['image']);
    if (count($image_check) == 0) {
        $_SESSION['image_check'] = true;
    } else {
        $_SESSION['image_check'] = false;
        echo json_encode($image_check);
    }
}


if ($_SESSION['text_check'] === true AND $_SESSION['image_check'] === true AND isset($_FILES['image'])) {
    register($_SESSION['name'], $_SESSION['email'], $_FILES['image']);
    echo json_encode(['status' => 'ok']);
} else {
    echo json_encode(['status' => 'no ok']);
}

session_write_close();