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


  $('.add_video').click(add_video);

  function add_video()
  {
    var qtd = $('.video_input').length;
    $(".form_video").append('<input class="form-control video_input video_'+qtd+'" name="videos[]" type="text"> <button type="button" data-pos="'+qtd+'" class="btn btn-danger remove_video">-</button>');
  }

  $(document).on('click', '.remove_video', remove_video);

  function remove_video(){
    var _this = $(this);

    var pos = _this.attr('data-pos');

    $('.video_'+pos).remove();
    _this.remove();
  }

  $('.ehslide').click(ehslide);

  function ehslide()
  {
    var _this = $(this);
    var checked = false;
    var id = _this.attr('data-id');
    if(_this.is(':checked')) {
      checked = true;
    }


    $.get('/admin/jogo/ehslide.php?id='+id+'&checked=' + checked, {}, function(data){
      if (data == 'ok') {
        if(checked)
          alert('Marcado como slide com sucesso!');
        else
          alert('Removido como slide com sucesso!');


      } else {
        alert('Não foi possível marcar como slide!');
      }
    });

  }

});
