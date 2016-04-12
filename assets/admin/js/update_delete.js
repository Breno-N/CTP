(function($, window, document){
    
    $(function(){
        
        var selecteds = [];
        
        if($('.btn-update')[0]){
            $('.btn-update').on('click', function(e){
                e.stopPropagation();
            });
        }
              
        if($('.data-item')[0]){
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
        }
        
        if($('#btn-delete')[0]){
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
        }
        
        function remove(url){
            $.post(url + 'remover', {'selecteds' : selecteds}).then(function(result){
                if(result != '' && result != null && result != undefined){
                    window.alert(result + ' registro(s) excluido(s) com sucesso.');
                    window.location.reload(true); 
                }
            }, 'json');
        }
        
        if($('#btn-done')[0]){
            $('#btn-done').on('click', function(e){
                e.preventDefault();
                if(selecteds.length > 0){
                    if(confirm('Deseja marcar como Feito este(s) registro(s)?')){
                        done(window.page_action);
                    }
                }else{
                    window.alert('Nenhum registro selecionado.');
                }
            });
        }
        
        function done(url){
            $.post(url + 'feito', {'selecteds' : selecteds}).then(function(result){
                if(result != '' && result != null && result != undefined){
                    window.alert(result + ' registro(s) atualizado(s) com sucesso.');
                    window.location.reload(true); 
                }
            }, 'json');
        }
       
    });
    
})(jQuery, window, document);