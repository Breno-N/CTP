(function($, window, document){
    
    var url_default = '/ctp/contato/send/';
    
    $('#form-contact').on('submit', function(){
        var $this = $(this);
        $.ajax({
            type: 'POST',
            url: url_default,
            data: $(this).serialize(),
            dataType: "json",
            success: function(data) {
                alert(data);
                $this.each(function(){
                    this.reset();
                });
            },
            fail : function(){
                alert('Erro ao tentar enviar e-mail');
            }
        });
        
        return false;
    });
    
})(jQuery, window, document);