<?php

include '../admin/conexao.php';
include '../head.php';
include '../topo.php';

$area = 'jogo';


if(!isset($_GET['id']) OR (int)$_GET['id'] == 0) {
	header('Location: /index.php'); //redireciona
	exit(); //evitar hack no codigo
}

$id = $_GET['id'];


$sql = "SELECT * FROM jogo WHERE id = :id AND ativo = true AND excluido = false";

$prepara = $conexao->prepare($sql);

$params = array(':id' => $id);
$prepara->execute($params);

$jogo = $prepara->fetchObject();

if(!$jogo) {
	header('Location: /index.php'); //redireciona
	exit(); //evitar hack no codigo
}


//imagens 
$sql = "SELECT * FROM imagem WHERE id_jogo = :id AND ativo = true AND excluido = false";
$prepara = $conexao->prepare($sql);

$params = array(':id' => $id);
$prepara->execute($params);

$imagens = $prepara->fetchAll(PDO::FETCH_ASSOC);


//fanarts 
$sql = "SELECT * FROM fanart WHERE id_jogo = :id AND ativo = true AND excluido = false";
$prepara = $conexao->prepare($sql);

$params = array(':id' => $id);
$prepara->execute($params);

$fanarts = $prepara->fetchAll(PDO::FETCH_ASSOC);


//videos 
$sql = "SELECT * FROM video WHERE id_jogo = :id AND ativo = true AND excluido = false";
$prepara = $conexao->prepare($sql);

$params = array(':id' => $id);
$prepara->execute($params);

$videos = $prepara->fetchAll(PDO::FETCH_ASSOC);

//plataformas 
$sqlPl = "SELECT p.* FROM tipo_plataforma_jogo tj 
		INNER JOIN plataforma p ON p.id = tj.id_plataforma
		WHERE tj.id_jogo = :id";

$preparaPl = $conexao->prepare($sqlPl);

$paramsPl = array(':id' => $id);
$preparaPl->execute($paramsPl);

$plataformasJogo = $preparaPl->fetchAll(PDO::FETCH_ASSOC);


//tipos 
$sqlPl = "SELECT t.nome FROM jogo_tipo_jogo jtj
		INNER JOIN tipo_jogo t ON jtj.id_tipo_jogo = t.id WHERE jtj.id_jogo = :id;";

$preparaTip = $conexao->prepare($sqlPl);

$paramsTip = array(':id' => $id);
$preparaTip->execute($paramsTip);

$tipos = $preparaTip->fetchAll(PDO::FETCH_ASSOC);

/*var_dump($jogo);
var_dump($plataformasJogo);
var_dump($videos);
*/

