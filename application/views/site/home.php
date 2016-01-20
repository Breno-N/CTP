<div>
    <div class="main-text">
        <div class="jumbotron header-text">
            <div class="container">
                <h1>Bem Vindo ao  FAZ FALTA!</h1>
                <p>O Faz Falta é um sistema que aproxima empreendedores as necessidades da população! Para o cidadão é possível fazer pedido de coisas que faltam na sua comunidade como por exemplo uma fármacia. Já para o empreendor que tem o capital necessário e a idéia, ele tem acesso as esses pedidos, e sabe exatamente onde pode construir o seu negocio de sucesso! </p>
            </div>
        </div>
        <div id="graphs">
            <div class="row">
                <div class="container-fluid graphs text-center">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label> Negócios mais Pedidos </label>
                        <canvas id="ctx-bar-type-business" width="350" height="200"/>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label> Bairros com mais Pedidos </label>
                        <canvas id="ctx-pie-neighborhood" width="350" height="200"/>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label> Cidades com mais Pedidos </label>
                        <canvas id="ctx-doughnut-citys" width="350" height="200"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <tr>
                                <td>Total de Pedidos</td>
                                <td>Empreendedores</td>
                                <td>Cidadãos</td>
                                <td>Negócios já abertos</td>
                            </tr>
                            <tr>
                                <td><?php echo $all_requests; ?></td>
                                <td><?php echo $businessman; ?></td>
                                <td><?php echo $citizens; ?></td>
                                <td><?php echo $open_requests; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                    <a href="" class="btn btn-primary btn-lg">Sou Cidadão</a>
                    <a href="" class="btn btn-success btn-lg">Sou Empreendedor</a>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-text">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-justify">
                    <h2>Quem somos</h2>
                    <p>
                        O site FAZ FALTA é um projeto do CTP Group! Grupo formado por jovens empreendedores que atuam em diversos projetos nas aréas de Empreendedorismo, Educação e Consultoria. Pàra conhecer mais acesse o site do grupo <a href="http://www.ctpgroup.com.br">CTPGroup!</a> 
                    </p>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-justify">
                    <h2>Na Mídia</h2>
                    <p>
                        Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae
                    </p>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-justify">
                    <h2>Redes Sociais!</h2>
                    <p>
                        Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Faz que Falta</h4>
            </div>
            <div class="modal-body">
              <iframe src="https://www.youtube.com/watch?v=Zow19hXGixI;autoplay=1" width="100%" height="100%" frameborder="0"></iframe>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->