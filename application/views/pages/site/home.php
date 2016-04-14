<section class="padding-30">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8 col-sm-12">
                <div class="embed-responsive embed-responsive-4by3 block margin-bottom-40">
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/xBddbkRDpQs" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 text-center">
                <h1 class="margin-bottom-20">Bem Vindo ao FAZ QUE FALTA!</h1>
                <h2 class="font-lato size-20">O Faz Que Falta é a SUA chance de mudar o seu contexto social!</h2>
                <h3 class="font-lato size-18">Nós apresentamos sua demanda para os empreendedores e assim possibilitamos um impacto social através do empreendedorismo!</h3>
                <h3 class="font-lato size-18">É o trabalho em conjunto da população impactando a realidade!</h3>
                <h3 class="font-lato size-18">Vem com a gente!</h3>
            </div>
        </div>
    </div>
</section>

<section class="callout-dark heading-title heading-arrow-bottom padding-40">
    <div class="container">
        <div class="text-center">
            <h2 class="size-30"><i>Pronto para começar ? Nos diga o que falta no seu bairro!</i></h2>
        </div>
    </div>
</section>

<section class="padding-30">
    <div class="container">
        <div class="row">
            <?php if(validation_errors()): ?>
            <div class="col-md-12 col-sm-12">
                <div class="alert alert-danger margin-bottom-30">
                    <?php echo validation_errors(); ?>
                </div>
            </div>
            <?php endif; ?>
            <div class="col-md-12 col-sm-12">
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12 col-sm-12">
                                    <label for="business">Negócio *</label>
                                    <div class="fancy-form">
                                        <i class="fa fa-briefcase"></i>
                                        <input type="text" name="business" id="business" class="form-control" data-provide="typeahead" required="required"/>
                                        <span class="fancy-tooltip top-left">
                                            <em>Selecione os negócios disponiveis na lista de sugestões!</em>
                                        </span>
                                    </div>
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
                                    <div class="fancy-form">
                                        <textarea name="description" id="description" rows="4" class="form-control" required="required"></textarea>
                                        <i class="fa fa-keyboard-o"><!-- icon --></i>
                                        <span class="fancy-hint size-11 text-muted">
                                            <strong>* Descreva com o máximo de detalhes possível a necessidade desse negócio no seu bairro.</strong>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6">
                                    <span>Existe esse negócio no bairro ?</span><br>
                                    <label class="radio">
                                        <input type="radio" name="have_business_neighborhood" value="0" checked="checked" >
                                        <i></i> Não
                                    </label>
                                    <label class="radio">
                                        <input type="radio" name="have_business_neighborhood" value="1" >
                                        <i></i> Sim
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-info">
                            <p class="small">Se você vai fazer apenas o seu pedido, digite 1. Se você vai pedir por mais pessoas, digite a quantidade e nos envie seu abaixo assinado!</p>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-3 col-sm-12">
                                    <label for="quantity">Quantidade de Pedidos</label>
                                    <div class="fancy-form">
                                        <i class="fa fa-comments-o"></i>
                                        <input type="number" name="quantity" id="quantity" min="0" value="" class="form-control">
                                        <span class="fancy-tooltip top-left">
                                            <em>No Faz Que Falta você pode ser a força que move todo um grupo!</em>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="uploadfiles">
                                        <label>Modelo</label>
                                        <a href="<?php echo base_url().'modelo/modelo.pdf'; ?>" class="btn btn-3d btn-success btn-block">Download</a>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="uploadfiles">
                                        <label for="file">Anexo (Tamanho máximo de: 5Mb)</label>
                                        <input class="custom-file-upload" type="file" id="file" name="files" data-btn-text="Arquivo" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <button type="submit" id="pedir" class="btn btn-3d btn-teal btn-block margin-top-10">
                                    REALIZAR PEDIDO
                                </button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</section>

<section id="parallax-informative" class="parallax parallax-2">
    <div class="overlay dark-8"></div>
    <div class="container">
        <div class="row countTo-sm text-center">
            <div class="col-xs-6 col-sm-3">
                <i class="ico-lg ico-transparent et-profile-male"></i>
                <div class="block size-40 citizens">
                    <strong class="countTo size-40" data-speed="3000"><?php echo $citizens; ?></strong>
                </div>
                <h3 class="size-15 margin-top-10 margin-bottom-0">USUÁRIOS</h3>
            </div>
            <div class="col-xs-6 col-sm-3">
                <i class="ico-lg ico-transparent et-briefcase"></i>
                <div class="block size-40 businessman">
                    <strong class="countTo size-40" data-speed="3000"><?php echo $businessman; ?></strong>
                </div>
                <h3 class="size-15 margin-top-10 margin-bottom-0">EMPRESAS</h3>
            </div>
            <div class="col-xs-6 col-sm-3">
                <i class="ico-lg ico-transparent et-chat"></i>
                <div class="block size-40 all-requests">
                    <strong class="countTo size-40" data-speed="3000"><?php echo $all_requests; ?></strong>
                </div>
                <h3 class="size-15 margin-top-10 margin-bottom-0">PEDIDOS</h3>
            </div>
            <div class="col-xs-6 col-sm-3">
                <i class="ico-lg ico-transparent et-linegraph"></i>
                <div class="block size-40 open-requests">
                    <strong class="countTo size-40" data-speed="3000"><?php echo $open_requests; ?></strong> %
                </div>
                <h3 class="size-15 margin-top-10 margin-bottom-0">CONVERSÃO</h3>
            </div>
        </div>
    </div>
</section>