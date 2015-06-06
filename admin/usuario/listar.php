<?php 
    include '../head.php';
    include '../verifica_login.php';
    include '../menu_topo.php';
    $_SESSION['menu_ativo'] = 'usuario';
    include '../menu_lateral.php';

    include '../conexao.php';
     $paginarAcada = 10;
    $usuarios = listarUsuarios($conexao, $paginarAcada);

?>
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">Usuários
            <a  title="Incluir novo usuário" class="btn btn-success pull-right" href="/admin/usuario/incluir.php">
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
                  <th>Email</th>
                  <th>Login</th>
                  <th>Ativo</th>
                  <th>Permissão</th>
                  <th>Opções</th>
              </tr>
          </thead>
          <tbody>
            <?php foreach ($usuarios as $usuario) { ?>
              <tr>
                  <td><?php echo $usuario['nome'] ?></td>
                  <td><?php echo $usuario['email'] ?></td>
                  <td><?php echo $usuario['login'] ?></td>
                  <td><?php echo $usuario['ativo'] == 1 ? 'Sim' : 'Não'; ?></td>
                  <td><?php echo $usuario['permissao'] ?></td>
                  <td>
                    <a title="Alterar usuário" class="btn btn-info" href="/admin/usuario/alterar.php?id=<?php echo $usuario['id']; ?>">
                        <span class="glyphicon glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    
                    <?php if ($usuario['ativo']) { ?>
                    <a title="Desativar usuário" class="btn btn-warning" href="/admin/usuario/ativa_desativa.php?id=<?php echo $usuario['id']; ?>&acao=desativado">
                        <span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>
                    </a>
                    <?php } else { ?>

                    <a title="Ativar usuário" class="btn btn-success" href="/admin/usuario/ativa_desativa.php?id=<?php echo $usuario['id']; ?>&acao=ativado">
                        <span class="glyphicon glyphicon glyphicon-ok" aria-hidden="true"></span>
                    </a>
                    <?php } ?>
                    <a title="Excluir usuário" class="btn btn-danger" href="/admin/usuario/excluir.php?id=<?php echo $usuario['id']; ?>">
                        <span class="glyphicon glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </a>
                  </td>
              </tr>
           <?php } ?>
          </tbody>
      </table>
       <!-- PAGINACAO -->
      <?php 
        $total = $usuarios[0]['total'];
        $paginas = $total / $paginarAcada;


        $totalDaPagina = count($usuarios);
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