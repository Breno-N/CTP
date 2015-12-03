(function($, window, document){
    
    'use strict';
    
    $(function(){
        
        var selecteds = [];
        var state = $('#state').val();
        var city_selected = $('#id_city_selected').val();
        var url_default = '/ctp/admin/bairros/';
        
        if(state != '' && state != null && state != undefined){
            getCitys(state, city_selected);
        }
        
        $('#state').on('change', function(){
            var id = $(this).val();
            getCitys(id);
        });
        
        function getCitys(id, selected){
            var html = '<option value="">Selecione...</option>';
            $('#city').html(html);
            $.getJSON(url_default + 'get_citys?id=' + id).then(function(result){
                if(result.length > 0 ){
                    $(result).each(function(k, v){
                        if(selected != '' && selected != null && selected != undefined){
                            html += '<option value="' + v.id + '" ' + ((v.id == selected) ? 'selected="selected"' : '') + '>' + v.descricao + '</option>';
                        }else{
                            html += '<option value="' + v.id + '">' + v.descricao + '</option>';
                        }
                    });
                    $('#city').html(html);
                }
            });
        };
        
        $('.btn-update').on('click', function(e){
            e.stopPropagation();
        });
              
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
        
        $('#btn-delete').on('click', function(e){
            e.preventDefault();
            if(selecteds.length > 0){
                if(confirm('Deseja excluir este(s) registro(s)?')){
                    $.post(url_default + 'remover', {'selecteds' : selecteds}).then(function(result){
                        if(result != '' && result != null && result != undefined){
                            window.alert(result + ' registro(s) excluido(s) com sucesso.');
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