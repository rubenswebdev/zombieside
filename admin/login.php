<?php
  include 'head.php';

  if ($_GET['acao'] == 'sair') {
    session_destroy();
    header('Location: /admin/login.php');
    exit();
  }
?>
    <link rel="stylesheet" href="../css/login.css">
    <div class="container">

      <form action="_login.php" method="POST" class="form-signin">
        <h2 class="form-signin-heading">Por favor efetue login</h2>
        <label for="inputEmail" class="sr-only">Email</label>
        <input type="email" id="email" name="email" class="form-control" placeholder="Email" required autofocus>
        <label for="inputPassword" class="sr-only">Senha</label>
        <input type="password" id="senha" name="senha" class="form-control" placeholder="Senha" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>

        <?php 
          if ($_GET['erro']) {
        ?>
            <div class="alert alert-danger" role="alert">Usuário ou senha incorretos</div>
        <?php  
          }
        ?>
      </form>


    </div> <!-- /container -->

<?php 
  include 'footer.php'; 
?>
