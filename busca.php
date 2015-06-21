<div class="col-md-3"></div>
<div class="col-md-9">
    <form method="GET" action="/paginas/busca.php" class="form-horizontal">
      <div class="form-group">
        <div class="col-md-11">
          <input required name="termo" value="<?php if(isset($_GET['termo'])) echo $termo; ?>" type="text" class="form-control" placeholder="Digite um Nome">
        </div>
        <div class="col-md-1">
            <button type="submit" class="btn btn-default pull-right">Procurar</button>
        </div>
      </div>
    </form>
</div>