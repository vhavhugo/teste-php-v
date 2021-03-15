<?php

Class Page {

    public function __construct() {
        
    }

    public function indexAction() {
    }

    public function erro() {
        Tpl::view("erro.padrao");
    }

    public function _required($key) {
        echo "Campo [$key] requerido!";
        //Tpl::view("erro.required");
    }

    public function _404() {
        Tpl::view("erro.404");
        return $this;
    }

    public function _action($Action) {
         Tpl::view("erro.action","$Action");
        return $this;
    }

    public function _and_stop() {
        exit;
    }

}
