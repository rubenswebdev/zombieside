<div class="col-md-9">
		<?php 
			$sql = "select j.*,j.id as id_jogo, (SELECT caminho FROM imagem where imagem.id_jogo = j.id LIMIT 1) as imagem from favorito f 
					inner join jogo j on j.id = f.id_jogo
					where f.id_usuario = :id_usuario AND j.excluido = false and j.ativo = true;";

			$prepara = $conexao->prepare($sql);
			$params = array(':id_usuario' => $_SESSION['usuario']->id);

			$prepara->execute($params);

			$jogos = $prepara->fetchAll(PDO::FETCH_ASSOC);
		?>


		<?php 
			$sql = "SELECT f.*,u.nome as nome,j.nome as jogo, (SELECT COUNT(*) FROM fanart WHERE excluido = false) as total FROM fanart f
					    INNER JOIN usuario u on u.id = f.id_usuario
					    INNER JOIN jogo j on j.id = f.id_jogo
					    WHERE f.excluido = false AND f.id_usuario = :id_usuario ORDER BY f.id, f.ativo;
					";

			$prepara = $conexao->prepare($sql);
			$params = array(':id_usuario' => $_SESSION['usuario']->id);

			$prepara->execute($params);

			$fanarts = $prepara->fetchAll(PDO::FETCH_ASSOC);
		?>
	    <div class="row">
	        <div class="col-md-12">
	            <div class="panel with-nav-tabs panel-danger">
	                <div class="panel-heading">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#fanarts" data-toggle="tab">FanArts</a></li>
                            <li><a href="#jogos" data-toggle="tab">Jogos Favoritos</a></li>
                        </ul>
	                </div>
	                <div class="panel-body">
	                    <div class="tab-content">
	                        <div class="tab-pane fade in active" id="fanarts">
								<?php 
	                        	if(isset($fanarts) and count($fanarts)) 
	                        	foreach ($fanarts as $key => $fanart) { ?>
	                        			 <div class="col-md-3">
										    <div class="thumbnail">
										        <img style="height:100px" src="../<?php echo $fanart['caminho']; ?>" alt="Sem imagem" class="img-responsive" />
										        <div class="caption">
										             <h5><?php echo $fanart['titulo'] ?> </h5>
										             <a href="/actions/desativar_fanart.php?id=<?php echo $fanart['id'] ?> ">Excluir</a>
										        </div>
										    </div>
										</div>
	                        	<?php } ?>
	                        </div>
	                        <div class="tab-pane fade" id="jogos">
	                        	<?php 
	                        	if(isset($jogos) and count($jogos)) 
	                        	foreach ($jogos as $key => $jogo) {
	                        		include 'jogo_listagem.php';
	                        	} ?>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
		</div>
</div>