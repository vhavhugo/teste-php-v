<?php

class Filter
{

    static function preg_match($str)
    {
        preg_match('/[^\s]*/', $str, $matches);
        return ucfirst(strtolower(($matches[0])));
    }

    static function antiSQL($str, $strip = null)
    {
        if ($strip != null) {
            return strip_tags(addslashes($str));
        } else {
            return addslashes($str);
        }
    }

    static function parse_to_date($str, $f = 'd/m/Y')
    {
        $str = date($f, strtotime($str));
        return $str;
    }


    static function check_agent($type = NULL)
    {
        $user_agent = strtolower($_SERVER['HTTP_USER_AGENT']);
        if ($type == 'bot') {
            // matches popular bots
            if (preg_match("/googlebot|adsbot|yahooseeker|yahoobot|msnbot|watchmouse|pingdom\.com|feedfetcher-google/", $user_agent)) {
                return true;
                // watchmouse|pingdom\.com are "uptime services"
            }
        } else if ($type == 'browser') {
            // matches core browser types
            if (preg_match("/mozilla\/|opera\//", $user_agent)) {
                return true;
            }
        } else if ($type == 'mobile') {
            // matches popular mobile devices that have small screens and/or touch inputs
            // mobile devices have regional trends; some of these will have varying popularity in Europe, Asia, and America
            // detailed demographics are unknown, and South America, the Pacific Islands, and Africa trends might not be represented, here
            if (preg_match("/phone|iphone|itouch|ipod|symbian|android|htc_|htc-|palmos|blackberry|opera mini|iemobile|windows ce|nokia|fennec|hiptop|kindle|mot |mot-|webos\/|samsung|sonyericsson|^sie-|nintendo/", $user_agent)) {
                // these are the most common
                return true;
            } else if (preg_match("/mobile|pda;|avantgo|eudoraweb|minimo|netfront|brew|teleca|lg;|lge |wap;| wap /", $user_agent)) {
                // these are less common, and might not be worth checking
                return true;
            }
        }
        return false;
    }

    static function pre($data)
    {
        echo "<pre>", @print_r($data, true), "</pre>";
    }


    static function memoryHuman($size)
    {
        $unit = array('b', 'kb', 'mb', 'gb', 'tb', 'pb');
        return @round($size / pow(1024, ($i = floor(log($size, 1024)))), 2) . ' ' . $unit[$i];
    }


    static function hash($width = 8)
    {
        $chars = 'abcdefghijlmnopqrstuvxwzABCDEFGHIJLMNOPQRSTUVXYWZ0123456789-.^*%#@!';
        $max = strlen($chars) - 1;
        $pass = "";
        for ($i = 0; $i < $width; $i++) {
            $pass .= $chars{
                mt_rand(0, $max)};
        }
        return $pass;
    }
}
