loadScript(plugin_path + 'chart.chartjs/Chart.min.js', function() {
    
    (function(){
        
        if($("#graphs").length > 0){
            $('#graphs').hide();
            init_charts();
        }
        
        function init_charts(){
            var ctxPieState = $("#ctx-pie-state").get(0).getContext("2d"); 
            var ctxDoughnutCitys = $("#ctx-doughnut-citys").get(0).getContext("2d"); 
            var ctxBarTypeBusiness = $("#ctx-bar-type-business").get(0).getContext("2d"); 
            
            var dataPieState = [];
            var dataDoughnutCitys = [];
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
           
            $.getJSON(url_default + 'admin/painel/get_charts').then(function(result){
                if(result != '' && result != '0' && result != null && result != undefined){
                    $('#graphs').show();
                    
                    $.each(result.states , function(k, v){
                        dataPieState.push({ value : v.quantity, label : v.state, color: '#' + Math.floor(Math.random()*9) + Math.floor(Math.random()*9) + 'DA' + Math.floor(Math.random()*9) + 'D', highlight: '#' +  Math.floor(Math.random()*9) +  Math.floor(Math.random()*9) + 'AD' +  Math.floor(Math.random()*9) + 'D1'});
                    });
                    
                    $.each(result.citys , function(k, v){
                        dataDoughnutCitys.push({ value : v.quantity, label : v.city, color: '#' + Math.floor(Math.random()*9) + Math.floor(Math.random()*9) + 'BF' + Math.floor(Math.random()*9) + 'D', highlight: '#' +  Math.floor(Math.random()*9) +  Math.floor(Math.random()*9) + 'AD' +  Math.floor(Math.random()*9) + 'D1'});
                    });
                    
                    $.each(result.type_business, function(k, v){
                        dataBarTypeBusiness.labels.push(v.type_business);
                        dataBarTypeBusiness.datasets[0].data.push(v.quantity);
                    });

                    new Chart(ctxBarTypeBusiness).Bar(dataBarTypeBusiness, {animation:true, responsive:true});
                    new Chart(ctxPieState).Pie(dataPieState, {animation:true, responsive:true});
                    new Chart(ctxDoughnutCitys).Doughnut(dataDoughnutCitys, {animation:true, responsive:true});
                    
                }
            });
        }

    })();
    
});