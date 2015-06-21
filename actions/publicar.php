<?php
require '../admin/conexao.php';
require '../verifica_login.php';


$texto = strip_tags($_POST['opiniao']);
$id_usuario = $_SESSION['usuario']->id;
$id_jogo = $_POST['id_jogo'];


$sql = "SELECT * FROM opiniao WHERE id_usuario = :id_usuario AND id_jogo = :id_jogo";

$prepara = $conexao->prepare($sql);
$params = array(':id_usuario' => $id_usuario, ':id_jogo' => $id_jogo);
$prepara->execute($params);
$opiniao = $prepara->fetchObject();




if ($opiniao) {
	$sql = "UPDATE opiniao set texto = :texto, data_opinado = NOW(), ativo = false WHERE id_jogo = :id_jogo AND id_usuario = :id_usuario";
} else {
	$sql = "INSERT INTO opiniao (id_jogo, id_usuario, texto, data_opinado, excluido, ativo) 
		VALUES (:id_jogo, :id_usuario, :texto, NOW(), false, false)";
}
$params = array(':id_usuario' => $id_usuario, ':id_jogo' => $id_jogo, ':texto' => $texto);

$prepara = $conexao->prepare($sql);



$opiniao = $prepara->execute($params);

if($opiniao) {
 	$_SESSION['class-msg'] = 'success';
    $_SESSION['msg'] = 'Sua opinião foi cadastrada com sucesso, em breve estará visível após moderação.';
 	header('Location: /paginas/jogo.php?id='.$id_jogo);//redireciona para pagina principal
   	exit();
}

