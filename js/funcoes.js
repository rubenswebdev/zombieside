$(function(){
  $('#requisitos').summernote({height: 200});
  $('#descricao').summernote({height: 200});


  $('.excluir').click(function(){
    if (confirm("Deseja realmente excluir")) {
      var id = $(this).attr('data-id');

      $.get('/admin/jogo/excluir_imagem.php?id=' + id, {}, function(data){
        if (data == 'excluido') {
          $(".img_"+id).hide();
          alert('Excluido com sucesso!');

        } else {
          alert('Não foi possível excluir!');
        }
      });
    }
  });
});
