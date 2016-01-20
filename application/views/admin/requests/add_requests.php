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
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="id_type_business">Categoria</label>
                        <?php if(isset($item->id_type_business) && $item->id_type_business): ?>
                                <input type="text" class="form-control" value="<?php echo $item->type_business; ?>" disabled="disabled" />
                        <?php else: 
                                $config['itens'] = $type_business;
                                $config['nome'] = 'id_type_business';
                                $config['extra'] = 'class="form-control"'.((!isset($item)) ? 'required="required"' : 'disabled="disabled"');
                                echo form_select($config, set_value('id_type_business', (isset($item->id_type_business) && $item->id_type_business) ? $item->id_type_business : ''));
                            endif; 
                        ?>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="id_business">Negócio</label>
                        <?php if(isset($item->id_business) && $item->id_business): ?>
                            <input type="text" class="form-control" value="<?php echo $item->business; ?>" disabled="disabled" />
                        <?php else: ?>
                            <select class="form-control" name="id_business" id="id_business" required="required">
                                <option value="">Selecione...</option>
                            </select>
                        <?php endif; ?>
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
            <div class="row form-section form-input">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="description">Descrição</label>
                        <textarea name="description" id="description" class="form-control" <?php echo ((!isset($item)) ? 'required="required"' : 'disabled="disabled"'); ?> ><?php echo set_value('description', (isset($item->description) && $item->description) ? $item->description : '') ?></textarea>
                    </div>
                </div>
                <?php if(!isset($item)): ?>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-help">
                        <div class="alert alert-info">
                            * Descreva com o maximo de detalhes possivel a necessidade desse estabelecimento no seu bairro.
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="row form-section form-input">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="have_business_neighborhood" class="form-input" value="1" <?php echo (isset($item->have_business_neighborhood) && $item->have_business_neighborhood ? 'checked="checked"' : ''); ?> <?php echo ((!isset($item)) ? '' : 'disabled="disabled"'); ?> >Existe esse negócio no bairro
                        </label>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="request_public_agency" class="form-input" value="1" <?php echo (isset($item->request_public_agency) && $item->request_public_agency ? 'checked="checked"' : ''); ?> <?php echo ((!isset($item)) ? '' : 'disabled="disabled"'); ?> >Solicitação feita a algum orgão público
                        </label>
                    </div>
                </div>    
            </div>
            <div class="row form-section form-input">
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="quantity">Quantidade de Pedidos</label>
                        <?php if(isset($item)):?>
                        <input type="number" name="quantity" id="quantity" min="<?php echo $item->quantity + 1; ?>" value="<?php echo $item->quantity; ?>" class="form-control" disabled="disabled">
                        <?php else:?>
                        <input type="number" name="quantity" id="quantity" min="2" value="" class="form-control">
                        <?php endif;?>
                    </div>
                </div>
            </div>
            <?php if(!isset($item) || $item->user_create == $this->session->userdata['email']):?>
                <div class="row form-section uploadfiles form-input">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="files">Upload de Arquivo</label>
                            <input type="file" name="files" id="files" />
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-help">
                        <div class="alert alert-info">
                            * Arquivos Word ou PDF com Nome, CPF e E-mail.
                        </div>
                    </div>
                </div>
            <?php endif;?>
            <?php if(isset($attachments['itens']) && !empty($attachments['itens'])): ?>
                <div class="row form-section form-input">
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
                <div class="row form-section form-input">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <button type="reset" class="btn btn-default">Limpar</button>
                    </div>
                </div>
            <?php endif; ?>
            <?php if(isset($item)): ?>
                <?php if(!isset($request_support)): ?>
                    <div class="row form-section">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button type="button" class="btn btn-success" id="request-support" data-id="<?php echo $item->id; ?>">Apoiar Pedido</button>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if(isset($comments['itens']) && !empty($comments['itens'])): ?>
                    <div class="row form-section form-input">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="list-group">
                                <?php foreach($comments['itens'] as $comment): ?>
                                    <div class="list-group-item">
                                        <h4 class="list-group-item-heading"><?php echo $comment->name; ?> - <?php echo $comment->date; ?></h4>
                                        <p class="list-group-item-text">
                                            <?php echo $comment->description; ?>
                                        </p>
                                        <button type="button" class="btn btn-danger comment-delete" data-id="<?php echo $comment->id; ?>">Excluir</button>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endif;?>
                <?php if($this->session->userdata['can_post']): ?>
                    <div class="row form-section form-input">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="comment">Quer falar algo sobre o pedido ?</label>
                                <textarea name="comment" id="comment" class="form-control" ></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button type="button" class="btn btn-primary" id="comment-save" data-id="<?php echo $item->id; ?>">Salvar Comentário</button>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </form>
    </div>
</div>