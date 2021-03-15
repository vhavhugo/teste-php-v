<?php

require_once "config/routes.php";
if (isset($routes["$Controller"])) {
    $parts = explode(":", $routes["$Controller"]);
    $Controller = $parts[0];
    $Action = $parts[1];
}
$registry = Registry::getInstance();
if ($registry->get("$Controller") == false) {
    $registry->set("$Controller", new $Controller);
}
$obj = $registry->get("$Controller");
$obj->baseurl = Http::base();
if (method_exists($Controller, $Action)) {
    $obj->$Action();
} else {
    (new Page)->_action("$Controller::$Action()")->_and_stop();
}
