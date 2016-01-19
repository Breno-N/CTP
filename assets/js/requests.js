(function($, window, document){
    
    'use strict';
    
    $(function(){
        
        var selecteds = [];
        var url_default = '/ctp/admin/pedidos/';
        
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
        
        /*
        $('#btn-delete').on('click', function(e){
            e.preventDefault();
            if(selecteds.length > 0){
                if(confirm('Deseja excluir este(s) registro(s)?')){
                    $.post(url_default + 'remover', {'selecteds' : selecteds}).then(function(result){
                        if(result != '' && result != '0' && result != null && result != undefined){
                            window.alert(result + ' registro(s) excluido(s) com sucesso.');
                            window.location.reload(true); 
                        }else{
                            window.alert('Erro ao excluir registro(s).');
                        }
                    }, 'json');
                }
            }else{
                window.alert('Nenhum registro selecionado.');
            }
        });
        */
        
        $('#request-support').on('click', function(e){
            var request = $(this).attr('data-id');
            if(confirm('Deseja apoiar esta solicitação ?')){
                $.post(url_default + 'apoiar', {'request' : request}).then(function(result){
                    if(result != '' && result != '0' && result != null && result != undefined){
                        window.alert('Operação realizada com sucesso.');
                        window.location.reload(true); 
                    }else{
                        window.alert('Erro ao realizar operação.');
                    }
                }, 'json');
            }
        });
        
        $('#quantity').on('change', function(){
            var qtde = $(this).val();
            if(qtde != '' && qtde != null && qtde != undefined && qtde > 0){
                $('#files').attr('required', true);
            }else{
                $('#files').attr('required', false);
            }
        });
        
        var id_type_business = $('#id_type_business').val();
        var id_business_selected = $('#id_business_selected').val();
        
        if(id_type_business != '' && id_type_business != null && id_type_business != undefined ){
            get_type_business(id_type_business, id_business_selected, '#id_business');
        }
        
        $('#id_type_business').on('change', function(){
            $('#id_business').html('<option value="">Selecione...</option>');
            var type_business = $(this).val();
            if(type_business != '' && type_business != null && type_business != undefined){
                get_type_business(type_business, '', '#id_business');
            }
        });
        
        $('.form-link-warning').hide();
        
        $('#id_business').on('change', function(){
            var business = $(this).val();
            if(business != '' && business != null && business != undefined){
                have_business_neighborhood_request(business);
            }
        });
        
        function have_business_neighborhood_request(business){
            $.getJSON(url_default + 'have_business_neighborhood_request', {business : business}).then(function(result){
                change_form(result.id);
            });
        }
        
        function change_form(id){
            if(id != '' && id != null && id != undefined){
                $('.form-link-warning').show();
                $('.form-input').hide();
                $('#link-support').attr('href', url_default + 'detalhes/' + id);
            }else{
                $('.form-link-warning').hide();
                $('.form-input').show();
                $('#link-support').attr('href', '');
            }
        }
        
        function get_type_business(param, selected, place){
            $.getJSON(url_default + 'get_business', {type_business : param}).then(function(result){
                build_select(result, selected, place);
            });
        }
        
        function build_select(itens, selected, place){
            var options = '<option value="">Selecione...</option>';
            if(itens.length > 0){
                $(itens).each(function(k, v){
                    if(v.id == selected){
                        options += '<option value="' + v.id + '" selected="selected">' + v.descricao + '</option>'
                    }else{
                        options += '<option value="' + v.id + '">' + v.descricao + '</option>'
                    }
                });
            }
            $(place).html(options);
        }
        
    });
    
})(jQuery, window, document);