(function($, window, document){
    
    'use strict';
    
    $(function(){
        
        var selecteds = [];
        var state = $('#state').val();
        var city_selected = $('#id_city_selected').val();
        var url_default = '/admin/usuarios/';
        
        if($('#zip-code')[0] != undefined){
            $('#zip-code').mask('99999-999');
        }
        
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
        
        $('#zip-code').on('blur', function(){
            var cep = $(this).val();
            var url = 'http://cep.republicavirtual.com.br/web_cep.php?cep=' + cep + '&formato=json';
            $('.error-zip').html('');
            $.getJSON(url).then(function(result){
                if(result.resultado != '0' && result.resultado != null && result.resultado != undefined){
                    $('#neighborhood').val(result.bairro);
                    $('#street').val(result.tipo_logradouro + ' ' + result.logradouro);
                }else{
                    var html = '<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 error-zip">';
                    html += '<div class="alert alert-danger">';
                    html += '<h4>CEP não encontrado</h4>';
                    html += '</div>';
                    html += '</div>';
                    $('.zip-code').append(html);
                }
            });
        });
        
        $('#phone').on({
            'blur' : function(){
                var $this = $(this);
                var qtde = $(this).val().length;
                $this.parent().removeClass('has-error');
                $this.parent().removeClass('has-success');
                if(qtde == 10 || qtde == 13){
                    $this.parent().addClass('has-success');
                    $this.mask('(99)9999-9999');
                }else if(qtde == 11 || qtde == 14){
                    $this.parent().addClass('has-success');
                    $this.mask('(99)99999-9999');
                }else{
                    $this.parent().addClass('has-error');
                }
            },
            'focus' :function(){
                var $this = $(this);
                $this.unmask();
            }
        });
       
        $('#cpf-cnpj').on({
            'blur' : function(){
                var $this = $(this);
                var qtde = $(this).val().length;
                $this.parent().removeClass('has-error');
                $this.parent().removeClass('has-success');
                if(qtde == 11 || qtde == 15){
                    $this.parent().addClass('has-success');
                    $this.mask('999.999.999-99');
                }else if(qtde == 14 || qtde == 18){
                    $this.parent().addClass('has-success');
                    $this.mask('99.999.999/9999-99');
                }else{
                    $this.parent().addClass('has-error');
                }
            },
            'focus' :function(){
                var $this = $(this);
                $this.unmask();
            }
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