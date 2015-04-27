<?php 
    include '../head.php';
    include '../verifica_login.php';
    include '../menu_topo.php';
    $_SESSION['menu_ativo'] = 'usuario';
    include '../menu_lateral.php';

    include '../conexao.php';

    $id = $_GET['id'];

    $sqlUsuario = "SELECT * FROM usuario WHERE id=:id";

    $prepara = $conexao->prepare($sqlUsuario);
    $prepara->execute(array(':id' => $id));
    
    $usuario = $prepara->fetchObject();

    if (count($_POST)) {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $login = $_POST['login'];
        $senha = $_POST['senha'] == '' ? $usuario->senha : $_POST['senha'];
        $senhac = $_POST['senhac'] == '' ? $usuario->senha : $_POST['senhac'];
        $permissao = !isset($_POST['permissao']) ? 'user' : 'admin';
        $ativo = !isset($_POST['ativo']) ? 'false' : 'true';

        if ($senha !== $senhac) {
          $erro = 'Senhas não conferem';
        } else {
          if ($_POST['senha'] != '') {
            $senha = crypt($senha);
          }
        }

        if (!isset($erro)) {
            $sql = "UPDATE usuario set nome=:nome, email=:email, login=:login, ativo=:ativo, senha=:senha, permissao=:permissao
            WHERE id = :id";

            $prepara = $conexao->prepare($sql);

            $params = array(
                            ':nome' => $nome,
                            ':email' => $email,
                            ':login' => $login,
                            ':ativo' => $ativo,
                            ':senha' => $senha,
                            ':permissao' => $permissao,
                            ':id' => $usuario->id
                      );

            $atualizar = $prepara->execute($params);

            if($atualizar) {
              echo '<META HTTP-EQUIV="Refresh" CHARSET=UTF-8 Content="0; URL=/admin/usuario/listar.php?msg=Usuário alterado com sucesso!">';
              exit();
            } else {
              $erro = "Ocorreu um erro com o cadastro, tente novamente!";
            }

        }

    }
    

    //INSERT INTO usuario VALUES (1,'admin', 'admin@zombieside.com.br', 'admin', true, '$1$SQZAG4D2$rZPDi1.Lm4Hi8dIDQXBM61', 'admin');


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
       
        <form action="/admin/usuario/alterar.php?id=<?php echo $_GET['id'] ?>" method="POST" role="form">
          <legend>Novo usuário</legend>
        
          <div class="form-group">
            <label for="">Nome</label>
            <input type="text" value="<?php echo $usuario->nome ?>" required class="form-control" id="nome" name="nome" placeholder="Nome">
          </div>
          <div class="form-group">
            <label for="">Email</label>
            <input type="email" value="<?php echo $usuario->email ?>" required class="form-control" id="email" name="email" placeholder="Email">
          </div>
          <div class="form-group">
            <label for="">Login</label>
            <input type="text" value="<?php echo $usuario->login ?>" required class="form-control" id="login" name="login" placeholder="Login">
          </div>
          <div class="form-group">
            <label for="">Senha</label>
            <input type="password" class="form-control"  id="senha" name="senha" placeholder="Senha">
          </div>
          <div class="form-group">
            <label for="">Confirma Senha</label>
            <input type="password" class="form-control"  id="senhac" name="senhac" placeholder="Confirma Senha">
          </div>

          <div class="checkbox">
            <label>
              <input <?php if ($usuario->permissao == 'admin') echo 'checked'; ?> name="permissao" type="checkbox" value="admin">
              Admin
            </label>
          </div>
          <div class="checkbox">
            <label>
              <input <?php if ($usuario->ativo) echo 'checked'; ?> name="ativo" type="checkbox" value="1">
              Ativo
            </label>
          </div>
          <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
  <?php 
    include '../footer.php';
  ?>