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
								FAN ARTS
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