<?php


namespace app\util;


class ImageFormater
{
    public function saveImage($image, $size, $quality, $upload_dir, $output_format) {
        $hash = preg_replace('@[/\\|]@', '', password_hash(microtime(), PASSWORD_DEFAULT));
        //$uploads_dir = $_SERVER['DOCUMENT_ROOT'] . '/photos/';
        $image['name'] = $hash;
        $uploadfile = ($upload_dir . basename($image['name']) . '.jpg');
        $img = imagecreatefromjpeg($image['tmp_name']);
        $new_image_name = $hash . '.' . $output_format;

        imagepalettetotruecolor($img);
        imagealphablending($img, true);
        imagesavealpha($img, true);

        $img_copy = imagecreatetruecolor($size, $size);
        imagecopyresampled($img_copy, $img, 0, 0, 0, 0, $size, $size, imagesx($img), imagesy($img));

        imagewebp($img_copy, $upload_dir . $new_image_name, $quality);
        imagedestroy($img);
        imagedestroy($img_copy);
        return $new_image_name;
    }
}