(function($, window, document){
    
    $(function(){
        
        var selecteds = [];
        
        $('.btn-update').on('click', function(e){
            e.stopPropagation();
        });
              
        $('.data-item').on('click', function(){
            var id = $(this).attr('data-id');
            var posicao = selecteds.indexOf(id); 
            if(posicao == -1){
                selecteds.push(id);
                $(this).addClass('success');
            }else{
                selecteds.splice(posicao, 1);
                $(this).removeClass('success');
            }
        });
        
        $('#btn-delete').on('click', function(e){
            e.preventDefault();
            if(selecteds.length > 0){
                if(confirm('Deseja excluir este(s) registro(s)?')){
                    remove(window.page_action);
                }
            }else{
                window.alert('Nenhum registro selecionado.');
            }
        });
        
        function remove(url){
            $.post(url + 'remover', {'selecteds' : selecteds}).then(function(result){
                if(result != '' && result != null && result != undefined){
                    window.alert(result + ' registro(s) excluido(s) com sucesso.');
                    window.location.reload(true); 
                }
            }, 'json');
        }
       
    });
    
})(jQuery, window, document);