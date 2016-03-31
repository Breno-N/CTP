<!-- PRESENTATION -->
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-7 col-sm-12">
                <!-- VIMEO VIDEO -->
                <div class="embed-responsive embed-responsive-16by9 block margin-bottom-60">
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/xBddbkRDpQs" width="800" height="450"></iframe>
                </div>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-12">
                <h2 class="size-25">Bem Vindo ao FAZ, QUE FALTA!</h2>
                <p>O Faz, que Falta é um sistema que aproxima empreendedores as necessidades da população!</p>
                <p>Para o cidadão é possível fazer pedido de coisas que faltam na sua comunidade como por exemplo uma fármacia.</p>
                <p>Já para o empreendor que tem o capital necessário e a idéia, ele tem acesso as esses pedidos, e sabe exatamente onde pode construir o seu negocio de sucesso!</p>
            </div>
        </div>
    </div>
</section>
<!-- /PRESENTATION -->

<!-- CALLOUT -->
<section class="callout-dark heading-title heading-arrow-bottom">
    <div class="container">
        <div class="text-center">
            <h3 class="size-30">Comece agora, faça seu pedido</h3>
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
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
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
                        <div class="col-md-12 col-sm-12 margin-top-20">
                            <div class="alert alert-info">
                                * Descreva com o maximo de detalhes possivel a necessidade desse estabelecimento no seu bairro.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6">
                                <span>Existe esse negócio no bairro ?</span><br>
                                <label class="radio">
                                    <input type="radio" name="have_business_neighborhood" value="1" >
                                    <i></i> Sim
                                </label>
                                <label class="radio">
                                    <input type="radio" name="have_business_neighborhood" value="0" >
                                    <i></i> Não
                                </label>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <span>Solicitação feita a algum orgão público ?</span><br>
                                <label class="radio">
                                    <input type="radio" name="request_public_agency" value="1" >
                                    <i></i> Sim
                                </label>
                                <label class="radio">
                                    <input type="radio" name="request_public_agency" value="0" >
                                    <i></i> Não
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-3 col-sm-12">
                                <label for="quantity">Quantidade de Pedidos</label>
                                <input type="number" name="quantity" id="quantity" min="0" value="" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="uploadfiles">
                            <div class="col-md-12 col-sm-12">
                                <input class="custom-file-upload" type="file" id="file" name="files" data-btn-text="Selecionar Arquivo" />
                                <small class="text-muted block">Tamanho máximo de: 2Mb (Word, PDF com Nome, E-mail, CPF e CEP)</small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" id="pedir" class="btn btn-3d btn-teal margin-top-10">
                                REALIZAR PEDIDO
                            </button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</section>
 <!-- /REQUEST -->
 
<!-- PARALLAX -->
<section class="parallax parallax-2" style="background-image: url('assets/site/images/parallax.jpg');">
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