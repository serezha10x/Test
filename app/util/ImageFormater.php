<?php


namespace app\util;


class ImageFormater
{
    public function saveImage($image, $size, $quality, $upload_dir, $output_format) : string {
        $hash = preg_replace('@[/\\|]@', '', password_hash(microtime(), PASSWORD_DEFAULT));
        //$uploads_dir = $_SERVER['DOCUMENT_ROOT'] . '/photos/';

        $image['name'] = $hash;
        $input_format = substr($image['type'], stripos($image['type'], '/') + 1, strlen($image['type']));
        //$uploadfile = ($upload_dir . basename($image['name']) . '.' . $input_format);

        $new_image_name = $hash . '.' . $output_format;
        $img = $this->getImageResources($image, $input_format);
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


    private function getImageResources($image, $input_format) {
        switch ($input_format) {
            case 'jpeg':
            case 'jpg':
                return imagecreatefromjpeg($image['tmp_name']);
            case 'png':
                return imagecreatefrompng($image['tmp_name']);
        }
    }
}