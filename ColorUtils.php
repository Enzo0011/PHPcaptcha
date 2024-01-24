<?php

// ColorUtils.php

class ColorUtils {
    public static function hexToRgb($hex) {
        $hex = ltrim($hex, '#');
        if (strlen($hex) == 3) {
            $hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
        }
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
        return array($r, $g, $b);
    }

    public static function isColorValid($color) {
        return preg_match('/^#(?:[0-9a-fA-F]{3}){1,2}$/', $color);
    }

    public static function colorContrast($color1, $color2) {
        list($r1, $g1, $b1) = self::hexToRgb($color1);
        list($r2, $g2, $b2) = self::hexToRgb($color2);

        $l1 = 0.2126 * pow($r1 / 255, 2.2) +
              0.7152 * pow($g1 / 255, 2.2) +
              0.0722 * pow($b1 / 255, 2.2);

        $l2 = 0.2126 * pow($r2 / 255, 2.2) +
              0.7152 * pow($g2 / 255, 2.2) +
              0.0722 * pow($b2 / 255, 2.2);

        if ($l1 > $l2) {
            return ($l1 + 0.05) / ($l2 + 0.05) > 1.5;
        } else {
            return ($l2 + 0.05) / ($l1 + 0.05) > 1.5;
        }
    }

    public static function generateRandomColor() {
        return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
    }
}

