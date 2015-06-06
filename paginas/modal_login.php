<!-- Modal -->
<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="titleLogin" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="titleLogin">Login</h4>
      </div>
      <div class="modal-body">
        <form action="/actions/login.php" method="POST">
         
          <div class="form-group">
            <label for="login" class="control-label">Login:</label>
            <input type="text" name="login" class="form-control">
          </div>

          <div class="form-group">
            <label for="password" class="control-label">Senha:</label>
            <input type="password" name="password" class="form-control">
          </div>
       
          <div class="form-group">
              <button type="submit" class="btn btn-danger">Logar</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
          </div>
        </form>
      </div>
      
    </div>
  </div>
</div>