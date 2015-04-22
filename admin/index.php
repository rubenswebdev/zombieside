
<?php 
  include 'head.php';
  include 'verifica_login.php';
  include 'menu_topo.php';
  $_SESSION['menu_ativo'] = 'resumo';
  include 'menu_lateral.php';
  
  include 'conexao.php';

  $usuarios = qtdUsuarios($conexao);
  $plataformas = qtdPlataformas($conexao);
  $tipos = qtdTipos($conexao);
  $jogos = qtdJogos($conexao);
?>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Resumo</h1>
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th>Usúarios</th>
                <th>Plataformas</th>
                <th>Tipos de jogos</th>
                <th>Jogos</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><?php echo $usuarios['qtd'] ?></td>
                <td><?php echo $plataformas['qtd'] ?></td>
                <td><?php echo $tipos['qtd'] ?></td>
                <td><?php echo $jogos['qtd'] ?></td>
              </tr>
            </tbody>
          </table>
        </div>
  <?php 
    include 'footer.php';
  ?>
