<?php
	include 'conexao.php';

	$email = $_POST['email'];
	$senha = $_POST['senha'];

	//Monta o select
	$sql = "SELECT * FROM usuario WHERE email = :email AND ativo = true AND excluido = false LIMIT 1";

	$prepara = $conexao->prepare($sql);
	$prepara->execute(array(':email' => $email));
	
	$usuario = $prepara->fetchObject();

	if ($usuario) {
		if (crypt($senha, $usuario->senha) == $usuario->senha) { 
		   unset($usuario->senha);//unset para nao exibir a senha na session do usuario
		   $_SESSION['usuario'] = $usuario; //define o usuario logado

		   header('Location: /admin');//redireciona para pagina principal
		   exit();
		} else {
		   header('Location: /admin/login.php?erro=true');//redireciona para pagina login
		   exit();
		}
	} else {
		header('Location: /admin/login.php?erro=true');//redireciona para pagina login
	   	exit();
	}
?>