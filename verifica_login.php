<?php

	//verifica se existe usuario logado
	if (!$_SESSION['usuario']) { 
		header('Location: /index.php'); //redireciona
		exit(); //evitar hack no codigo
	}
?>