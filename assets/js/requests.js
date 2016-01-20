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
       
        $('#comment-save').on('click', function(){
            var comment = $('#comment').val();
            if(comment != '' && comment != null && comment != undefined){
                var request = $(this).attr('data-id');
                $.post(url_default + 'comentar', {id_request : request, description : comment}, function(result){
                    if(result != '' && result != '0' && result != null && result != undefined){
                        window.alert('Comentário enviado para aprovação.');
                        window.location.reload(true); 
                    }else{
                        window.alert('Erro ao inserir comentário. Tente novamente mais tarde.');
                    }
                }, 'json');
            }else{
                alert('Preencha o campo comentário');
            }
        });
        
        $('.comment-delete').on('click', function(){
            var id =  $(this).attr('data-id');
            if(id != '' && id != null && id != undefined){
                $.post(url_default + 'descomentar', {id : id}, function(result){
                    if(result != '' && result != '0' && result != null && result != undefined){
                        window.alert('Comentário removido.');
                        window.location.reload(true); 
                    }else{
                        window.alert('Erro ao tentar remover comentário. Tente novamente mais tarde.');
                    }
                }, 'json');
            }else{
                alert('Não é possivel descomentar.');
            }
        });
        
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
        
        $('.uploadfiles').hide();
        $('.form-link-warning').hide();
        
        $('#quantity').on({
            
            change : function(){
                calculate_requests($(this).val());
            },
            keyup : function(){
                calculate_requests($(this).val());
            },
            
        });
        
        function calculate_requests(qtde){
            if(qtde != '' && qtde != null && qtde != undefined && qtde > 1){
                $('.uploadfiles').show();
                $('#files').attr('required', true);
            }else{
                $('.uploadfiles').hide();
                $('#files').attr('required', false);
            }
        }
        
        var id_type_business = $('#id_type_business').val();
        var id_business_selected = $('#id_business_selected').val();
        
        if(id_type_business != '' && id_type_business != null && id_type_business != undefined ){
            get_type_business(id_type_business, id_business_selected, '#id_business');
        }
        
        $('#id_type_business').on('change', function(){
            $('.form-link-warning').hide();
            $('.form-input').show();
            $('#link-support').attr('href', '');
            $('#id_business').html('<option value="">Selecione...</option>');
            var type_business = $(this).val();
            if(type_business != '' && type_business != null && type_business != undefined){
                get_type_business(type_business, '', '#id_business');
            }
        });
        
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