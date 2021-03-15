<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Teste - Back-End" />
    <meta name="author" content="Hugo do Valle" />
    <title>Teste - Back-End</title>
    <link href="<?= Http::base() ?>/view/assets/bootstrap/bootstrap.css" rel="stylesheet">
    <link href="<?= Http::base() ?>/view/assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?= Http::base() ?>/view/css/style.css" rel="stylesheet" />
</head>

<body>
    <div class="cl-mcont centralizar">
        <div class="header">
            <h3>Lista de pessoas</h3>
        </div>
        <div class="alert alert-success mensagem"></div>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th width="150" class="text-center">Data de Admissão</th>
                    <th width="80" class="text-center"><i class="fa fa-cog" aria-hidden="true"></i></th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($data['pessoas'][0])) : ?>
                    <?php foreach ($data['pessoas'] as $obj) : ?>
                        <tr id="tr-<?= $obj['id_pessoa'] ?>">
                            <td style="line-height: 30px"><?= $obj['nome'] ?></td>
                            <td class="text-center" style="line-height: 30px"><?= $obj['data_admissao'] ?></td>

                            <td id="td-remove" class="text-center" style="line-height: 30px">
                                <button data-id="<?= $obj['id_pessoa'] ?>" title="Remover" data-toggle="tooltip" class="btn btn-sm btn-danger btn-remover"><i class="fa fa-trash-o"></i></button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        <br>
        <div class="header">
            <h3>Inserir nova pessoa</h3>
        </div>
        <div class="row">
            <form action="<?= Http::base() ?>/index/gravar/" method="post" role="form" autocomplete="off" enctype="multipart/form-data">

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" name="nome" id="nome" class="form-control" placeholder="Informe o nome">
                    </div>
                    <div class="form-group">
                        <label for="rg">RG</label>
                        <input type="text" name="rg" data-mask="rg" id="rg" class="form-control" placeholder="Informe o rg">
                    </div>
                    <div class="form-group">
                        <label for="cpf">CPF</label>
                        <input type="text" name="cpf" data-mask="cpf" id="cpf" class="form-control" placeholder="Informe o cpf">
                    </div>
                    <div class="form-group">
                        <label for="data_nascimento">Data nascimento</label>
                        <input type="date" name="data_nascimento" id="data_nascimento" class="form-control" placeholder="Informe a data de nascimento">
                    </div>
                    <div class="form-group">
                        <label for="data_admissao">Data admissão</label><span class="text-danger"> *</span>
                        <input type="date" name="data_admissao" id="data_admissao" class="form-control" placeholder="Informe a data de nascimento" required>
                    </div>
                    <div class="form-group">
                        <label for="funcao">Funções </label>
                        <select name="funcao" id="funcao" class="form-control">
                            <option value="">Selecione uma função...</option>
                            <?php if (isset($data['funcoes'][0])) : ?>
                                <?php foreach ($data['funcoes'] as $fun) : ?>
                                    <option value="<?= $fun->id_funcao ?>"><?= $fun->funcao ?> </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>

                <p class="text-center">
                    <button class="btn btn-primary btn-lg" type="submit"><i class="fa fa-check-circle-o"></i>
                        Gravar Dados
                    </button>
                </p>
            </form>
        </div>
        <br>

        <div class="modal fade colored-header warning md-effect-10" id="modal-remove" tabindex="-1" role="dialog">
            <div class="modal-dialog custom-width">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3>Remover Registro</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <div class="i-circle text-warning"><i class="fa fa-warning fa-3x"></i></div>
                            <h4>Atenção!</h4>
                            <p>Você está prestes à remover um registro e esta ação não pode ser desfeita. <br />
                                Deseja realmente prosseguir?</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <form name="form-remove" id="form-remove" action="<?= Http::base() ?>/index/remove/" method="post">
                            <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-warning btn-flat btn-confirma-remove">Prosseguir</button>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
    <script src="<?= Http::base() ?>/view/assets/jquery/jquery.js"></script>
    <script src="<?= Http::base() ?>/view/assets/bootstrap/bootstrap.min.js"></script>
    <script src="<?= Http::base() ?>/view/assets/jquery.maskedinput/jquery.maskedinput.js" type="text/javascript"></script>
    <script src="<?= Http::base() ?>/view/js/pessoas.js"></script>
    <script>
        $(".mensagem").hide();
    </script>
    <?php if (isset($_GET['success'])) : ?>
        <script>
            $(".mensagem").show();
            $(".mensagem").html("Seu registro foi atualizado com sucesso!");
            setTimeout(function() {
                $(".mensagem").hide();
            }, 5000);
        </script>
    <?php endif; ?>
</body>

</html>