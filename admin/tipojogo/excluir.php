<?php 
    include '../verifica_login.php';
    include '../conexao.php';

	$id = $_GET['id'];

	if ((int)$id > 0) {
		$sql = "UPDATE tipo_jogo set excluido = true WHERE id = :id";

        $prepara = $conexao->prepare($sql);

        $params = array(':id' => $id);

        $excluir = $prepara->execute($params);

        if ($excluir) {
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=/admin/tipojogo/listar.php?msg=Tipo excluido com sucesso!">';
        	exit();
        }
	}
?>