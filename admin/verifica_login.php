<?php
	session_start();
	//verifica se existe usuario logado
	if (!$_SESSION['usuario'] or $_SESSION['usuario']->permissao == 'user') { 
		header('Location: /admin/login.php'); //redireciona
		exit(); //evitar hack no codigo
	}
?>