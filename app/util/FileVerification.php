<?php

namespace app\util;

class FileVerification
{
    static function CheckFormat($file_extension) : bool {
        $permit_formats = require $_SERVER['DOCUMENT_ROOT'].'/app/config/image_formats.php';
        return in_array($file_extension, $permit_formats);
    }
}