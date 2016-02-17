(function($, window, document){
    
    'use strict';
    
    $(function(){
        
        var selecteds = [];
        var url_default = '/admin/usuarios/';
        
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
        
        $('.btn-update').on('click', function(e){
            e.stopPropagation();
        });
        
        if($('.form-address').hasClass('filled')){
            $('.form-address').show();
        }else{
            $('.form-address').hide();
        }
        
        if($('#id-address')[0] != undefined){
            $('#id-address').mask('99999999');
        }
        
        $('#id-address').on('blur', function(){
            var zip_code = $(this).val();
            if(zip_code != '' && zip_code != null && zip_code != undefined){
                get_address(zip_code, '.form-address');
            }
        });
        
        $('#phone').on({
            'blur' : function(){
                format_element('phone', $(this), $(this).val().length);
            },
            'focus' :function(){
                unformat_element($(this));
            }
        });
        
        $('#cpf-cnpj').on({
            'blur' : function(){
                format_element('cpf-cnpj', $(this), $(this).val().length);
            },
            'focus' :function(){
                unformat_element($(this));
            }
        });
        
        function get_address(zip_code, place){
            var div = $(place);
            var html = '';
            $.getJSON(url_default + 'get_address',{zip_code : zip_code })
            .done(function(result){
                html = result.state + ' - ' + result.city + ' - ' + result.neighborhood + ' - ' + result.street;
                div.find('.alert').removeClass('alert-warning').addClass('alert-info').html(html);
                div.show();
                $('#submit').attr('disabled', false);
            })
            .fail(function(jqxhr, textStatus, error){
                html = 'Dados do cep não econtrado.'
                div.find('.alert').removeClass('alert-info').addClass('alert-warning').html(html);
                div.show();
                $('#submit').attr('disabled', true);
            });
        }
        
        function format_element(element, $this, qtde){
            $this.parent().removeClass('has-error');
            $this.parent().removeClass('has-success');
            switch(element){
                case 'phone':
                    if(qtde == 10 || qtde == 13){
                        $this.parent().addClass('has-success');
                        $this.mask('(99)9999-9999');
                    }else if(qtde == 11 || qtde == 14){
                        $this.parent().addClass('has-success');
                        $this.mask('(99)99999-9999');
                    }else{
                        $this.parent().addClass('has-error');
                    }
                    break;
                case 'cpf-cnpj':
                    if(qtde == 11 || qtde == 15){
                        $this.parent().addClass('has-success');
                        $this.mask('999.999.999-99');
                    }else if(qtde == 14 || qtde == 18){
                        $this.parent().addClass('has-success');
                        $this.mask('99.999.999/9999-99');
                    }else{
                        $this.parent().addClass('has-error');
                    }
                    break;
            }
        };
        
        function unformat_element($this){
            $this.unmask();
        }
       
    });
    
})(jQuery, window, document);