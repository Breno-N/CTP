<section id="middle">
    <header id="page-header">
        <h1 class="margin-bottom-20">Formulário de usuário</h1>
        <?php echo $breadcrumbs; ?>
    </header>
    <div id="content" class="padding-20">
        <?php if(!isset($item->id_address) || !$item->id_address): ?>
        <div class="alert alert-info margin-bottom-30">
            <h4>Importante!</h4>
            <p>* Para realizar pedidos é necessário informar CEP e CPF.</p>
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
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form action="<?php echo $action; ?>" method="post">
                            <fieldset>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <label for="name">Nome *</label>
                                            <input type="text" name="name" id="name" class="form-control" value="<?php echo set_value('name', (isset($item->name) && $item->name) ? $item->name : '') ?>" required="required"/>
                                        </div>
                                        <?php if(!isset($item) && empty($item)): ?>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <label for="email">E-mail *</label>
                                            <input type="email" name="email" id="email" class="form-control" value="<?php echo set_value('email', (isset($item->email) && $item->email) ? $item->email : '') ?>" required="required"/>
                                        </div>
                                        <?php endif; ?>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <label for="password">Senha *</label>
                                            <input type="password" name="password" id="password" class="form-control" value=""/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <?php if(isset($this->session->userdata['admin']) && $this->session->userdata['admin']): ?>
                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                            <label for="id_type_user">Tipo </label>
                                            <?php
                                                $config['itens'] = $types_user;
                                                $config['nome'] = 'id_type_user';
                                                $config['extra'] = 'class="form-control pointer" required="required"';
                                                echo form_select($config, set_value('id_type_user', (isset($item->id_type_user) && $item->id_type_user) ? $item->id_type_user : ''))
                                            ?>
                                        </div>
                                        <?php endif; ?>
                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                            <label for="age">Idade </label>
                                            <input type="text" name="age" id="age" min="18" max="999" class="form-control stepper" value="<?php echo set_value('age', (isset($item->age) && $item->age) ? $item->age : '') ?>" />
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                            <label for="genre">Sexo </label>
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
                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                            <label for="phone">Telefone </label>
                                            <input type="text" name="phone" id="phone" class="form-control <?php echo set_value('phone', (isset($item->phone) && $item->phone) ? '' : 'masked') ?>" data-format="(99)9999-99999" data-placeholder="X" value="<?php echo set_value('phone', (isset($item->phone) && $item->phone) ? $item->phone : '') ?>" <?php echo (isset($item->phone) && $item->phone) ? 'disabled="disabled"' : '' ?> />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <label for="cpf">CPF *</label>
                                            <input type="text" name="cpf" id="cpf" class="form-control masked" data-format="999.999.999-99" data-placeholder="X" value="<?php echo set_value('cpf', (isset($item->cpf) && $item->cpf) ? $item->cpf : '') ?>" <?php echo (isset($item->cpf) && !empty($item->cpf) ? 'disabled="disabled"' : 'required="required"') ?> />
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <label for="id-address">CEP *</label>
                                            <input type="text" name="id_address" id="id-address" class="form-control masked" data-format="99999999" data-placeholder="X" value="<?php echo set_value('id_address', (isset($item->id_address) && !empty($item->id_address)) ? $item->id_address : '') ?>" <?php echo (isset($item->id_address) && !empty($item->id_address) ? 'disabled="disabled"' : 'required="required"') ?> />
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-address <?php echo (isset($item->id_address) && !empty($item->id_address) ? 'filled' : 'not-filled'); ?>">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="alert <?php echo (isset($item->id_address) && !empty($item->id_address) ? 'alert-info' : ''); ?>">
                                            <?php if(isset($item->id_address)): ?>
                                                <?php echo $item->state.' - '.$item->city.' - '.$item->neighborhood.' - '.$item->street ; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-cpf softhide">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="alert">CPF Inválido</div>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="submit" id="submit" class="btn btn-3d btn-success margin-top-30">SALVAR</button>
                                    <button type="reset" class="btn btn-3d btn-warning margin-top-30">LIMPAR</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>