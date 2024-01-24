<?php

// CaptchaGenerator.php

class CaptchaGenerator {
    private $text;
    private $textColor;
    private $backgroundColor;

    public function __construct($text, $textColor, $backgroundColor) {
        $this->text = $text;
        $this->textColor = ColorUtils::hexToRgb($textColor);
        $this->backgroundColor = ColorUtils::hexToRgb($backgroundColor);
    }

    public function createImage() {
        $image = imagecreatetruecolor(400, 100);
        $backgroundColor = imagecolorallocate($image, ...$this->backgroundColor);
        $textColor = imagecolorallocate($image, ...$this->textColor);
    
        imagefill($image, 0, 0, $backgroundColor);
        imagettftext($image, 30, 0, 10, 65, $textColor, 'police/ephesis.ttf', $this->text);
    
        for ($i = 0; $i < 3; $i++) {
            $lineColor = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255));
            
            $start = rand(0, 3);
            $end = rand(0, 3);
    
            $x1 = ($start == 0 || $start == 2) ? rand(0, 400) : ($start == 1 ? 0 : 400);
            $y1 = ($start == 0 || $start == 2) ? ($start == 0 ? 0 : 100) : rand(0, 100);
            $x2 = ($end == 0 || $end == 2) ? rand(0, 400) : ($end == 1 ? 0 : 400);
            $y2 = ($end == 0 || $end == 2) ? ($end == 0 ? 0 : 100) : rand(0, 100);
    
            imageline($image, $x1, $y1, $x2, $y2, $lineColor);
        }
    
        $imagePath = "img/captcha_" . uniqid() . ".png";
        imagepng($image, $imagePath);
        imagedestroy($image);
    
        return $imagePath;
    }    
    
}
