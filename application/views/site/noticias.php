<div id="ctp-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h1>Noticias</h1>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <div class="row">
                    <?php  for($i = 0; $i < 6; $i++): ?>
                    <!--Listar 6 últimas noticias-->
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="media news">
                            <div class="media-left">
                                <a href="#">
                                    <img class="media-object" src="#" alt="texto de imagem">
                                </a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">Cabeçalho da Noticia</h4>
                                Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.
                            </div>
                        </div>
                    </div>
                    <?php  endfor; ?>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <h4>Barra de Pequisa</h4>
            </div>
        </div>
    </div>
</div>