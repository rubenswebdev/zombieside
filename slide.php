<?php 
  $sql = "SELECT * FROM imagem where slide = true and ativo = true and excluido = false";

  $prepara = $conexao->prepare($sql);
  $prepara->execute();
  $slides = $prepara->fetchAll(PDO::FETCH_ASSOC);

/*  var_dump($slides);*/
 ?>
<div class="col-md-9">
    <div id="carousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <?php foreach ($slides as $i => $img) { ?>
          <li data-target="#carousel" data-slide-to="<?php echo $i ?>" class="<?php if($i == 0) echo 'active' ?>"></li>
        <?php } ?>
        
      </ol>

      <!-- Wrapper for slides -->
      <div class="carousel-inner" role="listbox">
        <?php foreach ($slides as $i => $img) { ?>
        <div class="item <?php if($i == 0) echo 'active' ?>">
          <img src="<?php echo $img['caminho'] ?>" alt="...">
          <div class="carousel-caption">
          </div>
        </div>
        <?php } ?>
        
      </div>
     
      <a class="left carousel-control" href="#carousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#carousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
     <!-- Indicators -->
    <div class="row">
        <?php foreach ($slides as $i => $img) { ?>
        <div class="col-md-3 mini-left" data-slide-to="<?php echo $i ?>" data-target="#carousel">
          <img alt="" class="miniatura" src="<?php echo $img['caminho'] ?>">
        </div>
        <?php } ?>
    </div>
      <!-- Controls -->
</div>