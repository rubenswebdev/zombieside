<?php 

require '../admin/conexao.php';
require '../verifica_login.php';

$id = $_GET['id'];
$acao = $_GET['acao'];


$sqlJogo = "SELECT * FROM jogo WHERE id = :id AND excluido = false AND ativo = true";

$prepara = $conexao->prepare($sqlJogo);

$params = array(':id' => $id);
$prepara->execute($params);
$jogo = $prepara->fetchObject();

if($acao == 'favoritar') {
	

	if($jogo) {

		$id_usuario = $_SESSION['usuario']->id;
		$id_jogo = $jogo->id;

		$sqlFavoritar = "INSERT INTO favorito (id_usuario, id_jogo, data_favoritado) VALUES (:id_usuario, :id_jogo, NOW())";
		$prepara = $conexao->prepare($sqlFavoritar);

		$params = array(':id_usuario' => $id_usuario, ':id_jogo' => $id_jogo);

		$favorito = $prepara->execute($params);

		if($favorito) {
			$_SESSION['favoritos'][] = $jogo->id;
			echo 'ok';
		} else {
			echo 'erro';
		}
	}
} else {
	$sql = "DELETE FROM favorito WHERE id_jogo = :id_jogo AND id_usuario = :id_usuario";
	
	$prepara = $conexao->prepare($sql);


	$id_usuario = $_SESSION['usuario']->id;
	$id_jogo = $jogo->id;

	$params = array(':id_usuario' => $id_usuario, ':id_jogo' => $id_jogo);

	$desfazer = $prepara->execute($params);

	if($desfazer) {

		foreach ($_SESSION['favoritos'] as  $key => $fav) {
			if ($fav == $id_jogo) {
				unset($_SESSION['favoritos'][$key]);
				echo 'ok';
			}
		}

	} else {
		echo 'erro';
	}
}
