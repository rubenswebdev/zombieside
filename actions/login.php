<?php 
    include '../admin/conexao.php';
    $erro = 0;

    $login = $_POST['login'];
    $password = $_POST['password'];

    if ($password == '') {
        $erro++;
        $msg = 'Senhas não conferem.';
    }

    if ($login == '') {
        $erro++;
        $msg = 'Login não pode ser vazio.';
    }
    if ($erro == 0) {
            
        $sql = "SELECT * FROM usuario WHERE login = :login AND ativo = true AND excluido = false AND permissao = 'user' LIMIT 1";

        $prepara = $conexao->prepare($sql);
        $prepara->execute(array(':login' => $login));
        
        $usuario = $prepara->fetchObject();


        if ($usuario) {
            if (crypt($password, $usuario->senha) == $usuario->senha) { 
               unset($usuario->senha);//unset para nao exibir a senha na session do usuario
                $_SESSION['usuario'] = $usuario; //define o usuario logado

                $sqlFavoritos = "SELECT id_jogo FROM favorito WHERE id_usuario = :id_usuario";
                $prepara = $conexao->prepare($sqlFavoritos);

                $prepara->execute(array(':id_usuario' => $usuario->id));

                $favoritos = $prepara->fetchAll(PDO::FETCH_ASSOC);
                $_SESSION['favoritos'] = array();
                foreach ($favoritos as  $fav) {
                    $_SESSION['favoritos'][] = $fav['id_jogo'];
                }


                $_SESSION['class-msg'] = 'success';
                $_SESSION['msg'] = 'Login realizado com sucesso!';
               header('Location: /index.php');//redireciona para pagina principal
               exit();
            } else {
                $_SESSION['class-msg'] = 'danger';
                $_SESSION['msg'] = 'Erro ao logar usuário, tente novamente.';
                header('Location: /index.php');
                exit();
            }
        } else {
            $msg = "Usuário ou senha incorretos.";
            $_SESSION['class-msg'] = 'danger';
            $_SESSION['msg'] = $msg;
            header('Location: /index.php');
            exit();
        }

    } else {
        $_SESSION['class-msg'] = 'danger';
        $_SESSION['msg'] = $msg;
        header('Location: /index.php');
        exit();
    }

?>