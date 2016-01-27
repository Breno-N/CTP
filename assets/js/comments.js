(function($, window, document){
    
    'use strict';
    
    $(function(){
        
        var selecteds = [];
        var url_default = '/ctp/admin/comentarios/';
        
        $('.data-item').on('click', function(){
            var id = $(this).attr('data-id');
            var posicao = selecteds.indexOf(id); 
            if(posicao == -1){
                selecteds.push(id);
                $(this).addClass('alert-success');
            }else{
                selecteds.splice(posicao, 1);
                $(this).removeClass('alert-success');
            }
        });
        
        $('#comment-approve').on('click', function(e){
            e.preventDefault();
            if(selecteds.length > 0){
                if(confirm('Deseja Aprovar este(s) registro(s)?')){
                    $.post(url_default + 'aprovar', {'selecteds' : selecteds}).then(function(result){
                        if(result != '' && result != null && result != undefined){
                            window.alert(result + ' registro(s) aprovado(s) com sucesso.');
                            window.location.reload(true); 
                        }
                    }, 'json');
                }
            }else{
                window.alert('Nenhum registro selecionado.');
            }
        });
        
    });
    
})(jQuery, window, document);