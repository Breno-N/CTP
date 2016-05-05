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
                            $texto = 'Pedido já existe e você acaba de apoiar!';
                            break;
                        case '3':
                            $texto = 'Pedido apoiado com sucesso!';
                            break;
                    endswitch;
                    echo (isset($texto) && !empty($texto) ? $texto : '');
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
            <div class="col-md-12 col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                            <fieldset>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-12 col-sm-12">
                                            <label for="business">Negócio *</label>
                                            <div class="fancy-form">
                                                <i class="fa fa-briefcase"></i>
                                                <input type="text" name="business" id="business" class="form-control" data-provide="typeahead" autocomplete="off" value="<?php echo ((isset($item->id_business) && $item->id_business) ? $item->business : '')?>" <?php echo ((isset($item->id_business) && $item->id_business) ? 'disabled="disabled"' : 'required="required"')?>/>
                                                <span class="fancy-tooltip top-left">
                                                    <em>Selecione os negócios disponiveis na lista de sugestões!</em>
                                                </span>
                                            </div>
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
                                            <div class="fancy-form">
                                                <textarea name="description" id="description" rows="4" class="form-control" <?php echo ((!isset($item)) ? 'required="required"' : 'disabled="disabled"'); ?>><?php echo set_value('description', (isset($item->description) && $item->description) ? $item->description : '') ?></textarea>
                                                <i class="fa fa-keyboard-o"><!-- icon --></i>
                                                <span class="fancy-hint size-11 text-muted">
                                                    <strong>* Descreva com o máximo de detalhes possível a necessidade desse negócio no seu bairro.</strong>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-input">
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6">
                                            <span>Existe esse negócio no bairro ?</span><br>
                                            <label class="radio">
                                                <input type="radio" name="have_business_neighborhood" value="0" <?php echo (isset($item->have_business_neighborhood) ? 'disabled="disabled"' : '')?> <?php echo ((isset($item->have_business_neighborhood) && !$item->have_business_neighborhood) || !isset($item)) ? 'checked="checked"' : ''; ?>>
                                                <i></i> Não
                                            </label>
                                            <label class="radio">
                                                <input type="radio" name="have_business_neighborhood" value="1" <?php echo (isset($item->have_business_neighborhood) ? 'disabled="disabled"' : '')?> <?php echo (isset($item->have_business_neighborhood) && $item->have_business_neighborhood) ? 'checked="checked"' : ''; ?>>
                                                <i></i> Sim
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <?php if(!isset($item)):?>
                                <div class="alert alert-info form-input">
                                    <p class="small">Se você vai fazer apenas o seu pedido, digite 1. Se você vai pedir por mais pessoas, digite a quantidade e nos envie seu abaixo assinado!</p>
                                </div>
                                <?php endif; ?>
                                <div class="row form-input">
                                    <div class="form-group">
                                        <div class="col-md-3 col-sm-12">
                                            <label for="quantity">Quantidade de Pedidos</label>
                                            <?php if(isset($item)):?>
                                            <input type="text" name="quantity" id="quantity" min="<?php echo $item->quantity + 1; ?>" value="<?php echo $item->quantity; ?>" class="form-control stepper" disabled="disabled">
                                            <?php else:?>
                                            <div class="fancy-form">
                                                <i class="fa fa-comments-o"></i>
                                                <input type="number" name="quantity" id="quantity" min="0" value="" class="form-control">
                                                <span class="fancy-tooltip top-left">
                                                    <em>No Faz Que Falta você pode ser a força que move todo um grupo!</em>
                                                </span>
                                            </div>
                                            <?php endif;?>
                                        </div>
                                        <?php if(!isset($item) || $item->user_create == $this->session->userdata['email']): ?>
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
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php if(isset($attachments['itens'], $this->session->userdata['admin']) && !empty($attachments['itens']) && $this->session->userdata['admin']): ?>
                                <div class="row form-input">
                                    <div class="form-group">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <h4>Arquivos Anexados</h4>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <?php foreach($attachments['itens'] as $attachment): ?>
                                                <a href="<?php echo base_url().'admin/pedidos/download/'.$attachment->id; ?>">Apoiadores do Pedido (Arquivo <?php echo $attachment->id;?>)</a><br>
                                            <?php endforeach; ?>
                                        </div>
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
                                <div class="col-md-3">
                                    <button type="submit" id="pedir" class="btn btn-3d btn-teal btn-block margin-top-30">
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
        <?php if(isset($disqus) && !empty($disqus)): ?>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <?php echo $disqus; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>