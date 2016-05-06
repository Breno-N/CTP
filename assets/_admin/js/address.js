(function($, window, document){
    
    $(function(){
        
        if($('.form-address').hasClass('filled')){
            $('.form-address').show();
        }else{
            $('.form-address').hide();
        }
        
        $('#id-address').on('blur', function(){
            var zip_code = $(this).val();
            if(zip_code != '' && zip_code != 'XXXXXXXX' && zip_code != null && zip_code != undefined){
                get_address(zip_code, '.form-address');
            }else{
                $(this).addClass('error');
                $('.form-address').find('.alert').addClass('alert-warning').html('CEP não encontrado');
                $('.form-address').show();
                $('#submit').attr('disabled', true);
            }
        });
        
        function get_address(zip_code, place){
            var div = $(place);
            var html = '';
            $.getJSON(url_default + 'util/get_address', {zip_code : zip_code })
            .done(function(result){
                html = result.state + ' - ' + result.city + ' - ' + result.neighborhood + ' - ' + result.street;
                div.find('.alert').removeClass('alert-warning').addClass('alert-info').html(html);
                div.show();
                $('#id-address').removeClass('error');
                if(!$('#cpf').hasClass('error')){
                    $('#submit').attr('disabled', false);
                }
            })
            .fail(function(jqxhr, textStatus, error){
                html = 'Cep não econtrado.'
                div.find('.alert').removeClass('alert-info').addClass('alert-warning').html(html);
                div.show();
                $('#id-address').addClass('error');
                $('#submit').attr('disabled', true);
            });
        }
        
    });
    
})(jQuery, window, document);