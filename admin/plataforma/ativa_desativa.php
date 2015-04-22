<?php 
    include '../verifica_login.php';
    include '../conexao.php';

	$id = $_GET['id'];
	$acao = $_GET['acao'];

	$ativo = $acao == 'desativado' ? 'false' : 'true';
	if ((int)$id > 0) {
		$sql = "UPDATE plataforma set ativo = :ativo WHERE id = :id";

        $prepara = $conexao->prepare($sql);

        $params = array(':id' => $id, ':ativo' => $ativo);

        $atualizar = $prepara->execute($params);

        if ($atualizar) {
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=/admin/plataforma/listar.php?msg=Plataforma '.$acao.' com sucesso!">';
        	exit();
        }
	}
?>