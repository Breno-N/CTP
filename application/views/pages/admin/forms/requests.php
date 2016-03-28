<section id="middle">
    <header id="page-header">
        <h1 class="margin-bottom-20">Formulário de Pedidos</h1>
        <?php echo $breadcrumbs; ?>
    </header>
    <div id="content" class="padding-20">
        <?php if(isset($ok) && $ok): ?>
        <div class="alert alert-info margin-bottom-30">
            <h4>
                <?php 
                    switch($ok):
                        case '1':
                            $texto = 'Dados salvos com sucesso!';
                            break;
                        case '2':
                            $texto = 'Pedido já existe!';
                            break;
                        case '3':
                            $texto = 'Pedido apoiado com sucesso!';
                            break;
                    endswitch;
                    echo $texto;
                ?>
            </h4>
        </div>
        <?php endif; ?>
        <?php if(validation_errors()): ?>
        <div class="alert alert-danger margin-bottom-30">
            <?php echo validation_errors(); ?>
        </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                            <fieldset>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-12 col-sm-12">
                                            <label for="business">Negócio *</label>
                                            <input type="text" name="business" id="business" class="form-control" data-provide="typeahead" value="<?php echo ((isset($item->id_business) && $item->id_business) ? $item->business : '')?>" <?php echo ((isset($item->id_business) && $item->id_business) ? 'disabled="disabled"' : 'required="required"')?>/>
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
                                <div class="row form-section form-link-warning">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="alert alert-warning">
                                            O négocio selecionado já foi solicitado em seu bairro, para visualizar o pedido <a href="" id="link-support"> Clique Aqui </a>.
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-input">
                                    <div class="form-group">
                                        <div class="col-md-12 col-sm-12">
                                            <label for="description">Descrição *</label>
                                            <textarea name="description" id="description" rows="4" class="form-control" <?php echo ((!isset($item)) ? 'required="required"' : 'disabled="disabled"'); ?>><?php echo set_value('description', (isset($item->description) && $item->description) ? $item->description : '') ?></textarea>
                                        </div>
                                    </div>
                                    <?php if(!isset($item)): ?>
                                        <div class="col-md-12 col-sm-12 margin-top-20">
                                            <div class="alert alert-info">
                                                * Descreva com o maximo de detalhes possivel a necessidade desse estabelecimento no seu bairro.
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="row form-input">
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6">
                                            <label class="switch switch-success switch">
                                                <input type="checkbox" name="have_business_neighborhood" <?php echo (isset($item->have_business_neighborhood) && $item->have_business_neighborhood ? 'checked="checked"' : ''); ?> <?php echo ((!isset($item)) ? '' : 'disabled="disabled"'); ?>>
                                                <span class="switch-label" data-on="SIM" data-off="NÃO"></span>
                                                <span>Existe esse negócio no bairro ?</span>
                                            </label>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <label class="switch switch-success switch">
                                                <input type="checkbox" name="request_public_agency" <?php echo (isset($item->request_public_agency) && $item->request_public_agency ? 'checked="checked"' : ''); ?> <?php echo ((!isset($item)) ? '' : 'disabled="disabled"'); ?>>
                                                <span class="switch-label" data-on="SIM" data-off="NÃO"></span>
                                                <span>Solicitação feita a algum orgão público ?</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-input">
                                    <div class="form-group">
                                        <div class="col-md-3 col-sm-12">
                                            <label for="quantity">Quantidade de Pedidos</label>
                                            <?php if(isset($item)):?>
                                            <input type="text" name="quantity" id="quantity" min="<?php echo $item->quantity + 1; ?>" value="<?php echo $item->quantity; ?>" class="form-control stepper" disabled="disabled">
                                            <?php else:?>
                                            <input type="number" name="quantity" id="quantity" min="0" value="" class="form-control">
                                            <?php endif;?>
                                        </div>
                                    </div>
                                </div>
                                <?php if(!isset($item) || $item->user_create == $this->session->userdata['email']): ?>
                                <div class="row form-input">
                                    <div class="uploadfiles">
                                        <div class="col-md-12 col-sm-12">
                                            <input class="custom-file-upload" type="file" id="file" name="files" data-btn-text="Selecionar Arquivo" />
                                            <small class="text-muted block">Tamanho máximo de: 2Mb (Word, PDF com Nome, E-mail, CPF e E-mail)</small>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php if(isset($attachments['itens'], $this->session->userdata['admin']) && $this->session->userdata['admin'] && !empty($attachments['itens'])): ?>
                                <div class="row form-input">
                                    <div class="form-group">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <h4>Arquivos Anexados</h4>
                                        </div>
                                        <?php foreach($attachments['itens'] as $attachment): ?>
                                            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                                <a href="<?php echo base_url().'admin/pedidos/download/'.$item->id; ?>"><?php echo $attachment->description; ?></a>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </fieldset>
                            <?php if(isset($item)): ?>
                                <?php if(!isset($request_support)): ?>
                                <div class="row form-input margin-top-20">
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-3d btn-success" id="request-support" data-id="<?php echo $item->id; ?>">
                                            APOIAR PEDIDO
                                        </button>
                                    </div>
                                </div>
                                <?php endif; ?>
                            <?php else: ?>
                            <div class="row form-input">
                                <div class="col-md-12">
                                    <button type="submit" id="pedir" class="btn btn-3d btn-teal margin-top-30">
                                        REALIZAR PEDIDO
                                    </button>
                                </div>
                            </div>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>