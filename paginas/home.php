<?php 
  
  include '../admin/conexao.php';
  include '../verifica_login.php';
  include '../head.php';
  include '../topo.php';
 ?>
<div class="container">

    <div class="row">
        <?php include '../busca.php'; ?>
    </div>

    <div class="row">
        <?php include '../menu_lateral.php'; ?>
        <?php include 'menu_usuario.php' ?>
    </div> 
</div>

<?php include '../footer.php'; ?>