<section id="middle">
    <header id="page-header">
        <h1> Painel </h1> 
    </header>
    <div id="content" class="dashboard padding-20">
        <div class="row">
            <div class="col-md-offset-2 col-md-8 col-sm-12">
                <div class="embed-responsive embed-responsive-16by9 block margin-bottom-40">
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/yMjtH4utJRI" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
        <div id="graphs">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                    <h3 class="header-text">Informações Gerais</h3>
                </div>
            </div>
            <div class="row">
                <div class="container-fluid text-center">
                    <div class="col-md-4 col-sm-4 margin-bottom-20">
                        <label> Estados com mais Pedidos </label>
                        <canvas id="ctx-pie-state" width="350" height="200"/>
                    </div>
                    <div class="col-md-4 col-sm-4 margin-bottom-20">
                        <label> Cidades com mais Pedidos </label>
                        <canvas id="ctx-doughnut-citys" width="350" height="200"/>
                    </div>
                    <div class="col-md-4 col-sm-4 margin-bottom-20">
                        <label> Negócios mais Pedidos </label>
                        <canvas id="ctx-bar-type-business" width="350" height="200"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="row margin-top-60">
            <div class="col-md-4 col-sm-6">
                <div class="box info">
                    <div class="box-title">
                        <h4>Total de Pedidos <?php echo $all_requests; ?> </h4>
                        <i class="fa fa-comments"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="box success">
                    <div class="box-title">
                        <h4>Total de Cidadãos <?php echo $citizens; ?> </h4>
                        <i class="fa fa-users"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="box warning">
                    <div class="box-title">
                        <h4>Total de Empresas <?php echo $businessman; ?></h4>
                        <i class="fa fa-briefcase"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>