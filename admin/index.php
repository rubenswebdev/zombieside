
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
          <div style="height: 200px" id="placeholder" class="demo-placeholder"></div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        
        <script>
          $(function() {

            var data = [ ["Usuários", <?php echo $usuarios['qtd'] ?>], ["Plataformas", <?php echo $plataformas['qtd'] ?>], ["Tipos de jogos", <?php echo $tipos['qtd'] ?>], ["Jogos", <?php echo $jogos['qtd'] ?>] ];

            $.plot("#placeholder", [ data ], {
              series: {
                bars: {
                  show: true,
                  barWidth: 0.6,
                  align: "center"
                }
              },
              xaxis: {
                mode: "categories",
                tickLength: 0
              }
            });


          });
        </script>
  <?php 
    include 'footer.php';
  ?>
