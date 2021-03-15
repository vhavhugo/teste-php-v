<?php

class pessoaModel extends appModel
{

    public function __construct()
    {
        $this->initApp();
    }

    public function get_all($order = 'DESC')
    {
        $this->db->query = "SELECT id_pessoa, nome, data_admissao FROM pessoas ORDER BY id_pessoa $order";
        $data = $this->db->fetch();
        return (isset($data[0])) ? $data : null;
    }

    public function gravar($id = null)
    {
        $post = Post::query_build();
        if ($id != null) { //atualiza
            $this->db->query("UPDATE pessoas SET $post->sql_update WHERE id_pessoa = $id;");
        } else { //cadastra
            $this->db->query("INSERT INTO pessoas $post->sql_insert;");
        }
    }

    public function remove($id)
    {
        $this->db->query("DELETE FROM pessoas WHERE id_pessoa = $id;");
    }
}
