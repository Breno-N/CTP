<section class="page-header">
    <div class="container">
        <h1>PÁGINA NÃO ENCONTRADA</h1>
    </div>
</section>
<section>
    <div class="container">
        <div class="row">
            <h2>OPS, <strong>Página não encontrada, assim como o serviço que você precisa!</strong></h2>
            <h3>Faça seu pedido agora</h3>
        </div>
        <div class="row">
            <?php if(validation_errors()): ?>
            <div class="alert alert-danger margin-bottom-30">
                <?php echo validation_errors(); ?>
            </div>
            <?php endif; ?>
            <div class="col-md-12 col-sm-12">
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
    </div>
</section>