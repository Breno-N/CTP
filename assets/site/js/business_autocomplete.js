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
            if($('.form-link-warning')[0]){
                have_business_neighborhood_request(name);
            }
        });
        
        function get_all_bussines(place){
            $.getJSON('/ctp/util/get_business').then(function(result){
                place.typeahead({ source : result });
            });
        }
        
        function have_business_neighborhood_request(business){
            $.getJSON('/ctp/util/have_business_neighborhood_request', {business : business}).then(function(result){
                if(result != '' && result != null && result != undefined){
                    $('.form-link-warning').show();
                    $('.form-input').hide();
                    $('#link-support').attr('href', '/ctp/admin/pedidos/detalhes/' + result);
                }else{
                    $('.form-link-warning').hide();
                    $('.form-input').show();
                    $('#link-support').attr('href', '');
                }
            });
        }
        
    })();
});