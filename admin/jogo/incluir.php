<?php 
    include '../head.php';
    include '../verifica_login.php';
    include '../menu_topo.php';
    $_SESSION['menu_ativo'] = 'jogo';
    include '../menu_lateral.php';

    include '../conexao.php';

    $plataformas = listarPlataformasAtivos($conexao);
    $tipos = listarTiposAtivos($conexao);

    if (count($_POST)) {

        $nome = $_POST['nome'];
        $requisitos = $_POST['requisitos'];

        $data_lancamento = $_POST['data_lancamento'];

        $descricao = $_POST['descricao'];
        $id_tipo = $_POST['tipo'];
        $id_plataforma = $_POST['plataforma'];
        $ativo = !isset($_POST['ativo']) ? 'false' : 'true';

        $sql = "INSERT INTO jogo (nome, requisitos, data_lancamento, ativo, descricao, id_tipo, id_plataforma) 
                VALUES (:nome, :requisitos, :data_lancamento, :ativo, :descricao, :id_tipo, :id_plataforma)";

        $prepara = $conexao->prepare($sql);

        $params = array(
                        ':nome' => $nome,
                        ':requisitos' => $requisitos,
                        ':data_lancamento' => $data_lancamento,
                        ':ativo' => $ativo,
                        ':descricao' => $descricao,
                        ':id_tipo' => $id_tipo,
                        ':id_plataforma' => $id_plataforma
                  );

        $inserir = $prepara->execute($params);

        $id_jogo = $conexao->lastInsertId('jogo_id_seq');


        
        //IMAGENS
        foreach ($_FILES["imagens"]["error"] as $key => $error) {
            if (!$error) {
                $tmp_name = $_FILES["imagens"]["tmp_name"][$key];
                $name = random_string(10).'_'.$_FILES["imagens"]["name"][$key];
                move_uploaded_file($tmp_name, "../../uploads/jogos/$name");

                $sqlImgs = "INSERT INTO imagem (slide, data_enviado, caminho, ativo, id_jogo, excluido) 
                VALUES (:slide, :data_enviado, :caminho, :ativo, :id_jogo, :excluido)";
                $preparaImgs = $conexao->prepare($sqlImgs);

                $data_enviado = new Datetime;
                $data_enviado = $data_enviado->format('Y-m-d');

                $paramsImgs = array(
                                ':slide' => 'true',
                                ':data_enviado' => $data_enviado,
                                ':caminho' => "../../uploads/jogos/$name",
                                ':ativo' => 'true',
                                ':id_jogo' => $id_jogo,
                                ':excluido' => 'false'
                          );
                $inserirImg = $preparaImgs->execute($paramsImgs);

            }
        }
        //END


        if($inserir) {
          echo '<META HTTP-EQUIV="Refresh" CHARSET=UTF-8 Content="0; URL=/admin/jogo/listar.php?msg=Jogo cadastrado com sucesso!">';
          exit();
        } else {
          $erro = "Ocorreu um erro com o cadastro, tente novamente!";
        }


    }
    
    //REINDEX TABLE jogo;
    //INSERT INTO jogo VALUES (1,'admin', false,'admin@zombieside.com.br', 'admin', true, '$1$SQZAG4D2$rZPDi1.Lm4Hi8dIDQXBM61', 'admin');


?>
    <!-- Icones do editor -->
    <link href="/css/font-awesome.min.css" rel="stylesheet">
    <!-- // -->
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">Cadastro de Jogo</h1>
        <?php if (isset($erro)) { ?>
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong><?php echo $erro; ?></strong>
        </div>
        <?php } ?>
       
        <form action="/admin/jogo/incluir.php" method="POST" enctype="multipart/form-data" role="form">
          <legend>Novo Jogo</legend>
        
          <div class="form-group">
            <label for="">Nome</label>
            <input type="text" value="<?php echo @$_POST['nome']; ?>" required class="form-control" id="nome" name="nome" placeholder="Nome">
          </div>
          <div class="form-group">
            <label for="">Data de Lançamento</label>
            <input type="date" value="<?php echo @$_POST['data_lancamento']; ?>" required class="form-control" id="data_lancamento" name="data_lancamento" placeholder="Data de Lançamento">
          </div>
          <div class="form-group">
            <label for="">Plataforma</label>
            <select required class="form-control" name="plataforma" id="plataforma">
              <?php foreach ($plataformas as $plat) { ?>
                <option value="<?php echo $plat['id'] ?>"><?php echo $plat['nome'] ?></option>
              <?php } ?>
            </select>
          </div>

          <div class="form-group">
            <label for="">Tipo</label>
            <select required class="form-control" name="tipo" id="tipo">
              <?php foreach ($tipos as $tipo) { ?>
                <option value="<?php echo $tipo['id'] ?>"><?php echo $tipo['nome'] ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="">Requisitos</label>
            <textarea name="requisitos" id="requisitos" cols="30" rows="10"></textarea>
          </div>

          <div class="form-group">
            <label for="">Descrição</label>
            <textarea name="descricao" id="descricao" cols="30" rows="10"></textarea>
          </div>
          <div class="form-group">
            <label for="">Imagens</label>
            <input name="imagens[]" type="file" multiple>
          </div>
           
          <div class="checkbox">
            <label>
              <input checked name="ativo" type="checkbox" value="1">
              Ativo
            </label>
          </div>
        
          
        
          <button type="submit"  id="submit-all" class="btn btn-primary">Cadastrar</button>
        </form>

    </div>
  <?php 
    include '../footer.php';
  ?>