(function($, window, document){
    
    var url_default = '/ctp/contato/send/';
    
    $('#form-contact').on('submit', function(){
        $.ajax({
            type: 'POST',
            url: url_default,
            data: $(this).serialize(),
            dataType: "json",
            success: function(data) {
                alert(data);
            },
            fail : function(){
                alert('Erro ao tentar enviar e-mail');
            }
        });
        $(this).each(function(){
            this.reset();
        });
        return false;
    });
    
})(jQuery, window, document);