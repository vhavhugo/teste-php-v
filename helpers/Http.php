<?php

class Http {

    static public function base() {
        $uri = filter_input(INPUT_GET, 'rota', FILTER_SANITIZE_SPECIAL_CHARS);
        $uri = explode("/", $uri);
        $baseuri = (isset($_SERVER['HTTPS']) ? 'https://' : 'http://') .
                (isset($_SERVER['REMOTE_USER']) ? $_SERVER['REMOTE_USER'] . '@' : '') .
                (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : ($_SERVER['SERVER_NAME'] .
                        (isset($_SERVER['HTTPS']) && $_SERVER['SERVER_PORT'] === 443 ||
                        $_SERVER['SERVER_PORT'] === 80 ? '' : ':' . $_SERVER['SERVER_PORT']))) .
                substr($_SERVER['SCRIPT_NAME'], 0, strrpos($_SERVER['SCRIPT_NAME'], '/'));
        return $baseuri;
    }

    static public function link($url = '') {
        Http::redirect_to($url);
    }

    static public function link_externo($str) {
        if ($str != "") {
            $s = "http://www.";
            if (preg_match('/https\:\/\//', $str)) {
                $s = "https://";
            }
            $str = preg_replace(array('/www\./', '/http\:\/\//', '/https\:\/\//'), array('', '', ''), $str);
            return $s . $str;
        } else {
            return $str;
        }
    }

    static public function redirect($url = '') {
        if (!headers_sent()) {
            header('Location: ' . $url);
            exit;
        } else {
            echo '<script type="text/javascript">';
            echo 'window.location.href="' . $url . '";';
            echo '</script>';
            echo '<noscript>';
            echo '<meta http-equiv="refresh" content="0;url=' . $url . '" />';
            echo '</noscript>';
        }
    }

    static public function redirect_to($url = '') {
        $url = Http::base() . "$url";
        if (!headers_sent()) {
            header('Location: ' . $url);
            exit;
        } else {
            echo '<script type="text/javascript">';
            echo 'window.location.href="' . $url . '";';
            echo '</script>';
            echo '<noscript>';
            echo '<meta http-equiv="refresh" content="0;url=' . $url . '" />';
            echo '</noscript>';
        }
    }

    static public function get_param($key, $parse = 'string') {
        $uri = filter_input(INPUT_GET, 'rota', FILTER_SANITIZE_SPECIAL_CHARS);
        $uri = explode("/", $uri);
        if (array_key_exists($key, $uri)) {
            if ($parse == 'int') {
                $uri[$key] = intval($uri[$key]);
            }
            return $uri[$key];
        } else {
            return false;
        }
    }

    static public function get_all_params() {
        $uri = filter_input(INPUT_GET, 'rota', FILTER_SANITIZE_SPECIAL_CHARS);
        return explode("/", $uri);
    }

    static public function base_dir() {
        $dir = dirname(__FILE__);
        $dir = explode("/helpers/", $dir);
        $dir = explode("/helpers", $dir[0]);
        return $dir[0];
    }

}
