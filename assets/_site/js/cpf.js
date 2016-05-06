(function(){
    
    $('#cpf').on('blur', function(){
        if(!testCPF($(this).val())){
            $(this).addClass('error');
            $('#submit').attr('disabled', true);
            $('#test-cpf').show();
        }else{
            $(this).removeClass('error');
            $('#submit').attr('disabled', false);
            $('#test-cpf').hide();
        }
    });

    function testCPF(strCPF) {
        var Soma;
        var Resto;
        Soma = 0; 
        
        strCPF = replaceDigits(strCPF);
        if(isSameDigits(strCPF))
            return false;
        for (i=1; i<=9; i++)
            Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i); 
        Resto = (Soma * 10) % 11;
        if ((Resto == 10) || (Resto == 11)) 
            Resto = 0;
        if (Resto != parseInt(strCPF.substring(9, 10)) )
            return false;
            Soma = 0;
        for (i = 1; i <= 10; i++)
           Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);
        Resto = (Soma * 10) % 11;
        if ((Resto == 10) || (Resto == 11)) 
            Resto = 0;
        if (Resto != parseInt(strCPF.substring(10, 11) ) )
            return false;
        return true;
    }
    
    function replaceDigits(value){
        value = value.replace(".", "");
        value = value.replace(".", "");
        value = value.replace("-", "");
        return value;
    }
    
    function isSameDigits(value){
        if(value == "00000000000" || value == "11111111111" || value == "22222222222" || value == "33333333333"
            || value == "44444444444" || value == "55555555555" || value == "66666666666"|| value == "77777777777"
            || value == "88888888888" || value == "99999999999"){
            return true;
        }
    }
    
})();