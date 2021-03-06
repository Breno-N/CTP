<div id="graphs" class="hidden-xs">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
            <h3 class="header-text">Informações Gerais</h3>
        </div>
    </div>
    <div class="row">
        <div class="container-fluid text-center">
            <div class="col-lg-4 col-md-4 col-sm-4">
                <label> Negócios mais Pedidos </label>
                <canvas id="ctx-bar-type-business" width="350" height="200"/>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
                <label> Bairros com mais Pedidos </label>
                <canvas id="ctx-pie-neighborhood" width="350" height="200"/>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
                <label> Cidades com mais Pedidos </label>
                <canvas id="ctx-doughnut-citys" width="350" height="200"/>
            </div>
        </div>
    </div>
</div>
<?php if(isset($last_news['itens']) && !empty($last_news['itens'])): ?>
    <div id="news">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading header-text">Últimas Notícias</div>
                    <!-- List group -->
                    <ul class="list-group">
                        <?php foreach($last_news['itens'] as $new): ?>
                            <li class="list-group-item">
                                <h4><?php echo $new->title; ?></h4>
                                <p><?php echo $new->description; ?></p>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>