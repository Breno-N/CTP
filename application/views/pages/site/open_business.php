<section>
    <div class="container">
        <div class="row">
            <h2>Ainda não temos nehum negócio aberto, apoie essa idéia, faça seu pedido</h2>
        </div>
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