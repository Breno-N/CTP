(function($, window, document){
    
    $('#id-address').on('blur', function(){
        var zip_code = $(this).val();
        if(zip_code != '' && zip_code != 'XXXXXXXX' && zip_code != null && zip_code != undefined){
            get_address(zip_code, '#address');
        }else{
            $('#address').html('');
            $('#address').hide();
        }
    });

    function get_address(zip_code, place){
        var div = $(place);
        var html = '';
        $.getJSON(url_default + 'util/get_address', {zip_code : zip_code })
        .done(function(result){
            html = result.state + ' - ' + result.city + ' - ' + result.neighborhood + ' - ' + result.street;
            div.removeClass('alert-warning').addClass('alert-info').html(html);
            div.show();
            $('#id-address').removeClass('error');
            if(!$('#cpf').hasClass('error')){
                $('#submit').attr('disabled', false);
            }
        })
        .fail(function(jqxhr, textStatus, error){
            html = 'Cep não econtrado.';
            div.removeClass('alert-info').addClass('alert-warning').html(html);
            div.show();
            $('#id-address').addClass('error');
            $('#submit').attr('disabled', true);
        });
    }
        
})(jQuery, window, document);