loadScript(plugin_path + 'bootstrap.typeahead/bootstrap3-typeahead.min.js', function() {
    (function(){ 
        
        if($('#business')[0]){
            var business = $('#business');
            get_all_bussines(business);
            
            business.on('blur', function(){
                var name = $(this).val();
                if($('.form-link-warning')[0]){
                    have_business_neighborhood_request(name);
                }
            });
        }
        
        if($('.form-link-warning')[0]){
            $('.form-link-warning').hide();
        }
        
        if($('.form-notfind-business')[0]){
            $('.form-notfind-business').hide();
        }
        
        function get_all_bussines(place){
            $.getJSON(url_default + 'util/get_all_business').then(function(result){
                place.typeahead({ source : result });
            });
        }
        
        function have_business_neighborhood_request(business){
            $.getJSON(url_default + 'util/have_business_neighborhood_request', {business : business}).then(function(result){
                if(result != '' && result != null && result != undefined){
                    $('.form-link-warning').show();
                    $('.form-input').hide();
                    $('#link-support').attr('href', url_default + 'admin/pedidos/detalhes/' + result);
                    if($('#pedir')[0]) $('#pedir').attr('disabled', true);
                }else{
                    $('.form-link-warning').hide();
                    $('.form-input').show();
                    $('#link-support').attr('href', '');
                    if($('#pedir')[0]) $('#pedir').attr('disabled', false);
                }
            });
        }
        
    })();
});