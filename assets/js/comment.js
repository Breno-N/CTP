(function($, window, document){
    
    'use strict';
    
    $(function(){
        
        var url_default = '/ctp/admin/pedidos/';
        
        $('#comment-save').on('click', function(){
            var comment = $('#comment').val();
            if(comment != '' && comment != null && comment != undefined){
                var request = $(this).attr('data-id');
                $.post(url_default + 'comentar', {id_request : request, description : comment}, function(result){
                    if(result != '' && result != '0' && result != null && result != undefined){
                        window.alert('Comentário inserido com sucesso.');
                        window.location.reload(true); 
                    }else{
                        window.alert('Erro ao inserir comentário. Tente novamente mais tarde.');
                    }
                }, 'json');
            }else{
                alert('Preencha o campo comentário');
            }
        });
        
        $('#comment-delete').on('click', function(){
            var id = $(this).attr('data-id');
            if(id != '' && id != null && id != undefined){
                $.post(url_default + 'comentar', {id : id}, function(result){
                    if(result != '' && result != '0' && result != null && result != undefined){
                        window.alert('Comentário excluido com sucesso.');
                        window.location.reload(true); 
                    }else{
                        window.alert('Erro ao excluir comentário. Tente novamente mais tarde.');
                    }
                }, 'json');
            }else{
                alert('não é possivel excluir o comentário selecionado.');
            }
        });
        
    });
    
})(jQuery, window, document);