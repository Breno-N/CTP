<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <h1 class="margin-bottom-10">Ainda não temos nenhum negócio aberto.</h1>
                <h2>Apoie essa ideia! Faça seu pedido!</h2>
            </div>
        </div>
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
                                        <input type="text" name="business" id="business" class="form-control" data-provide="typeahead" autocomplete="off"  required="required"/>
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
                                    <h4>O négocio selecionado já foi solicitado em seu bairro, para visualizar o pedido <a href="" id="link-support"> Clique Aqui </a></h4>.
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