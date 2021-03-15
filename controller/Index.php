<?php

class Index
{

    public function indexAction()
    {
        $pessoas = (new pessoaModel)->get_all();
        $dados['funcoes'] = (new funcoesModel)->get_all();

        foreach ($pessoas as $pessoa) {
            $dados['pessoas'][] = array(
                'id_pessoa' => intval($pessoa->id_pessoa),
                'nome' => Filter::preg_match($pessoa->nome),
                'data_admissao' => Filter::parse_to_date($pessoa->data_admissao)
            );
        }

        Tpl::view("index", $dados);
    }


    public function gravar()
    {
        if (Post::get('id_pessoa', 'int') > 0) {
            $id = Post::get('id_pessoa', 'int');
            (new pessoaModel)->gravar($id);
        } else {
            (new pessoaModel)->gravar();
        }

        Http::redirect_to('/index/?success');
    }

    public function remove()
    {
        if (Post::get('id_pessoa', 'int') > 0) {
            $id = Post::get('id_pessoa');
            (new pessoaModel)->remove($id);
        }
    }
}
