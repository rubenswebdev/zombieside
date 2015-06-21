<?php 

    require '../admin/conexao.php';
    require '../verifica_login.php';

	$id = $_GET['id'];

	if ((int)$id > 0) {
		$sql = "UPDATE fanart set excluido = true WHERE id = :id";

        $prepara = $conexao->prepare($sql);

        $params = array(':id' => $id);

        $atualizar = $prepara->execute($params);

        if ($atualizar) {
            echo '<META HTTP-EQUIV="Refresh" CHARSET="utf-8" Content="0;  URL=/paginas/home.php">';
        	exit();
        }
	}
?>