<div class="col-sm-3 col-md-2 sidebar">
  <ul class="nav nav-sidebar">
    <li class="<?php if ($_SESSION['menu_ativo'] == 'resumo') echo 'active';?>">
    	<a href="/admin/">Resumo <span class="sr-only">(current)</span></a>
    </li>
    <li class="<?php if ($_SESSION['menu_ativo'] == 'usuario') echo 'active';?>">
    	<a href="/admin/usuario/listar.php">Usuários <span class="sr-only">(current)</span></a>
    </li>
    <li class="<?php if ($_SESSION['menu_ativo'] == 'plataforma') echo 'active';?>">
    	<a href="/admin/plataforma/listar.php">Plataformas <span class="sr-only">(current)</span></a>
    </li>
    <li class="<?php if ($_SESSION['menu_ativo'] == 'tipojogo') echo 'active';?>">
    	<a href="/admin/tipojogo/listar.php">Tipo de Jogo<span class="sr-only">(current)</span></a>
    </li>
    <li class="<?php if ($_SESSION['menu_ativo'] == 'jogo') echo 'active';?>">
    	<a href="/admin/jogo/listar.php">Jogos<span class="sr-only">(current)</span></a>
    </li>
     <li class="<?php if ($_SESSION['menu_ativo'] == 'opinioes') echo 'active';?>">
        <a href="/admin/opinioes/listar.php">Opiniões<span class="sr-only">(current)</span></a>
    </li>
     <li class="<?php if ($_SESSION['menu_ativo'] == 'fanarts') echo 'active';?>">
        <a href="/admin/fanarts/listar.php">FanArts<span class="sr-only">(current)</span></a>
    </li>
  </ul>
</div>