<?php 
    include '../head.php';
    include '../verifica_login.php';
    include '../menu_topo.php';
    $_SESSION['menu_ativo'] = 'plataforma';
    include '../menu_lateral.php';

    include '../conexao.php';

    $plataformas = listarPlataformas($conexao);

?>
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">Plataformas
            <a  title="Incluir nova plataforma" class="btn btn-success pull-right" href="/admin/plataforma/incluir.php">
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
            <?php foreach ($plataformas as $plataforma) { ?>
              <tr>
                  <td><?php echo $plataforma['nome'] ?></td>
                  <td><?php echo $plataforma['ativo'] == 1 ? 'Sim' : 'Não'; ?></td>
                  <td>
                    <a title="Alterar plataforma" class="btn btn-info" href="/admin/plataforma/alterar.php?id=<?php echo $plataforma['id']; ?>">
                        <span class="glyphicon glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    
                    <?php if ($plataforma['ativo']) { ?>
                    <a title="Desativar plataforma" class="btn btn-warning" href="/admin/plataforma/ativa_desativa.php?id=<?php echo $plataforma['id']; ?>&acao=desativado">
                        <span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>
                    </a>
                    <?php } else { ?>

                    <a title="Ativar plataforma" class="btn btn-success" href="/admin/plataforma/ativa_desativa.php?id=<?php echo $plataforma['id']; ?>&acao=ativado">
                        <span class="glyphicon glyphicon glyphicon-ok" aria-hidden="true"></span>
                    </a>
                    <?php } ?>
                    <a title="Excluir plataforma" class="btn btn-danger" href="/admin/plataforma/excluir.php?id=<?php echo $plataforma['id']; ?>">
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