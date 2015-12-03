<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <?php if(isset($ok) && $ok): ?>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                <div class="alert alert-success">
                    Dados salvos com sucesso.   
                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php if(validation_errors()): ?>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                <div class="alert alert-danger">
                    <?php echo validation_errors(); ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
            <div class="row form-section">
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="title">Titulo</label>
                        <input type="text" name="title" id="title" class="form-control" value="<?php echo set_value('title', (isset($item->title) && $item->title) ? $item->title : '') ?>" <?php echo ((!isset($item)) ? 'required="required"' : 'disabled="disabled"'); ?> />
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="id_type_business">Tipo de Requisição</label>
                        <?php
                            $config['itens'] = $type_business;
                            $config['nome'] = 'id_type_business';
                            $config['extra'] = 'class="form-control"'.((!isset($item)) ? 'required="required"' : 'disabled="disabled"');
                            echo form_select($config, set_value('id_type_business', (isset($item->id_type_business) && $item->id_type_business) ? $item->id_type_business : ''));
                        ?>
                    </div>
                </div>
            </div>
            <div class="row form-section">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="description">Descrição</label>
                        <textarea name="description" id="description" class="form-control" <?php echo ((!isset($item)) ? 'required="required"' : 'disabled="disabled"'); ?> ><?php echo set_value('description', (isset($item->description) && $item->description) ? $item->description : '') ?></textarea>
                    </div>
                </div>
            </div>
            <div class="row form-section">
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="have_business_neighborhood" value="1" <?php echo (isset($item->have_business_neighborhood) && $item->have_business_neighborhood ? 'checked="checked"' : ''); ?> <?php echo ((!isset($item)) ? '' : 'disabled="disabled"'); ?> >Existe esse negócio no bairro
                        </label>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="request_public_agency" value="1" <?php echo (isset($item->request_public_agency) && $item->request_public_agency ? 'checked="checked"' : ''); ?> <?php echo ((!isset($item)) ? '' : 'disabled="disabled"'); ?> >Solicitação feita a algum orgão público
                        </label>
                    </div>
                </div>
            </div>
            
            <?php if(!isset($item) || $item->user_create == $this->session->userdata['email']):?>
                <div class="row form-section">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="files">Upload de Arquivo</label>
                            <input type="file" name="files" />
                        </div>
                    </div>
                </div>
            <?php endif;?>
            
            <?php if(isset($attachments['itens']) && !empty($attachments['itens'])): ?>
                <div class="row form-section">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <h4>Arquivos Anexados</h4>
                    </div>
                    <?php foreach($attachments['itens'] as $attachment): ?>
                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                            <a href="<?php echo base_url().'admin/requisicoes/download/'.$item->id.'/'.$attachment->description; ?>"><?php echo $attachment->description; ?></a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            
            <?php if(!isset($item)): ?>
                <div class="row form-section">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <button type="reset" class="btn btn-default">Limpar</button>
                    </div>
                </div>
            <?php endif; ?>
            
            <?php if(isset($item) && $item->user_create == $this->session->userdata['email']): ?>
                <div class="row form-section">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <?php if(!isset($item)):?>
                            <button type="reset" class="btn btn-default">Limpar</button>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
            
            <?php if(isset($item) && !isset($request_support)): ?>
                <div class="row form-section">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <button type="button" class="btn btn-primary" id="request-support" data-id="<?php echo $item->id; ?>">Apoiar Solicitação</button>
                    </div>
                </div>
            <?php endif; ?>
            
        </form>
    </div>
</div>