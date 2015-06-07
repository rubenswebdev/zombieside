<?php

include '../verifica_login.php';
include '../conexao.php';

$checked = $_GET['checked'];
$id = $_GET['id'];

if((int)$id > 0) {
	$sql = 'UPDATE imagem SET slide = :slide WHERE id = :id';
    $prepara = $conexao->prepare($sql);

    $params = array(':id' => $id, ':slide' => $checked);

    $atualizar = $prepara->execute($params);

    if ($atualizar) {
        echo 'ok';
    } else {
        echo 'erro';
    }
}