<?php

class funcoesModel extends appModel
{

    public function __construct()
    {
        $this->initApp();
    }

    public function get_all($order = 'DESC')
    {
        $this->db->query = "SELECT * FROM funcoes ORDER BY id_funcao $order";
        $data = $this->db->fetch();
        return (isset($data[0])) ? $data : null;
    }

}
