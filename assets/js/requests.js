(function($, window, document){
    
    'use strict';
    
    $(function(){
        
        var selecteds = [];
        var url_default = '/ctp/admin/requisicoes/';
        
        $('.btn-update').on('click', function(e){
            e.stopPropagation();
        });
       
        $('.data-item').on('click', function(){
            var id = $(this).attr('data-id');
            var posicao = selecteds.indexOf(id); 
            if(posicao == -1){
                selecteds.push(id);
                $(this).addClass('alert-success');
            }else{
                selecteds.splice(posicao, 1);
                $(this).removeClass('alert-success');
            }
        });
        
        $('#btn-delete').on('click', function(e){
            e.preventDefault();
            if(selecteds.length > 0){
                if(confirm('Deseja excluir este(s) registro(s)?')){
                    $.post(url_default + 'remover', {'selecteds' : selecteds}).then(function(result){
                        if(result != '' && result != '0' && result != null && result != undefined){
                            window.alert(result + ' registro(s) excluido(s) com sucesso.');
                            window.location.reload(true); 
                        }else{
                            window.alert('Erro ao excluir registro(s).');
                        }
                    }, 'json');
                }
            }else{
                window.alert('Nenhum registro selecionado.');
            }
        });
        
        $('#request-support').on('click', function(e){
            var request = $(this).attr('data-id');
            if(confirm('Deseja apoiar esta solicitação ?')){
                $.post(url_default + 'apoiar', {'request' : request}).then(function(result){
                    if(result != '' && result != '0' && result != null && result != undefined){
                        window.alert('Operação realizada com sucesso.');
                        window.location.reload(true); 
                    }else{
                        window.alert('Erro ao realizar operação.');
                    }
                }, 'json');
            }
        });
        
        if($("#graphs").length > 0){
            $('#graphs').hide();
            init_charts();
        }
        
        function init_charts(){
            var ctxBarTypeBusiness = $("#ctx-bar-type-business").get(0).getContext("2d"); 
            var ctxPieNeighboorhod = $("#ctx-pie-neighborhood").get(0).getContext("2d"); 
            var ctxDoughnutCitys = $("#ctx-doughnut-citys").get(0).getContext("2d"); 
            
            var dataBarTypeBusiness = {
                labels: [],
                datasets: [
                    {
                        label: "Negócios mais Pedidos",
                        fillColor: "rgba(151,187,205,0.5)",
                        strokeColor: "rgba(151,187,205,0.8)",
                        highlightFill: "rgba(151,187,205,0.75)",
                        highlightStroke: "rgba(151,187,205,1)",
                        data: []
                    }
                ]
            };
            var dataPieNeighborhood = [];
            var dataDoughnutCitys = [];
           
            $.getJSON(url_default + 'get_charts').then(function(result){
                if(result != '' && result != '0' && result != null && result != undefined){
                    $('#graphs').show();
                    $.each(result.type_business, function(k, v){
                        dataBarTypeBusiness.labels.push(v.type_business);
                        dataBarTypeBusiness.datasets[0].data.push(v.quantity);
                    });

                    $.each(result.neighborhood , function(k, v){
                        dataPieNeighborhood.push({ value : v.quantity, label : v.neighborhood, color: '#46BFBD', highlight: '#5AD3D1'});
                    });

                    $.each(result.citys , function(k, v){
                        dataDoughnutCitys.push({ value : v.quantity, label : v.city, color: '#46BFBD', highlight: '#5AD3D1'});
                    });

                    new Chart(ctxBarTypeBusiness).Bar(dataBarTypeBusiness, {animation:true, responsive:true});
                    new Chart(ctxPieNeighboorhod).Pie(dataPieNeighborhood, {animation:true, responsive:true});
                    new Chart(ctxDoughnutCitys).Doughnut(dataDoughnutCitys, {animation:true, responsive:true});
                }
            });
        }
        
    });
    
})(jQuery, window, document);