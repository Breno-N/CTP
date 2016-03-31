<section id="middle">
    <header id="page-header">
        <h1 class="margin-bottom-20"> Usuários </h1>
        <?php echo $breadcrumbs; ?>
    </header>
    <div id="content" class="padding-20">
        <div class="page-profile">
            <?php if(!isset($item->id_address, $item->cpf) || !$item->id_address || empty($item->cpf)): ?>
            <div class="alert alert-info margin-bottom-30">
                <h4>Importante!</h4>
                <p>* Para realizar pedidos é necessário informar CPF e CEP.</p>
            </div>
            <?php endif; ?>
            <?php if(isset($ok) && $ok): ?>
            <div class="alert alert-info margin-bottom-30">
                <h4>Dados salvos com sucesso!</h4>
            </div>
            <?php endif; ?>
            <?php if(validation_errors()): ?>
            <div class="alert alert-danger margin-bottom-30">
                <?php echo validation_errors(); ?>
            </div>
            <?php endif; ?>
            <?php if(isset($info['message']) && !empty($info['message'])): ?>
            <div class="alert alert-<?php echo ($info['error'] ? 'danger' : 'info'); ?>">
                <?php echo $info['message']; ?>
            </div>
            <?php endif; ?>
            <div class="row">
                <div class="col-md-4 col-lg-3">
                    <section class="panel">
                        <div class="panel-body noradius padding-10">
                            
                            <figure class="margin-bottom-10">
                                <?php 
                                if(isset($user_photo->path) && !empty($user_photo->path)):
                                    $photo = base_url().$user_photo->path;
                                else:
                                    $photo = base_url().'assets/admin/images/demo/9_full.jpg';
                                endif;
                                ?>
                                <img class="img-responsive" src="<?php echo $photo; ?>" />
                            </figure>
                            
                            <hr class="half-margins" />
                            <?php if(isset($item->name) && !empty($item->name)): ?>
                            <h3 class="text-black">
                                <?php echo$item->name; ?>
                                <small class="text-gray size-14"> / <?php echo $item->type_user; ?></small>
                            </h3>
                            <?php endif; ?>
                            <p class="size-12">
                                E-mail: 
                                <?php if(isset($item->email) && !empty($item->email)): ?>
                                    <?php echo $item->email; ?>
                                <?php endif; ?>
                                <br>
                                <br>
                                CPF: 
                                <?php if(isset($item->cpf) && !empty($item->cpf)): ?>
                                    <?php echo $item->cpf; ?>
                                <?php endif; ?>
                                <br>
                                <br>
                                Endereço: 
                                <?php if(isset($item->id_address) && $item->id_address): ?>
                                    <?php echo $item->id_address.' - '.$item->state.' - '.$item->city.' - '.$item->neighborhood.' - '.$item->street ; ?>
                                <?php endif; ?>
                                <br>
                                <br>
                                Data de Nascimento: 
                                <?php if(isset($item->birthday) && $item->birthday != '0000-00-00'): ?>
                                    <?php 
                                        $birthday = new DateTime($item->birthday);
                                        echo $birthday->format('d/m/Y'); 
                                    ?>
                                <?php endif; ?>
                                <br>
                                <br>
                                Sexo: 
                                <?php if(isset($item->genre) && !empty($item->genre)): ?>
                                    <?php echo ($item->genre == 'M' ? 'Masculino' : 'Feminino'); ?>
                                <?php endif; ?>
                            </p>
                        </div>
                    </section>
                </div>
                
                <div class="col-md-8 col-lg-6">
                    <div class="tabs white nomargin-top">
                        <div class="tab-content">
                            <div id="edit" class="tab-pane active">
                               <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                                    <h4>Informação Pessoal</h4>
                                    <fieldset>
                                        
                                        <?php if(!isset($item->name) || empty($item->name)):?>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="name">Nome *</label>
                                            <div class="col-md-8">
                                                <input type="text" name="name" id="name" class="form-control" required="required"/>
                                            </div>
                                        </div>
                                        <?php endif;?>
                                        
                                        <?php if(!isset($item->email) || empty($item->email)):?>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="email">E-mail *</label>
                                            <div class="col-md-8">
                                                <input type="email" name="email" id="email" class="form-control" required="required"/>
                                            </div>
                                        </div>
                                        <?php endif;?>
                                        
                                        <?php if(!isset($item->cpf) || empty($item->cpf)):?>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="cpf">CPF *</label>
                                            <div class="col-md-8">
                                                <input type="text" name="cpf" id="cpf" class="form-control masked" data-format="999.999.999-99" data-placeholder="X"  required="required" />
                                            </div>
                                        </div>
                                        <?php endif;?>
                                        
                                        <?php if(!isset($item->id_address) || empty($item->id_address)):?>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="id-address">CEP *</label>
                                            <div class="col-md-8">
                                                <input type="text" name="id_address" id="id-address" class="form-control masked" data-format="99999999" data-placeholder="X"  required="required" />
                                            </div>
                                        </div>
                                        <div class="form-group form-address">
                                            <div class="col-md-offset-3 col-md-8 col-xs-12">
                                                <div class="alert"></div>
                                            </div>
                                        </div>
                                        <?php endif;?>
                                        
                                        <?php if(!isset($item->id_type_user) && $this->session->userdata['admin']):?>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="id_type_user">Tipo</label>
                                            <div class="col-md-8">
                                                <?php
                                                    $config['itens'] = $types_user;
                                                    $config['nome'] = 'id_type_user';
                                                    $config['extra'] = 'class="form-control pointer" required="required"';
                                                    echo form_select($config, set_value('id_type_user', (isset($item->id_type_user) && $item->id_type_user) ? $item->id_type_user : ''))
                                                ?>
                                            </div>
                                        </div>
                                        <?php endif;?>
                                        
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="phone">Telefone</label>
                                            <div class="col-md-8">
                                                <input type="text" name="phone" id="phone" class="form-control masked" data-format="(99)9999-9999" data-placeholder="X" value="<?php echo set_value('phone', (isset($item->phone) && $item->phone) ? $item->phone : '') ?>" />
                                            </div>
                                        </div>
                                        
                                        <?php if(!isset($item->birthday) || $item->birthday == '0000-00-00'):?>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="birthday">Data de Nascimento</label>
                                            <div class="col-md-8">
                                                <input type="text" name="birthday" id="birthday" class="form-control masked" data-format="99/99/9999" data-placeholder="_" placeholder="DD/MM/YYYY" value="<?php echo set_value('birthday', (isset($item->birthday) && $item->birthday) ? $item->birthday : '' )?>" />
                                            </div>
                                        </div>
                                        <?php endif;?>
                                        
                                        <?php if(!isset($item->genre) || empty($item->genre)):?>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="genre">Sexo</label>
                                            <div class="col-md-8">
                                                <?php
                                                    $genre = array(
                                                        (object) array('id' => 'M', 'descricao' => 'Masculino'),
                                                        (object) array('id' => 'F', 'descricao' => 'Feminino')
                                                    );
                                                    $config['itens'] = $genre;
                                                    $config['nome'] = 'genre';
                                                    $config['extra'] = 'class="form-control pointer"';
                                                    echo form_select($config, set_value('genre', (isset($item->genre) && $item->genre) ? $item->genre : '' ))
                                                ?>
                                            </div>
                                        </div>
                                        <?php endif;?>
                                        
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="files">Foto</label>
                                            <div class="col-md-8">
                                                <input class="custom-file-upload" name="files" type="file" id="files" data-btn-text="Arquivo" />
                                                <small class="text-muted block">2Mb (jpg/png)</small>
                                            </div>
                                        </div>
                                        
                                    </fieldset>
                                    
                                    <hr />
                                    <fieldset class="mb-xl">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="password">Senha</label>
                                            <div class="col-md-8">
                                                <input type="password" name="password" id="password" class="form-control" >
                                            </div>
                                        </div>
                                    </fieldset>
                                    
                                    <div class="row">
                                        <div class="col-md-9 col-md-offset-3">
                                            <button type="submit" id="submit" class="btn btn-success btn-3d">Salvar</button>
                                            <button type="reset" class="btn btn-default btn-3d">Limpar</button>
                                        </div>
                                    </div>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
