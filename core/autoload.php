<?php

function __autoload($className) {
    $classpaths = array('controller/', 'lib/', 'model/', 'helpers/');
    foreach ($classpaths as $path) {
        $class = "$className.php";
        $filepath = "../".__DIR__ . "/$path" . $class;
        if (is_readable("$filepath")) {
            require_once "$filepath";
            break;
        }
    }
}

