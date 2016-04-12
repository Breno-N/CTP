(function($, window, document){
    
    $('.progress-send-mail').hide();
    
    $('#form-contact').on('submit', function(){
        var $this = $(this);
        $('.progress-send-mail').show();
        $.ajax({
            type: 'POST',
            url: url_default + 'contato/send/',
            data: $(this).serialize(),
            dataType: "json",
            success: function(data) {
                alert(data);
                $('.progress-send-mail').hide();
                $this.each(function(){
                    this.reset();
                });
            },
            fail : function(){
                alert('Erro ao tentar enviar e-mail');
                $('.progress-send-mail').hide();
            },
        });
        return false;
    });
    
})(jQuery, window, document);