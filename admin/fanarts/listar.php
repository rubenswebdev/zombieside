<?php 
    include '../head.php';
    include '../verifica_login.php';
    include '../menu_topo.php';
    $_SESSION['menu_ativo'] = 'fanarts';
    include '../menu_lateral.php';

    include '../conexao.php';
    $paginarAcada = 10;
    $fanarts = listarFanarts($conexao, $paginarAcada);


?>
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">Fanarts</h1>

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
                  <th>Titulo</th>
                  <th>Ativo</th>
                  <th>Imagem</th>
                  <th>Opções</th>
              </tr>
          </thead>
          <tbody>
            <?php foreach ($fanarts as $fanart) { ?>
              <tr>
                  <td><?php echo $fanart['nome'] ?></td>
                  <td><?php echo $fanart['jogo'] ?></td>
                  <td><?php echo $fanart['titulo'] ?></td>
                  <td><?php echo $fanart['ativo'] == 1 ? 'Sim' : 'Não'; ?></td>
                  <td><img class="responsive" style="height:90px" src="../../../<?php echo $fanart['caminho'] ?>" alt=""></td>
                  <td>
                    
                    
                    <?php if ($fanart['ativo']) { ?>
                      <a title="Desativar fanart" class="btn btn-warning" href="/admin/fanarts/ativa_desativa.php?id=<?php echo $fanart['id']; ?>&acao=desativado">
                          <span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>
                      </a>
                    <?php } else { ?>
                      <a title="Ativar fanart" class="btn btn-success" href="/admin/fanarts/ativa_desativa.php?id=<?php echo $fanart['id']; ?>&acao=ativado">
                          <span class="glyphicon glyphicon glyphicon-ok" aria-hidden="true"></span>
                      </a>
                    <?php } ?>
                    <a title="Excluir fanart" class="btn btn-danger" href="/admin/fanarts/excluir.php?id=<?php echo $fanart['id']; ?>">
                        <span class="glyphicon glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </a>
                  </td>
              </tr>
           <?php } ?>
          </tbody>
      </table>
       <!-- PAGINACAO -->
      <?php

        $total = (int)@$fanarts[0]['total'];
        $paginas = $total / $paginarAcada;


        $totalDaPagina = count($fanarts);
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