?>
<div class="container">
     <div class="row">
        <?php include '../busca.php'; ?>
    </div>

    <div class="row">
        <?php include '../menu_lateral.php'; ?>
        <div class="col-md-9">
        	<div class="row">
    
        		<div class="col-md-10">
        			<h3>
        				<?php echo $jogo->nome ?> <?php if(isset($_SESSION['usuario'])) { ?>
		                	<span data-id="<?php echo $jogo->id ?>" class="star <?php if(in_array($jogo->id, $_SESSION['favoritos'])) echo 'favorito' ?>"><i class="fa fa-star"></i></span>
		                <?php } ?> - 
		                 <small>
		                	<?php 
		                	$ts = array();

		                	foreach ($tipos as $tipo) {
		                		$ts[] = $tipo['nome'];
		                	} 
		                	echo implode(', ', $ts);
		                	?>
		                </small>
	                </h3>

        		</div>
        		
        		<?php if (isset($_SESSION['usuario'])) { ?>
        		<div class="col-md-2">
                	<a href="/paginas/enviar_fanart.php?id_jogo=<?php echo $jogo->id ?>" class="pull-right btn btn-danger">Enviar FanArt</a>
        		</div>
        		<?php } ?>
        	</div>
			


			    <?php if(count($videos)) { ?>
			    <a  class="thumbnail">
			      <iframe id="video_jogo" width="100%" height="360"
					src="<?php echo str_replace('watch?v=', 'embed/', $videos[0]['caminho']); ?>">
				  </iframe>
			    </a>
			    <?php } ?>

			    <?php if(count($videos)) { ?>
				<div class="row">
					<div class="col-md-12">
						<h4>Videos:</h4>
					</div>
						
					<?php foreach ($videos as  $vd) { ?>
						<div class="col-md-3">
							<a  class="thumbnail">
								<?php 
									preg_match('/.*watch\?v=(.*)/', $vd['caminho'], $id_video_youtube);
								 ?>
						     	 <img class="video_mini" data-src="<?php echo str_replace('watch?v=', 'embed/', $vd['caminho']); ?>" style="height:100px" src="http://img.youtube.com/vi/<?php echo $id_video_youtube[1] ?>/default.jpg" alt="<?php echo $jogo->nome ?>">
						    </a>
					    </div>
					<?php } ?>
				</div>
				<?php } ?>
				
				<?php if(count($imagens)) { ?>
				<div class="row">
					<div class="col-md-12">
						<h4>Imagens:</h4>
					</div>
					<?php foreach ($imagens as  $img) { ?>
						<div class="col-md-3">
							<a  href="../<?php echo $img['caminho'] ?>"   class="thumbnail" data-gallery="imagens">
						      <img style="height:100px" src="../<?php echo $img['caminho'] ?>" alt="<?php echo $jogo->nome ?>">
						    </a>
					    </div>
					<?php } ?>
				</div>
				<?php } ?>

				<?php if(count($fanarts)) { ?>
				<div id="fanarts" class="row">
					<div class="col-md-12">
						<h4>FanArts:</h4>
					</div>
					<?php foreach ($fanarts as  $img) { ?>
						<div class="col-md-3">
							<a  href="../<?php echo $img['caminho'] ?>"   class="thumbnail" data-gallery="fanarts">
						      <img style="height:100px" src="../<?php echo $img['caminho'] ?>" alt="<?php echo $jogo->nome ?>">
						    </a>
					    </div>
					<?php } ?>
				</div>
				<?php } ?>
				
				<div class="row">
					<div class="col-md-12">
						<h4>Descrição</h4>
						<div class="well">
							<?php echo $jogo->descricao ?>
						</div>
					</div>
					<div class="col-md-9">
						<h4>Requisitos</h4>
						<div class="well">
							<?php echo $jogo->requisitos ?>
						</div>
					</div>
					<div class="col-md-3">
						<h4>Plataformas</h4>
						<div class="well">
							<ul>
								<?php foreach ($plataformasJogo as $plat) { ?>
									<li><?php echo $plat['nome']; ?></li>
								<?php } ?>
							</ul>
						</div>
					</div>
				</div>
				<?php if(isset($_SESSION['usuario'])) { ?>
				<div class="row">
					<div class="col-md-12">
						<form action="../actions/publicar.php" method="POST">
							<div class="form-group">
								<textarea 
									placeholder="Escreva aqui sua opinião sobre o jogo" 
									name="opiniao" id="opiniao" cols="30" 
									rows="5"
									class="form-control"></textarea>
							</div>
							<div class="form-group">
								<button type="submit" class="pull-right btn btn-primary">Publicar</button>
								<div class="clearfix"></div>
							</div>
							<input type="hidden" name="id_jogo" value="<?php echo $jogo->id ?>">
						</form>
					</div>
				</div>
				<?php } ?>
				<?php 
						$sql = "SELECT o.*, u.nome as nome FROM opiniao o 
						INNER JOIN usuario u on u.id = o.id_usuario
						WHERE o.id_jogo = :id_jogo AND o.ativo = true AND o.excluido = false
						ORDER BY id desc";

						$prepara = $conexao->prepare($sql);

						$params = array(':id_jogo' => $jogo->id);
						$prepara->execute($params);

						$opinioes = $prepara->fetchAll(PDO::FETCH_ASSOC);
						if(count($opinioes)) {
				 ?>

				<div class="row">
					<div class="col-md-12">
						<h4>Opiniões</h4>
						<?php foreach ($opinioes as $opiniao) { ?>
							<div class="well">
								<small><?php echo $opiniao['nome'] ?> dia <?php echo (new Datetime($opiniao['data_opinado']))->format('d/m/Y') ?> disse:</small> <br>
								<?php echo $opiniao['texto'] ?>
							</div>
						<?php } ?>
					</div>
				</div>
				<?php } ?>
        </div>
   </div>
</div>

<?php include '../footer.php'; ?>
