<?php


namespace app\util;


use PHPMailer\PHPMailer\PHPMailer;

class Mailer
{
    public function sendMail(string $to, string $subject, string $message)
    {
        $headers = 'From: kanatush.lorraine01@gmail.com' . "\r\n" .
            'Reply-To: kanatush.lorraine01@gmail.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
        mail($to, $subject, $message, $headers);
    }
}