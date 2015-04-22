<?php 
    include '../head.php';
    include '../verifica_login.php';
    include '../menu_topo.php';
    $_SESSION['menu_ativo'] = 'tipojogo';
    include '../menu_lateral.php';
    include '../conexao.php';

    if (count($_POST)) {
        $nome = $_POST['nome'];
        $ativo = !isset($_POST['ativo']) ? 'false' : 'true';


        if (!isset($erro)) {
            $sql = "INSERT INTO tipo_jogo (nome, ativo) 
                    VALUES (:nome, :ativo)";

            $prepara = $conexao->prepare($sql);

            $params = array(
                            ':nome' => $nome,
                            ':ativo' => $ativo,
                      );

            $inserir = $prepara->execute($params);

            if($inserir) {
              echo '<META HTTP-EQUIV="Refresh" Content="0; URL=/admin/tipojogo/listar.php?msg=Tipo cadastrado com sucesso!">';
              exit();
            } else {
              $erro = "Ocorreu um erro com o cadastro, tente novamente!";
            }

        }

    }
?>
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">Cadastro Tipo de Jogo

        </h1>


        <?php if (isset($erro)) { ?>
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong><?php echo $erro; ?></strong>
        </div>
        <?php } ?>
       
        <form action="" method="POST" role="form">
          <legend>Nova tipo</legend>
        
          <div class="form-group">
            <label for="">Nome</label>
            <input type="text" value="<?php echo @$_POST['nome']; ?>" required class="form-control" id="nome" name="nome" placeholder="Nome">
          </div>

          <div class="checkbox">
            <label>
              <input <?php if (isset($_POST['ativo'])) echo 'checked'; ?> name="ativo" type="checkbox" value="1">
              Ativo
            </label>
          </div>
        
          
        
          <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
    </div>
  <?php 
    include '../footer.php';
  ?>