<?php
require 'core/getroute.php';
require 'core/registry.php';

function __autoload($className)
{
    $found = false;
    $classpaths = array('lib/', 'model/', 'controller/', 'helpers/');
    foreach ($classpaths as $path) {
        if (preg_match('/Model/', $className)) {
            $class = "$className.php";
        } else {
            $class = ucfirst("$className.php");
        }
        $filepath = __DIR__ . "/$path" . $class;
        if (is_readable("$filepath")) {
            $found = true;
            require_once "$filepath";
            break;
        }
    }
    if ($found === false) {
        (new Page)->_404()->_and_stop();
    }
}

//ob_end_flush();
