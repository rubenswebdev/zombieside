<!-- Modal -->
<div class="modal fade" id="cadastro" tabindex="-1" role="dialog" aria-labelledby="titleCadastrese" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="titleCadastrese">Cadastre-se</h4>
      </div>
      <div class="modal-body">
        <form action="/actions/cadastrar.php" method="POST">
          <div class="form-group">
            <label for="nome" class="control-label">Nome:</label>
            <input type="text" name="nome" class="form-control">
          </div>
          <div class="form-group">
            <label for="login" class="control-label">Login:</label>
            <input type="text" name="login" class="form-control">
          </div>
          <div class="form-group">
            <label for="email" class="control-label">Email:</label>
            <input type="email" name="email" class="form-control">
          </div>
          <div class="form-group">
            <label for="password" class="control-label">Senha:</label>
            <input type="password" name="password" class="form-control">
          </div>
          <div class="form-group">
            <label for="confirm-password" class="control-label">Confirme a senha:</label>
            <input type="password" name="confirm-password" class="form-control">
          </div>
          <div class="form-group">
              <button type="submit" class="btn btn-danger">Cadastrar</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
          </div>
        </form>
      </div>
      
    </div>
  </div>
</div>