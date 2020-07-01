<form enctype="multipart/form-data" action="../app/handlers/register_handler.php" method="post">
    <strong>Введите логин</strong>
    <input type="text" name="name"><br>

    <strong>Введите Email</strong>
    <input type="email" name="email"><br>

    Choose a file to upload: <input name="image" type="file"/><br/>
    <input type="submit" value="Upload File" name="submit"/>

    <input type="text" name="captcha">
</form>

<?php
    $captcha = new \app\util\Captcha();
    $captcha->createImage();
    $captcha->display();
?>