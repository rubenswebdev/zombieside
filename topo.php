<body>
 <nav class="navbar navbar-default">
    <div class="container">
      <div class="navbar-header">
        <a class="navbar-brand" href="/">
          ZombieSide
        </a>
      </div>
      <form class="navbar-form navbar-right" role="search">
          <?php if (isset($_SESSION['usuario'])) { ?>
           <a href="/paginas/home.php" class="btn btn-info"> Bem vindo(a) <?php echo $_SESSION['usuario']->nome; ?></a>
           <a href="/actions/sair.php" class="btn btn-danger">Sair</a>
          <?php } else { ?>    
            <a href="" data-toggle="modal" data-target="#login" class="btn btn-danger">Login</a>
            <a href="javascript:" data-toggle="modal" data-target="#cadastro" class="btn btn-danger">Cadastro</a>
          <?php } ?>    
      </form>
    </div>
  </nav>
  <?php 
  include 'paginas/modal_cadastro.php';
  include 'paginas/modal_login.php';
  if (isset($_SESSION['msg'])) { ?>
  <div class="container">
    <div class="col-md-12 alert alert-<?php  echo $_SESSION['class-msg'] ?>">
        <?php 
          echo $_SESSION['msg']; 
          unset($_SESSION['msg']);
        ?>
    </div>
  </div>
  <?php } ?>