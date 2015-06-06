<?php 
    include '../head.php';
    include '../verifica_login.php';
    include '../menu_topo.php';
    $_SESSION['menu_ativo'] = 'usuario';
    include '../menu_lateral.php';

    include '../conexao.php';

    if (count($_POST)) {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $login = $_POST['login'];
        $senha = $_POST['senha'];
        $senhac = $_POST['senhac'];
        $permissao = !isset($_POST['permissao']) ? 'user' : 'admin';
        $ativo = !isset($_POST['ativo']) ? 'false' : 'true';

        if ($senha !== $senhac) {
          $erro = 'Senhas não conferem';
        }

        if (!isset($erro)) {
            $sql = "INSERT INTO usuario (nome, email, login, ativo, senha, permissao) 
                    VALUES (:nome, :email, :login, :ativo, :senha, :permissao)";

            $prepara = $conexao->prepare($sql);

            $params = array(
                            ':nome' => $nome,
                            ':email' => $email,
                            ':login' => $login,
                            ':ativo' => $ativo,
                            ':senha' => crypt($senha),
                            ':permissao' => $permissao
                      );

            $inserir = $prepara->execute($params);

            if($inserir) {
              echo '<META HTTP-EQUIV="Refresh" CHARSET=UTF-8 Content="0; URL=/admin/usuario/listar.php?msg=Usuário cadastrado com sucesso!">';
              exit();
            } else {
              $erro = "Ocorreu um erro com o cadastro, tente novamente!";
            }

        }

    }
    
    //REINDEX TABLE usuario;
    //INSERT INTO usuario VALUES (1,'admin', false,'admin@zombieside.com.br', 'admin', true, '$1$SQZAG4D2$rZPDi1.Lm4Hi8dIDQXBM61', 'admin');


?>
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">Cadastro de Usuário

        </h1>


        <?php if (isset($erro)) { ?>
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong><?php echo $erro; ?></strong>
        </div>
        <?php } ?>
       
        <form action="/admin/usuario/incluir.php" method="POST" role="form">
          <legend>Novo usuário</legend>
        
          <div class="form-group">
            <label for="">Nome</label>
            <input type="text" value="<?php echo @$_POST['nome']; ?>" required class="form-control" id="nome" name="nome" placeholder="Nome">
          </div>
          <div class="form-group">
            <label for="">Email</label>
            <input type="email" value="<?php echo @$_POST['email']; ?>" required class="form-control" id="email" name="email" placeholder="Email">
          </div>
          <div class="form-group">
            <label for="">Login</label>
            <input type="text" value="<?php echo @$_POST['login']; ?>" required class="form-control" id="login" name="login" placeholder="Login">
          </div>
          <div class="form-group">
            <label for="">Senha</label>
            <input type="password" class="form-control" required id="senha" name="senha" placeholder="Senha">
          </div>
          <div class="form-group">
            <label for="">Confirma Senha</label>
            <input type="password" class="form-control" required id="senhac" name="senhac" placeholder="Confirma Senha">
          </div>

          <div class="checkbox">
            <label>
              <input <?php if (isset($_POST['permissao'])) echo 'checked'; ?> name="permissao" type="checkbox" value="admin">
              Admin
            </label>
          </div>
          <div class="checkbox">
            <label>
              <input checked name="ativo" type="checkbox" value="1">
              Ativo
            </label>
          </div>
        
          
        
          <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
    </div>
  <?php 
    include '../footer.php';
  ?>