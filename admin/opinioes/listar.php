<?php 
    include '../head.php';
    include '../verifica_login.php';
    include '../menu_topo.php';
    $_SESSION['menu_ativo'] = 'opinioes';
    include '../menu_lateral.php';

    include '../conexao.php';
    $paginarAcada = 10;
    $opinioes = listarOpinioes($conexao, $paginarAcada);


?>
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">Opiniões</h1>

       <?php if (isset($_GET['msg'])) { ?>
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong><?php echo $_GET['msg']; ?></strong>
        </div>
        <?php } ?>

      <div class="row">
        <div class="col-md-12">
          <form action="" method="GET" class="form-inline" role="form">
            <select name="filtro" id="input" class="form-control">
              <option <?php if(@$_GET['filtro'] == 't') echo 'selected' ?> value="t">Todos</option>
              <option <?php if(@$_GET['filtro'] == 'a') echo 'selected' ?> value="a">Aprovados</option>
              <option <?php if(@$_GET['filtro'] == 'p') echo 'selected' ?> value="p">Pendentes</option>
            </select>
            <button type="submit" class="btn btn-primary">Filtrar</button>
          </form>
        </div>
      </div>

      <table class="table table-striped table-hover">
          <thead>
              <tr>
                  <th>Nome usuário</th>
                  <th>Nome Jogo</th>
                  <th>Texto</th>
                  <th>Ativo</th>
                  <th>Opções</th>
              </tr>
          </thead>
          <tbody>
            <?php foreach ($opinioes as $opiniao) { ?>
              <tr>
                  <td><?php echo $opiniao['nome'] ?></td>
                  <td><?php echo $opiniao['jogo'] ?></td>
                  <td><?php echo $opiniao['texto'] ?></td>
                  <td><?php echo $opiniao['ativo'] == 1 ? 'Sim' : 'Não'; ?></td>
                  <td>
                    
                    
                    <?php if ($opiniao['ativo']) { ?>
                      <a title="Desativar opinião" class="btn btn-warning" href="/admin/opinioes/ativa_desativa.php?id=<?php echo $opiniao['id']; ?>&acao=desativado">
                          <span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>
                      </a>
                    <?php } else { ?>
                      <a title="Ativar opinião" class="btn btn-success" href="/admin/opinioes/ativa_desativa.php?id=<?php echo $opiniao['id']; ?>&acao=ativado">
                          <span class="glyphicon glyphicon glyphicon-ok" aria-hidden="true"></span>
                      </a>
                    <?php } ?>
                    <a title="Excluir opinião" class="btn btn-danger" href="/admin/opinioes/excluir.php?id=<?php echo $opiniao['id']; ?>">
                        <span class="glyphicon glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </a>
                  </td>
              </tr>
           <?php } ?>
          </tbody>
      </table>
       <!-- PAGINACAO -->
      <?php

        $total = (int)@$opinioes[0]['total'];
        $paginas = $total / $paginarAcada;


        $totalDaPagina = count($opinioes);
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
      <!-- FINAL PAGINACAO -->
    </div>
  <?php 
    include '../footer.php';
  ?>