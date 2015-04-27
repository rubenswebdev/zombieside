<?php 
    include '../head.php';
    include '../verifica_login.php';
    include '../menu_topo.php';
    $_SESSION['menu_ativo'] = 'tipojogo';
    include '../menu_lateral.php';

    include '../conexao.php';

    $id = $_GET['id'];

    $sqlTipo = "SELECT * FROM tipo_jogo WHERE id=:id";

    $prepara = $conexao->prepare($sqlTipo);
    $prepara->execute(array(':id' => $id));
    
    $tipo = $prepara->fetchObject();

    if (count($_POST)) {
        $nome = $_POST['nome'];
        $ativo = !isset($_POST['ativo']) ? 'false' : 'true';

        $sql = "UPDATE tipo_jogo set nome=:nome, ativo=:ativo WHERE id = :id";

        $prepara = $conexao->prepare($sql);

        $params = array(
                        ':nome' => $nome,
                        ':ativo' => $ativo,
                        ':id' => $tipo->id
                  );

        $atualizar = $prepara->execute($params);

        if($atualizar) {
          echo '<META HTTP-EQUIV="Refresh"  CHARSET=UTF-8 Content="0; URL=/admin/tipojogo/listar.php?msg=Tipo alterado com sucesso!">';
          exit();
        } else {
          $erro = "Ocorreu um erro com o cadastro, tente novamente!";
        }
    }

?>
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">Cadastro de Tipo

        </h1>


        <?php if (isset($erro)) { ?>
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong><?php echo $erro; ?></strong>
        </div>
        <?php } ?>
       
        <form action="/admin/tipojogo/alterar.php?id=<?php echo $_GET['id'] ?>" method="POST" role="form">
          <legend>Novo tipo</legend>
        
          <div class="form-group">
            <label for="">Nome</label>
            <input type="text" value="<?php echo $tipo->nome ?>" required class="form-control" id="nome" name="nome" placeholder="Nome">
          </div>
          <div class="checkbox">
            <label>
              <input <?php if ($tipo->ativo) echo 'checked'; ?> name="ativo" type="checkbox" value="1">
              Ativo
            </label>
          </div>
        
          
        
          <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
  <?php 
    include '../footer.php';
  ?>