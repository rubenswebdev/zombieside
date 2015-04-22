<?php
	session_start();
	//verifica se existe usuario logado
	if (!$_SESSION['usuario']) { //se nao existir !
		header('Location: /admin/login.php'); //redireciona
		exit(); //evitar hack no codigo
	}
?>