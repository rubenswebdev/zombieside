<?php 
 $plataformas = listarPlataformasAtivos($conexao);
?>
<div class="col-md-3">
    <ul class="nav nav-pills nav-stacked">
        <li role="presentation" class="<?php if(!isset($_GET['id'])) echo 'active'; ?> "><a href="/">Início</a></li>
        <?php foreach ($plataformas as $plataforma) { ?>
            <li class="<?php if (isset($_GET['id']) and $_GET['id'] == $plataforma['id']) echo 'active'; ?>" role="presentation"><a href="/paginas/plataforma.php?id=<?php echo $plataforma['id'] ?>"><?php echo $plataforma['nome'] ?></a></li>
        <?php } ?>
    </ul>       
</div>