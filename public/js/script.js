console.log('Script affiché');


$('.insert').on('click', function(){
  $.ajax({
          success: function(){
            var html = '<div class="alert alert-success">Produit ajouté au panier avec succès</div>';
            $('.notifications').html(html);
            setTimeout(function(){
              $('.alert-success').fadeOut(600)
            }, 4000)
          }
        })
})

//message de suppression d'article dans posts/show
$('.delete').on('click', function(){
  $.ajax({
          success: function(){
            var html = '<div class="alert alert-success">Le message a bien été supprimé</div>';
            $('.notifications').html(html);
            setTimeout(function(){
              $('.alert-success').fadeOut(600)
            }, 4000)
          }
        })
})
