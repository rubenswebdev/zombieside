<?php
session_start();
ini_set('display_errors', 'ON');
error_reporting(E_ALL);
 try {
    $conexao = new PDO("pgsql:host=localhost dbname=zs user=postgres password=ruhs2 port=5432");

    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 } catch (PDOException  $e) {
    print $e->getMessage();
 }

function listarPlataformasAtivos($conexao) {
    //Monta o select
    $sql = "SELECT * FROM plataforma WHERE excluido = false AND ativo = true ORDER BY id";

    $prepara = $conexao->prepare($sql);
    $prepara->execute();

    return $prepara->fetchAll();
}

function listarTiposAtivos($conexao) {
    //Monta o select
    $sql = "SELECT * FROM tipo_jogo WHERE excluido = false AND ativo = true ORDER BY id";

    $prepara = $conexao->prepare($sql);
    $prepara->execute();

    return $prepara->fetchAll();
}

function listarUsuariosAtivos($conexao) {
	//Monta o select
    $sql = "SELECT * FROM usuario WHERE excluido = false AND ativo = true ORDER BY id";

    $prepara = $conexao->prepare($sql);
    $prepara->execute();

    return $prepara->fetchAll();
}


function listarPlataformas($conexao) {
    //Monta o select
    $sql = "SELECT * FROM plataforma WHERE excluido = false ORDER BY id";

    $prepara = $conexao->prepare($sql);
    $prepara->execute();

    return $prepara->fetchAll();
}

function listarTipos($conexao) {
    //Monta o select
    $sql = "SELECT * FROM tipo_jogo WHERE excluido = false ORDER BY id";

    $prepara = $conexao->prepare($sql);
    $prepara->execute();

    return $prepara->fetchAll();
}

function listarUsuarios($conexao) {
	//Monta o select
    $sql = "SELECT * FROM usuario WHERE excluido = false ORDER BY id";

    $prepara = $conexao->prepare($sql);
    $prepara->execute();

    return $prepara->fetchAll();
}

function qtdUsuarios($conexao) {
	$sql = "SELECT COUNT(id) as qtd FROM usuario WHERE excluido = false AND ativo = true";

    $prepara = $conexao->prepare($sql);
    $prepara->execute();

    return $prepara->fetch();
}

function qtdPlataformas($conexao) {
	$sql = "SELECT COUNT(id) as qtd FROM plataforma WHERE excluido = false AND ativo = true";

    $prepara = $conexao->prepare($sql);
    $prepara->execute();

    return $prepara->fetch();
}

function qtdTipos($conexao) {
	$sql = "SELECT COUNT(id) as qtd FROM tipo_jogo WHERE excluido = false AND ativo = true";

    $prepara = $conexao->prepare($sql);
    $prepara->execute();

    return $prepara->fetch();
}
function qtdJogos($conexao) {
	$sql = "SELECT COUNT(id) as qtd FROM jogo WHERE excluido = false AND ativo = true";

    $prepara = $conexao->prepare($sql);
    $prepara->execute();

    return $prepara->fetch();
}

function random_string($length) {
    $key = '';
    $keys = array_merge(range(0, 9), range('a', 'z'));

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }

    return $key;
}

?>