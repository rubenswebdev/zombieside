<?php
include '../admin/conexao.php';
include '../head.php';
include '../topo.php';

$termo = isset($_GET['termo']) ? $_GET['termo'] : false;
$paginarAcada = 6;
$jogos = array();
if($termo) {

    $sql = 'SELECT j.id AS id_jogo, j.descricao, j.nome, j.requisitos, j.data_lancamento, (SELECT caminho FROM imagem where imagem.id_jogo = j.id LIMIT 1) as imagem
            ,(SELECT count(js.id) as total
            FROM jogo js 
            INNER JOIN tipo_plataforma_jogo tpjs ON tpjs.id_jogo = js.id
            INNER JOIN plataforma ps ON ps.id = tpjs.id_plataforma
            WHERE js.excluido = FALSE AND js.ativo = TRUE AND LOWER(js.nome) LIKE LOWER(:termo)
            ) as total
            FROM jogo j 
            INNER JOIN tipo_plataforma_jogo tpj ON tpj.id_jogo = j.id
            INNER JOIN plataforma p ON p.id = tpj.id_plataforma
            WHERE j.excluido = FALSE AND j.ativo = TRUE AND LOWER(j.nome) LIKE LOWER(:termo)
            GROUP BY j.id
            LIMIT :limit OFFSET :offset;';


    if (isset($_GET['pagina'])) {
      $offset = $_GET['pagina'] * $paginarAcada;
    }

    $prepara = $conexao->prepare($sql);
    $prepara->execute(array(
                            ':termo' => '%'.$termo.'%',
                            ':offset' => (int)@$offset,
                            ':limit' => $paginarAcada
                            )
                    );
    
    $jogos = $prepara->fetchAll(PDO::FETCH_ASSOC);
}
?>

<div class="container">
     <div class="row">
        <?php include '../busca.php'; ?>
    </div>

    <div class="row">
        <?php include '../menu_lateral.php'; ?>
        <div class="col-md-9">
            
            <div class="row">
            
            <?php 
                if(isset($jogos) and count($jogos)) {

            ?>
             <div class="col-md-12"> 
                <div class="well">
                    Foram encontrados <?php echo $jogos[0]['total'] ?> resultados para "<?php echo $_GET['termo'] ?>".
                </div>
            </div>
            <?php
                foreach ($jogos as $jogo) { 
                    include 'jogo_listagem.php';
                 }
                }
             ?>
             
            </div>
            <?php if(count($jogos)) { ?>
            <div class="row">
                <div class="col-md-12">
                    <?php 
                    $total = $jogos[0]['total'];
                    $paginas = $total / $paginarAcada;



                    $totalDaPagina = count($jogos);
                    $totalDoOffset = (((int)@$_GET['pagina'] + 1) * $paginarAcada);


                    if ($totalDoOffset > $total ) {
                      $totalDoOffset =  $total;
                    }

                    echo 'Exibindo '. $totalDoOffset .' de '.$total.' resultados';
                   ?>
                  <nav>
                      <ul class="pagination">
                      
                        <li class="<?php if ((int)@$_GET['pagina'] - 1 < 0) echo 'disabled'; ?>">
                          <a href="<?php echo (int)@$_GET['pagina'] - 1 < 0 ? 'javascript:' : '?termo='.$_GET['termo'].'&pagina=' . ((int)@$_GET['pagina'] - 1) ?>" aria-label="Anterior">
                            <span aria-hidden="true">&laquo;</span>
                          </a>
                        </li>
                 
                        <?php for ($i=0; $i < $paginas; $i++) { ?>
                          <li class="<?php echo (int)@$_GET['pagina'] == $i ? 'active' : '' ?>"><a href="?termo=<?php echo $_GET['termo']; ?>&pagina=<?php echo $i ?>"><?php echo $i+1 ?></a></li>
                        <?php } ?>
                       
                        
                        <li class="<?php if ((int)@$_GET['pagina'] + 1 >= $paginas) echo 'disabled'; ?>">
                          <a href="<?php echo (int)@$_GET['pagina'] + 1 >= $paginas ? 'javascript:' : '?termo='.$_GET['termo'].'&pagina=' . ((int)@$_GET['pagina'] + 1) ?>"
                            aria-label="Próxima">
                            <span aria-hidden="true">&raquo;</span>
                          </a>
                        </li>
                      
                      </ul>
                    </nav>
                </div>
            </div>
            <?php } else { ?>
                <div class="well">
                    Nenhum jogo encontrado para o termo "<?php echo $_GET['termo']; ?>".
                </div>
            <?php } ?>
        </div>

    </div> 
</div>

<?php include '../footer.php'; ?>