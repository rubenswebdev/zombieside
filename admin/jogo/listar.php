<?php 
    include '../head.php';
    include '../verifica_login.php';
    include '../menu_topo.php';
    $_SESSION['menu_ativo'] = 'jogo';
    include '../menu_lateral.php';

    include '../conexao.php';

    $paginarAcada = 10;

    //Monta o select
    $sql = "SELECT j.*, (SELECT COUNT(*) FROM jogo WHERE excluido = false) as total,
              (SELECT string_agg(p.nome, ', ') 
                FROM tipo_plataforma_jogo tp 
                INNER JOIN plataforma p ON p.id = tp.id_plataforma 
                WHERE tp.id_jogo = j.id) as plataformas,
              (SELECT string_agg(tj.nome, ', ') 
                FROM jogo_tipo_jogo jtj 
                INNER JOIN tipo_jogo tj ON tj.id = jtj.id_tipo_jogo
                WHERE jtj.id_jogo = j.id) as tipos 
              FROM jogo j 
            WHERE j.excluido = false
            GROUP BY j.id
            ORDER BY j.nome
            LIMIT :limit OFFSET :offset;";

    $prepara = $conexao->prepare($sql);

    if (isset($_GET['pagina'])) {
      $offset = $_GET['pagina'] * $paginarAcada;
    }

    $params = array(
                ':offset' => (int)@$offset,
                ':limit' => $paginarAcada
    );

    $prepara->execute($params);

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
                  <th>Plataformas</th>
                  <th>Tipos</th>
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
                  <td><?php echo $jogo['plataformas'] ?></td>
                  <td><?php echo $jogo['tipos'] ?></td>
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
      <?php 
        $total = $jogos[0]['total'];
        $paginas = $total / $paginarAcada;


        $totalDaPagina = count($jogos);
        $totalDoOffset = (((int)@$_GET['pagina'] + 1) * $paginarAcada);


        if ($totalDoOffset > $total ) {
          $totalDoOffset =  $total;
        }

        echo 'Exibindo '. $totalDoOffset .' de '.$total.' resultados';
       ?>
      <nav>
          <ul class="pagination">
          
            <li class="<?php if ((int)@$_GET['pagina'] - 1 < 0) echo 'disabled'; ?>">
              <a href="<?php echo (int)@$_GET['pagina'] - 1 < 0 ? 'javascript:' : '?pagina=' . ((int)@$_GET['pagina'] - 1) ?>" aria-label="Anterior">
                <span aria-hidden="true">&laquo;</span>
              </a>
            </li>
     
            <?php for ($i=0; $i < $paginas; $i++) { ?>
              <li class="<?php echo (int)@$_GET['pagina'] == $i ? 'active' : '' ?>"><a href="?pagina=<?php echo $i ?>"><?php echo $i+1 ?></a></li>
            <?php } ?>
           
            
            <li class="<?php if ((int)@$_GET['pagina'] + 1 > $paginas) echo 'disabled'; ?>">
              <a href="<?php echo (int)@$_GET['pagina'] + 1 > $paginas ? 'javascript:' : '?pagina=' . ((int)@$_GET['pagina'] + 1) ?>"
                aria-label="Próxima">
                <span aria-hidden="true">&raquo;</span>
              </a>
            </li>
          
          </ul>
        </nav>
    </div>
  <?php 
    include '../footer.php';
  ?>