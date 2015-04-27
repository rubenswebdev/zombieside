<?php 
    include '../head.php';
    include '../verifica_login.php';
    include '../menu_topo.php';
    $_SESSION['menu_ativo'] = 'usuario';
    include '../menu_lateral.php';

    include '../conexao.php';

    $id = $_GET['id'];

    $sqlPlataforma = "SELECT * FROM plataforma WHERE id=:id";

    $prepara = $conexao->prepare($sqlPlataforma);
    $prepara->execute(array(':id' => $id));
    
    $plataforma = $prepara->fetchObject();

    if (count($_POST)) {
        $nome = $_POST['nome'];
        $ativo = !isset($_POST['ativo']) ? 'false' : 'true';

        $sql = "UPDATE plataforma set nome=:nome, ativo=:ativo WHERE id = :id";

        $prepara = $conexao->prepare($sql);

        $params = array(
                        ':nome' => $nome,
                        ':ativo' => $ativo,
                        ':id' => $plataforma->id
                  );

        $atualizar = $prepara->execute($params);

        if($atualizar) {
          echo '<META HTTP-EQUIV="Refresh" CHARSET=UTF-8 Content="0; URL=/admin/plataforma/listar.php?msg=Plataforma alterado com sucesso!">';
          exit();
        } else {
          $erro = "Ocorreu um erro com o cadastro, tente novamente!";
        }
    }

?>
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">Cadastro de Plataforma

        </h1>


        <?php if (isset($erro)) { ?>
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong><?php echo $erro; ?></strong>
        </div>
        <?php } ?>
       
        <form action="/admin/plataforma/alterar.php?id=<?php echo $_GET['id'] ?>" method="POST" role="form">
          <legend>Novo usuário</legend>
        
          <div class="form-group">
            <label for="">Nome</label>
            <input type="text" value="<?php echo $plataforma->nome ?>" required class="form-control" id="nome" name="nome" placeholder="Nome">
          </div>
          <div class="checkbox">
            <label>
              <input <?php if ($plataforma->ativo) echo 'checked'; ?> name="ativo" type="checkbox" value="1">
              Ativo
            </label>
          </div>
        
          
        
          <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
  <?php 
    include '../footer.php';
  ?>