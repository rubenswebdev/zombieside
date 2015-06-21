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


function listarPlataformas($conexao, $paginarAcada) {
    //Monta o select
 
    $sql = "SELECT *, (SELECT COUNT(*) FROM plataforma WHERE excluido = false) as total FROM plataforma WHERE excluido = false ORDER BY id  LIMIT :limit OFFSET :offset";

    $prepara = $conexao->prepare($sql);

    if (isset($_GET['pagina'])) {
      $offset = $_GET['pagina'] * $paginarAcada;
    }

    $params = array(
                ':offset' => (int)@$offset,
                ':limit' => $paginarAcada
    );

    $prepara->execute($params);

    return $prepara->fetchAll();
}

function listarTipos($conexao, $paginarAcada) {
    //Monta o select
    $sql = "SELECT *, (SELECT COUNT(*) FROM tipo_jogo WHERE excluido = false) as total FROM tipo_jogo WHERE excluido = false ORDER BY id  LIMIT :limit OFFSET :offset";

    $prepara = $conexao->prepare($sql);
     
    if (isset($_GET['pagina'])) {
      $offset = $_GET['pagina'] * $paginarAcada;
    }

    $params = array(
                ':offset' => (int)@$offset,
                ':limit' => $paginarAcada
    );

    $prepara->execute($params);

    return $prepara->fetchAll();
}

function listarUsuarios($conexao, $paginarAcada) {
	//Monta o select
    $sql = "SELECT *, (SELECT COUNT(*) FROM usuario WHERE excluido = false) as total FROM usuario WHERE excluido = false ORDER BY id LIMIT :limit OFFSET :offset";


    if (isset($_GET['pagina'])) {
      $offset = $_GET['pagina'] * $paginarAcada;
    }

    $params = array(
                ':offset' => (int)@$offset,
                ':limit' => $paginarAcada
    );

    $prepara = $conexao->prepare($sql);
    $prepara->execute($params);

    return $prepara->fetchAll();
}

function listarOpinioes($conexao, $paginarAcada) {
    //Monta o select
    $sql = "SELECT o.*,u.nome as nome,j.nome as jogo, (SELECT COUNT(*) FROM opiniao WHERE excluido = false) as total FROM opiniao o
    INNER JOIN usuario u on u.id = o.id_usuario
    INNER JOIN jogo j on j.id = o.id_jogo
    WHERE o.excluido = false ORDER BY o.id, o.ativo LIMIT :limit OFFSET :offset";

    if (isset($_GET['pagina'])) {
      $offset = $_GET['pagina'] * $paginarAcada;
    }

    $params = array(
                ':offset' => (int)@$offset,
                ':limit' => $paginarAcada
    );

    $prepara = $conexao->prepare($sql);
    $prepara->execute($params);

    return $prepara->fetchAll();
}


function listarFanarts($conexao, $paginarAcada) {
    //Monta o select
    $sql = "SELECT f.*,u.nome as nome,j.nome as jogo, (SELECT COUNT(*) FROM fanart WHERE excluido = false) as total FROM fanart f
    INNER JOIN usuario u on u.id = f.id_usuario
    INNER JOIN jogo j on j.id = f.id_jogo
    WHERE f.excluido = false ORDER BY f.id, f.ativo LIMIT :limit OFFSET :offset";

    if (isset($_GET['pagina'])) {
      $offset = $_GET['pagina'] * $paginarAcada;
    }

    $params = array(
                ':offset' => (int)@$offset,
                ':limit' => $paginarAcada
    );

    $prepara = $conexao->prepare($sql);
    $prepara->execute($params);

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


function verificaEmail($conexao, $email) {
    $sql = "SELECT * FROM usuario WHERE email = :email";
    $prepara = $conexao->prepare($sql);

    $params = array(':email' => $email);

    $prepara->execute($params);
    
    return $prepara->fetch();
}

?>