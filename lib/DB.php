<?php

Class DB {

    public $host;
    public $base;
    public $user;
    public $pass;
    public $con;
    public $sql;
    public $res;
    public $data;
    public $lastId;
    public $count = 0;

    public function __construct() {
        $database = array();
        require_once "config/database.php";
        $this->host = $database->{'host'};
        $this->base = $database->{'base'};
        $this->user = $database->{'user'};
        $this->pass = $database->{'pass'};
        $this->con = $this->open();
    }

    public function open() {
        $registry = Registry::getInstance();
        try {
            if ($registry->get('pdo') == false) {
                $this->con = new PDO("mysql:host=$this->host;dbname=$this->base", $this->user, $this->pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                $registry->set('pdo', $this->con);
            }
            $this->con = $registry->get('pdo');
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        return $this->con;
    }

    public function query($sql) {
        $this->con->query($sql) or die(print_r($this->con->errorInfo(), true));
    }

    public function lastId() {
        $this->lastId = $this->con->lastInsertId();
        return $this->lastId;
    }

    public function insert($table, $q) {
        $this->con->query("INSERT INTO `$table` " . $q->{'sql_insert'}) or die(print_r($this->con->errorInfo(), true));
    }

    public function update($table, $q) {
        $this->con->query("UPDATE `$table` " . $q->{'sql_update'}) or die(print_r($this->con->errorInfo(), true));
    }

    public function delete($table, $q) {
        $this->con->query("DELETE FROM `$table` WHERE $q ") or die(print_r($this->con->errorInfo(), true));
    }

    public function fetch() {
        $res = $this->con->query($this->query) or die(print_r($this->con->errorInfo(), true));
        $this->data = $res->fetchAll(PDO::FETCH_OBJ);
        return $this->data;
    }

}
