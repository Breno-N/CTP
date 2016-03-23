loadScript(plugin_path + 'bootstrap.typeahead/bootstrap3-typeahead.min.js', function() {
    (function(){ 
        
        var business = $('#business');
        get_all_bussines(business);
        
        if($('.form-link-warning')[0]){
            $('.form-link-warning').hide();
        }
        
        if($('.form-notfind-business')[0]){
            $('.form-notfind-business').hide();
        }
        
        business.on('blur', function(){
            var name = $(this).val();
            get_business_by_name(name);
            if($('.form-link-warning')[0]){
                have_business_neighborhood_request(name);
            }
        });
        
        function get_all_bussines(place){
            $.getJSON('/ctp/util/get_business').then(function(result){
                place.typeahead({ source : result });
            });
        }
        
        function get_business_by_name(business){
            $.getJSON('/ctp/util/get_business_by_name', {business : business}).then(function(result){
                if(result != '' && result != '0' && result != null && result != undefined){
                    $('#pedir').attr('disabled', false);
                    $('#business').removeClass('error');
                    $('.form-notfind-business').hide();
                }else{
                    $('#pedir').attr('disabled', true);
                    $('#business').addClass('error');
                    $('.form-notfind-business').show();
                }
            });
        }
        
        function have_business_neighborhood_request(business){
            $.getJSON('/ctp/util/have_business_neighborhood_request', {business : business}).then(function(result){
                if(result != '' && result != null && result != undefined){
                    $('.form-link-warning').show();
                    $('.form-input').hide();
                    $('#link-support').attr('href', '/ctp/admin/pedidos/detalhes/' + result);
                    $('#pedir').attr('disabled', true);
                }else{
                    $('.form-link-warning').hide();
                    $('.form-input').show();
                    $('#link-support').attr('href', '');
                    $('#pedir').attr('disabled', false);
                }
            });
        }
        
    })();
});