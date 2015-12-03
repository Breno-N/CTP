(function(){
    'use strict';
    
    $(function(){
       
        $('#data-table').DataTable({
            'lengthMenu': [ 5, 10, 25, 50, 75, 100, 250, 500 ],
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
                }
            }
        });
        
    });
    
})();