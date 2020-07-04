<?php


namespace app\util;


class CsrfToken
{
    public function getToken() : string {
        return $_SESSION['csrf_token'] = password_hash(microtime(), PASSWORD_DEFAULT);
    }
}