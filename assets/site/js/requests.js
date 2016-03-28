(function($, window, document){
    
    $(function(){
        
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