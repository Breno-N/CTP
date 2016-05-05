(function($, window, document){
    
    $(function(){
        
        if($('#request-support')[0]){
            $('#request-support').on('click', function(e){
                var request = $(this).attr('data-id');
                if(confirm('Deseja apoiar esta solicitação ?')){
                    $.post(url_default + 'admin/pedidos/apoiar', {'request' : request}).then(function(result){
                        if(result != '' && result != '0' && result != null && result != undefined){
                            window.alert('Operação realizada com sucesso.');
                            window.location = window.location.href + '/3'; 
                            //window.location.reload(true); 
                        }else{
                            window.alert('Erro ao realizar operação.');
                        }
                    }, 'json');
                }
            });
        }
        
        $('.uploadfiles').hide();
        
        $('#quantity').on({
            blur : function(){
                calculate_requests($(this).val());
            },
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
        
    });
    
})(jQuery, window, document);