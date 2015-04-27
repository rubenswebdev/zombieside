<?php 
    include '../verifica_login.php';
    include '../conexao.php';

	$id = $_GET['id'];

	if ((int)$id > 0) {
		$sql = "UPDATE plataforma set excluido = true WHERE id = :id";

        $prepara = $conexao->prepare($sql);

        $params = array(':id' => $id);

        $excluir = $prepara->execute($params);

        if ($excluir) {
            echo '<META HTTP-EQUIV="Refresh" CHARSET=UTF-8 Content="0; URL=/admin/plataforma/listar.php?msg=Plataforma excluida com sucesso!">';
        	exit();
        }
	}
?>