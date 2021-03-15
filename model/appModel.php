<?php

class appModel
{

    public $db;
    public $post;

    public function __construct()
    {
        $this->initApp();
    }

    public function initApp()
    {
        $registry = Registry::getInstance();
        if ($registry->get('db') == false) {
            $registry->set('db', new DB);
        }
        $this->db = $registry->get('db');
    }
}
