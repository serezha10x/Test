<?php

session_start();

spl_autoload_register(function($class) {
    $path = $_SERVER['DOCUMENT_ROOT'] . '/' . str_replace('\\', '/', $class.'.php');
    if (file_exists($path)) {
        require $path;
    }
});


function register(string $name, string $email, string $image) {
    if (strlen($name) != 0 AND strlen($email) != 0 AND strlen($image) != 0) {
        if (App\Util\FileVerification::CheckFormat($_FILES['image']['type'])) {
            if ($_SESSION['captcha'] === $_POST['captcha']) {
                $hash = preg_replace('@[/\\|]@', '', password_hash(microtime(), PASSWORD_DEFAULT));
                $uploads_dir = $_SERVER['DOCUMENT_ROOT'] . '/photos/';
                $_FILES['image']['name'] = $hash;
                $uploadfile = ($uploads_dir . basename($_FILES['image']['name']) . '.jpg');
                $img = imagecreatefromjpeg($_FILES['image']['tmp_name']);
                $percents = 75;
                $new_image_name = $hash . '.webp';

                imagepalettetotruecolor($img);
                imagealphablending($img, true);
                imagesavealpha($img, true);

                $im1 = imagecreatetruecolor(100, 100);
                imagecopyresampled($im1, $img, 0, 0, 0, 0, 100, 100, imagesx($img), imagesy($img));

                imagewebp($im1, $uploads_dir . $new_image_name, 100);
                imagedestroy($img);

                //move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile);
                $acc_model = new \app\models\AccountModel();
                $acc_model->Register($name, $email, $new_image_name);
            }
        }
    }
}


if (isset($_POST['submit'])) {
    register($_POST['name'], $_POST['email'], $_FILES['image']['name']);
}