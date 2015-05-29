<?php 
    include '../verifica_login.php';
    include '../conexao.php';

	$id = $_GET['id'];
    $acao = "foi excluido";

	if ((int)$id > 0) {
		$sql = "UPDATE imagem set excluido = :excluido WHERE id = :id";

        $prepara = $conexao->prepare($sql);

        $params = array(':id' => $id, ':excluido' => 'true');

        $atualizar = $prepara->execute($params);

        if ($atualizar) {
            echo 'excluido';
        } else {
            echo 'erro';
        }
	}
?>