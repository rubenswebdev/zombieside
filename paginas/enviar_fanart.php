<?php
require '../admin/conexao.php';
require '../verifica_login.php';

include '../head.php';
include '../topo.php';

$id_jogo = (int) $_GET['id_jogo'];
$jogo = false;

if ($id_jogo > 0) {
	$sql = "SELECT * FROM jogo WHERE id = :id_jogo AND ativo = true AND excluido = FALSE";
	$prepara = $conexao->prepare($sql);
	$params = array(':id_jogo' => $id_jogo);
	$prepara->execute($params);
	$jogo = $prepara->fetchObject();

}

?>
<div class="container">

	<div class="row">
		<?php if($jogo) { ?>
		<div class="col-md-12">
			<h3>Envio de Fan-Art para o jogo: <?php echo $jogo->nome ?></h3>
			<form action="/actions/enviar_fanart.php" type method="POST" enctype="multipart/form-data" role="form">
				<div class="form-group">
					<label for="titulo">Titulo:</label>
					<input required placeholder="Titulo para fanart do jogo" type="text" class="form-control" name="titulo">
				</div>

				<div class="form-group">
					<label for="arquivos">Arquivos:</label>
					<input name="files[]" required type="file" multiple>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-danger">Enviar</button>
				</div>
				<input type="hidden" value="<?php echo $jogo->id ?>" name="id_jogo">
			</form>
		</div>
		<?php } else { ?>
		<div class="col-md-12">
			<div class="alert alert-danger">Jogo inválido</div>
		</div>
		<?php } ?>
	</div>

</div>

