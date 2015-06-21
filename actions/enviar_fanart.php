<?php 

require '../admin/conexao.php';
require '../verifica_login.php';


$arquivos = $_FILES['files'];
$id_usuario = $_SESSION['usuario']->id;
$id_jogo = $_POST['id_jogo'];
$titulo = $_POST['titulo'];


$erro = 0;

foreach ($arquivos['error'] as $key => $file) {
	if(!$arquivos['error'][$key]) {
		$tmp_name = $arquivos["tmp_name"][$key];
        $name = random_string(10).'_'.$arquivos["name"][$key];
        move_uploaded_file($tmp_name, "../uploads/fanarts/$name");

     	$sqlImgs = "INSERT INTO fanart (caminho, titulo, id_usuario, id_jogo, ativo, excluido) 
        			VALUES (:caminho, :titulo, :id_usuario, :id_jogo, false, false)";

        $prepare = $conexao->prepare($sqlImgs);


        $paramsImgs = array(
                        ':caminho' => "uploads/fanarts/$name",
                        ':titulo' => $titulo,
                        ':id_usuario' => $id_usuario,
                        ':id_jogo' => $id_jogo
                  );
        $inserir = $prepare->execute($paramsImgs);

        if(!$inserir) {
        	$erro++;
        }


	}
}

if($erro == 0) {
 	$_SESSION['class-msg'] = 'success';
    $_SESSION['msg'] = 'Sua fanart foi cadastrada com sucesso, em breve estará visível após moderação.';
 	header('Location: /paginas/jogo.php?id='.$id_jogo);//redireciona para pagina principal
   	exit();
}


