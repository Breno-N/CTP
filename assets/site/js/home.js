loadScript(plugin_path + 'chart.chartjs/Chart.min.js', function() { 
    (function(){ 
        var url_default = '/ctp/home/';
        init_charts();

        function init_charts(){
            var ctxBarTypeBusiness = $("#ctx-bar-type-business").get(0).getContext("2d"); 
            var ctxPieNeighboorhod = $("#ctx-pie-neighborhood").get(0).getContext("2d"); 
            //var ctxDoughnutCitys = $("#ctx-doughnut-citys").get(0).getContext("2d"); 

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
            //var dataDoughnutCitys = [];

            $.getJSON(url_default + 'get_charts').then(function(result){
                if(result != '' && result != '0' && result != null && result != undefined){
                    $.each(result.type_business, function(k, v){
                        dataBarTypeBusiness.labels.push(v.type_business);
                        dataBarTypeBusiness.datasets[0].data.push(v.quantity);
                    });

                    $.each(result.neighborhood , function(k, v){
                        dataPieNeighborhood.push({ value : v.quantity, label : v.neighborhood, color: '#46BFBD', highlight: '#5AD3D1'});
                    });

                    //$.each(result.citys , function(k, v){
                    //    dataDoughnutCitys.push({ value : v.quantity, label : v.city, color: '#46BFBD', highlight: '#5AD3D1'});
                    //});

                    new Chart(ctxBarTypeBusiness).Bar(dataBarTypeBusiness, {animation:true, responsive:true});
                    new Chart(ctxPieNeighboorhod).Pie(dataPieNeighborhood, {animation:true, responsive:true});
                    //new Chart(ctxDoughnutCitys).Doughnut(dataDoughnutCitys, {animation:true, responsive:true});
                }
            });
        }
    })();
});