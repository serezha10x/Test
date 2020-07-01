<?php


namespace app\util;


class Captcha
{
    private $width = 200;
    private $height = 50;
    private $font_size = 20;
    private $num_of_letters = 6;


    public function createImage() {
        $image = imagecreatetruecolor($this->width, $this->height);
        $background_color = imagecolorallocate($image,255, 255, 255);
        imagefilledrectangle($image,0,0,200,50,$background_color);
        $black = imagecolorallocate($image, 0, 0, 0);

        $line_color = imagecolorallocate($image, 64,64,64);
        for($i=0;$i<10;$i++) {
            imageline($image,0,rand()%50,200,rand()%50,$line_color);
        }

        $pixel_color = imagecolorallocate($image, 0,0,255);
        for($i=0; $i<1000; $i++) {
            imagesetpixel($image,rand()%200,rand()%50,$pixel_color);
        }

        $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $len = strlen($letters);
        $letter = $letters[rand(0, $len-1)];
        $text_color = imagecolorallocate($image, 0,0,0);

        $word = '';
        $step = ($this->width - 20) / 6;
        for ($i = 0; $i < $this->num_of_letters; $i++) {
            $letter = $letters[rand(0, $len-1)];
            imagettftext($image, $this->font_size, 0, 10+($i*$step), ($this->height+$this->font_size) / 2 , $black, 'C:\OSPanel\domains\test\fonts\liber-mono.ttf' , $letter);
            $word .= $letter;
        }
        $_SESSION['captcha'] = $word;
        imagepng($image, "image.png");
    }


    public function display()
    {
        echo'
        <div style="text-align:center;">
            <h3>ВВЕДИТЕ ТЕКСТ, ИЗОБРАЖЕННЫЙ НА КАРТИНКЕ</h3>
            <b>Это проверка на то, робот вы или живой человек </b>
            <div style="display:block;margin-bottom:20px;margin-top:20px;">
                <img src="../image.png">
            </div>
        </div>
        ';
    }
}