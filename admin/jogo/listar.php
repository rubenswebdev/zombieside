<?php 
    include '../head.php';
    include '../verifica_login.php';
    include '../menu_topo.php';
    $_SESSION['menu_ativo'] = 'jogo';
    include '../menu_lateral.php';

    include '../conexao.php';

    //Monta o select
    $sql = "SELECT j.*, p.nome as plataforma, t.nome as tipo
            FROM jogo j 
            INNER JOIN plataforma p ON p.id = j.id_plataforma 
            INNER JOIN tipo_jogo t ON t.id = j.id_tipo 
            WHERE j.excluido = false ORDER BY j.nome;";

    $prepara = $conexao->prepare($sql);
    $prepara->execute();

    $jogos = $prepara->fetchAll();

?>
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">Jogos
            <a  title="Incluir novo jogo" class="btn btn-success pull-right" href="/admin/jogo/incluir.php">
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
                  <th>Data de Lançamento</th>
                  <th>Plataforma</th>
                  <th>Tipo</th>
                  <th>Ativo</th>
                  <th>Opções</th>
              </tr>
          </thead>
          <tbody>
            <?php foreach ($jogos as $jogo) { ?>
              <tr>
                  <td><?php echo $jogo['nome'] ?></td>

                  <?php 
                      $data = date_create_from_format('Y-m-d', $jogo['data_lancamento']);
                   ?>
                  <td><?php echo date_format($data, 'd/m/Y');?></td>
                  <td><?php echo $jogo['plataforma'] ?></td>
                  <td><?php echo $jogo['tipo'] ?></td>
                  <td><?php echo $jogo['ativo'] == 1 ? 'Sim' : 'Não'; ?></td>
                  <td>
                    <a title="Alterar jogo" class="btn btn-info" href="/admin/jogo/alterar.php?id=<?php echo $jogo['id']; ?>">
                        <span class="glyphicon glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    
                    <?php if ($jogo['ativo']) { ?>
                    <a title="Desativar jogo" class="btn btn-warning" href="/admin/jogo/ativa_desativa.php?id=<?php echo $jogo['id']; ?>&acao=desativado">
                        <span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>
                    </a>
                    <?php } else { ?>

                    <a title="Ativar jogo" class="btn btn-success" href="/admin/jogo/ativa_desativa.php?id=<?php echo $jogo['id']; ?>&acao=ativado">
                        <span class="glyphicon glyphicon glyphicon-ok" aria-hidden="true"></span>
                    </a>
                    <?php } ?>
                    <a title="Excluir jogo" class="btn btn-danger" href="/admin/jogo/excluir.php?id=<?php echo $jogo['id']; ?>">
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