<!-- PRESENTATION -->
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-7 col-sm-12">
                <!-- VIMEO VIDEO -->
                <div class="embed-responsive embed-responsive-16by9 block margin-bottom-60">
                    <iframe class="embed-responsive-item" src="http://player.vimeo.com/video/8408210" width="800" height="450"></iframe>
                </div>
                <!--<img class="img-responsive" src="assets/images/demo/girl_looking-min.jpg" alt="">-->
            </div>
            <div class="col-lg-5 col-md-5 col-sm-12">
                <h2 class="size-25">Bem Vindo ao FAZ, QUE FALTA!</h2>
                <p>O Faz Falta é um sistema que aproxima empreendedores as necessidades da população!</p>
                <p>Para o cidadão é possível fazer pedido de coisas que faltam na sua comunidade como por exemplo uma fármacia.</p>
                <p>Já para o empreendor que tem o capital necessário e a idéia, ele tem acesso as esses pedidos, e sabe exatamente onde pode construir o seu negocio de sucesso!</p>
                <blockquote>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas metus nulla, commodo a sodales sed, dignissim pretium nunc.</p>
                        <cite>Albert Einstein</cite>
                </blockquote>
            </div>
        </div>
    </div>
</section>
<!-- /PRESENTATION -->

<!-- CALLOUT -->
<section class="callout-dark heading-title heading-arrow-bottom">
    <div class="container">
        <div class="text-center">
            <h3 class="size-30">Smarty Multipurpose Responsive Template</h3>
            <p>We can't solve problems by using the same kind of thinking we used when we created them.</p>
        </div>
    </div>
</section>
<!-- /CALLOUT -->

<!-- /REQUEST -->
<section>
    <div class="container">
        <div class="row">
        <?php if(validation_errors()): ?>
        <div class="alert alert-danger margin-bottom-30">
            <?php echo validation_errors(); ?>
        </div>
        <?php endif; ?>
            <form action="<?php echo $action; ?>" method="post">
                <fieldset>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12">
                                <label for="business">Negócio *</label>
                                <input type="text" name="business" id="business" class="form-control" data-provide="typeahead" required="required"/>
                            </div>
                        </div>
                    </div>
                    <div class="row form-notfind-business">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="alert alert-warning">
                                Se você não encontrar o negócio que precisa <a href="<?php echo base_url().'contato'; ?>">INFORME-NOS</a> por gentileza.
                            </div>
                        </div>
                    </div>
                    <?php if(isset($this->session->userdata['authentication']) && $this->session->userdata['authentication']): ?>
                    <div class="row form-link-warning">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="alert alert-warning">
                                O négocio selecionado já foi solicitado em seu bairro, para visualizar o pedido <a href="" id="link-support"> Clique Aqui </a>.
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12">
                                <label for="description">Descrição *</label>
                                <textarea name="description" id="description" rows="4" class="form-control" required="required"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6">
                                <label class="switch switch-success switch">
                                    <input type="checkbox" name="have_business_neighborhood">
                                    <span class="switch-label" data-on="SIM" data-off="NÃO"></span>
                                    <span>Existe esse negócio no bairro ?</span>
                                </label>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <label class="switch switch-success switch">
                                    <input type="checkbox" name="request_public_agency">
                                    <span class="switch-label" data-on="SIM" data-off="NÃO"></span>
                                    <span>Solicitação feita a algum orgão público ?</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" id="pedir" class="btn btn-3d btn-teal margin-top-30">
                            REALIZAR PEDIDO
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
 <!-- /REQUEST -->
 
<!-- GRAPHS -->
<!--<section>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-xs-12">
                <canvas class="chartjs" id="ctx-bar-type-business" width="547" height="300"></canvas>
            </div>
            <div class="col-md-6 col-xs-12">
                <canvas class="chartjs height-300" id="ctx-pie-neighborhood" width="547" height="300"></canvas>
            </div>
        </div>
    </div>
</section>-->
<!-- /GRAPHS -->

<!-- PARALLAX -->
<section class="parallax parallax-2" style="background-image: url('assets/site/images/demo/1200x800/18-min.jpg');">
    <div class="overlay dark-8"><!-- dark overlay [1 to 9 opacity] --></div>
    <div class="container">
        <div class="row countTo-sm text-center">
            <div class="col-xs-6 col-sm-3">
                <i class="ico-lg ico-transparent et-profile-male"></i>
                <div class="block size-40" style="color: #3498db;">
                    <strong class="countTo size-40" data-speed="3000"><?php echo $citizens; ?></strong>
                </div>
                <h3 class="size-15 margin-top-10 margin-bottom-0">USUÁRIOS</h3>
            </div>
            <div class="col-xs-6 col-sm-3">
                <i class="ico-lg ico-transparent et-briefcase"></i>
                <div class="block size-40" style="color: #e74c3c;">
                    <strong class="countTo size-40" data-speed="3000"><?php echo $businessman; ?></strong>
                </div>
                <h3 class="size-15 margin-top-10 margin-bottom-0">EMPRESAS</h3>
            </div>
            <div class="col-xs-6 col-sm-3">
                <i class="ico-lg ico-transparent et-chat"></i>
                <div class="block size-40" style="color: #16a085;">
                    <strong class="countTo size-40" data-speed="3000"><?php echo $all_requests; ?></strong>
                </div>
                <h3 class="size-15 margin-top-10 margin-bottom-0">PEDIDOS</h3>
            </div>
            <div class="col-xs-6 col-sm-3">
                <i class="ico-lg ico-transparent et-linegraph"></i>
                <div class="block size-40" style="color: #9b59b6;">
                    <strong class="countTo size-40" data-speed="3000"><?php echo $open_requests; ?></strong> %
                </div>
                <h3 class="size-15 margin-top-10 margin-bottom-0">CONVERSÃO</h3>
            </div>
        </div>
    </div>
</section>
<!-- /PARALLAX -->

<!-- FEATURES -->
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-xs-6">
                <div class="text-center">
                    <i class="ico-light ico-lg ico-rounded ico-hover et-piechart"></i>
                    <h4>Graphs</h4>
                    <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus.</p>
                </div>
            </div>
            <div class="col-md-3 col-xs-6">
                <div class="text-center">
                    <i class="ico-light ico-lg ico-rounded ico-hover et-strategy"></i>
                    <h4>Startegy</h4>
                    <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus.</p>
                </div>
            </div>
            <div class="col-md-3 col-xs-6">
                <div class="text-center">
                    <i class="ico-light ico-lg ico-rounded ico-hover et-streetsign"></i>
                    <h4>SEO Optimized</h4>
                    <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus. </p>
                </div>
            </div>
            <div class="col-md-3 col-xs-6">
                <div class="text-center">
                    <i class="ico-light ico-lg ico-rounded ico-hover et-trophy"></i>
                    <h4>Winners</h4>
                    <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /FEATURES -->