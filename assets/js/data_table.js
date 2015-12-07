(function(){
    'use strict';
    
    $(function(){
       
        $('#data-table').DataTable({
            'lengthMenu': [ 5, 10, 25, 50, 75, 100, 250, 500 ],
            //'dom' : 'lfrtip', 
            //buttons: [ 'copy', 'csv', 'excel', 'pdf', 'print' ],
            buttons: [
                {
                    extend: 'copy',
                    text: 'Copiar'
                },
                {
                    extend: 'csv',
                    text: 'Exportar CSV'
                },
                {
                    extend: 'excel',
                    text: 'Exportar EXCEL'
                },
                {
                    extend: 'pdf',
                    text: 'Exportar PDF'
                },
            ],
            'pageLength': 10,
            'responsive': true,
            'columnDefs': [
                { 'orderable': false, 'targets': -1 }
            ],
            language: {
                'info': 'Mostrando página _PAGE_ de _PAGES_',
                'infoEmpty': 'Sem resultados',
                'infoFiltered': ' - Filtrado de _MAX_ ',
                'zeroRecords': 'Sem resultados',
                'lengthMenu': 'Exibir _MENU_ ',
                'search': 'Pesquisar :',
                paginate: {
                    first:    '«',
                    previous: '‹',
                    next:     '›',
                    last:     '»'
                },
                aria: {
                    paginate: {
                        first:    'Primeiro',
                        previous: 'Anterior',
                        next:     'Próximo',
                        last:     'Último'
                    }
                },
                buttons : {
                    	copyTitle : 'Copia realizada',
                        copySuccess: {
                            1: 'Copiado 1 linha para o',
                            _: 'Copiado %d linhas para o clipboard'
                        },
                }
            }
        });
        
    });
    
})();