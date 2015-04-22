<?php 
    include '../head.php';
    include '../verifica_login.php';
    include '../menu_topo.php';
    $_SESSION['menu_ativo'] = 'tipojogo';
    include '../menu_lateral.php';

    include '../conexao.php';

    $tipos = listarTipos($conexao);

?>
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">Tipo de Jogos
            <a  title="Incluir novo Tipo de jogo" class="btn btn-success pull-right" href="/admin/tipojogo/incluir.php">
                <span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span>
            </a>
        </h1>

       <?php if (isset($_GET['msg'])) { ?>
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong><?php echo $_GET['msg']; ?></strong>
        </div>
        <?php } ?>

      <table class="table table-striped table-hover">
          <thead>
              <tr>
                  <th>Nome</th>
                  <th>Ativo</th>
                  <th>Opções</th>
              </tr>
          </thead>
          <tbody>
            <?php foreach ($tipos as $tipo) { ?>
              <tr>
                  <td><?php echo $tipo['nome'] ?></td>
                  <td><?php echo $tipo['ativo'] == 1 ? 'Sim' : 'Não'; ?></td>
                  <td>
                    <a title="Alterar tipo" class="btn btn-info" href="/admin/tipojogo/alterar.php?id=<?php echo $tipo['id']; ?>">
                        <span class="glyphicon glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    
                    <?php if ($tipo['ativo']) { ?>
                    <a title="Desativar Tipo" class="btn btn-warning" href="/admin/tipojogo/ativa_desativa.php?id=<?php echo $tipo['id']; ?>&acao=desativado">
                        <span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>
                    </a>
                    <?php } else { ?>

                    <a title="Ativar Tipo" class="btn btn-success" href="/admin/tipojogo/ativa_desativa.php?id=<?php echo $tipo['id']; ?>&acao=ativado">
                        <span class="glyphicon glyphicon glyphicon-ok" aria-hidden="true"></span>
                    </a>
                    <?php } ?>
                    <a title="Excluir Tipo" class="btn btn-danger" href="/admin/tipojogo/excluir.php?id=<?php echo $tipo['id']; ?>">
                        <span class="glyphicon glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </a>

                  </td>
              </tr>
           <?php } ?>
          </tbody>
      </table>
    </div>
  <?php 
    include '../footer.php';
  ?>