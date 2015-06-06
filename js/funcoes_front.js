$(function(){

  $(".star").click(favoritar);

  function favoritar(){
    var _this = $(this);
    var id = _this.attr('data-id');

    if (_this.hasClass('favorito')) {
      $.get('/actions/favoritar.php?acao=desfazer&id=' + id, {}, function(data){
        if (data == 'ok') {
          _this.removeClass("favorito");
          alert('Removido de seus favoritos com sucesso!');
        } else {
          alert('Não foi possível completar o pedido!');
        }
      });

    } else {

      $.get('/actions/favoritar.php?acao=favoritar&id=' + id, {}, function(data){
        if (data == 'ok') {
          _this.addClass("favorito");
          alert('Favoritado com sucesso!');
        } else {
          alert('Não foi possível favoritar!');
        }
      });
    }
  }

});
