<?php 
    include '../admin/conexao.php';
    $erro = 0;
    $email = $_POST['email'];
    $nome = $_POST['nome'];
    $login = $_POST['login'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];


    $verificaEmail = verificaEmail($conexao, $email);

    if($verificaEmail){
        $erro++;
        $msg = 'Email já cadastrado.';
    }

    if (!preg_match('/^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,20})$/', $email)) {
        $erro++;
        $msg = 'Email inválido.';
    }

    if ($password != $confirm_password) {
        $erro++;
        $msg = 'Senhas não conferem.';
    }

    if ($nome == '') {
        $erro++;
        $msg = 'Nome não pode ser vazio.';
    }

    if ($login == '') {
        $erro++;
        $msg = 'Login não pode ser vazio.';
    }


    if ($erro == 0) {
        $sql = "INSERT INTO usuario (nome, email, login, ativo, senha, permissao) 
                    VALUES (:nome, :email, :login, :ativo, :senha, :permissao)";

        $prepara = $conexao->prepare($sql);

        $params = array(
                        ':nome' => $nome,
                        ':email' => $email,
                        ':login' => $login,
                        ':ativo' => true,
                        ':senha' => crypt($password),
                        ':permissao' => 'user'
                  );

        $inserir = $prepara->execute($params);

        if($inserir) {
            
            $sql = "SELECT * FROM usuario WHERE email = :email AND ativo = true AND excluido = false AND permissao = 'user' LIMIT 1";

            $prepara = $conexao->prepare($sql);
            $prepara->execute(array(':email' => $email));
            
            $usuario = $prepara->fetchObject();


            if ($usuario) {
                if (crypt($password, $usuario->senha) == $usuario->senha) { 
                   unset($usuario->senha);//unset para nao exibir a senha na session do usuario
                   $_SESSION['usuario'] = $usuario; //define o usuario logado

                    $_SESSION['class-msg'] = 'success';
                    $_SESSION['msg'] = 'Cadastro realizado com sucesso!';
                   header('Location: /index.php');//redireciona para pagina principal
                   exit();
                } else {
                    $_SESSION['class-msg'] = 'danger';
                    $_SESSION['msg'] = 'Erro ao cadastrar usuário, tente novamente.';
                    header('Location: /index.php');
                    exit();
                }
            } 

        } else {
            $erro = "Ocorreu um erro com o cadastro, tente novamente!";
        }


    } else {
        $_SESSION['class-msg'] = 'danger';
        $_SESSION['msg'] = $msg;
        header('Location: /index.php');
        exit();
    }

?>