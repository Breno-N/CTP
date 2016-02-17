<?php if(!isset($item->id_address) || !$item->id_address): ?>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="alert alert-info">
            * Para realizar pedidos é necessário informar o seu endereço.
        </div>
    </div>
</div>
<?php endif; ?>
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
        <?php if(isset($error) && !empty($error)): ?>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                <div class="alert alert-warning">
                    <?php echo $error; ?>
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
        <form action="<?php echo $action; ?>" method="post">
            <div class="row form-section">
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" name="name" id="name" class="form-control" value="<?php echo set_value('name', (isset($item->name) && $item->name) ? $item->name : '') ?>" required="required"/>
                    </div>
                </div>
                <?php if(!isset($item) && empty($item)): ?>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="<?php echo set_value('email', (isset($item->email) && $item->email) ? $item->email : '') ?>" required="required"/>
                    </div>
                </div>
                <?php endif; ?>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="password">Senha</label>
                        <input type="password" name="password" id="password" class="form-control" value=""/>
                    </div>
                </div>
                <?php if($this->session->userdata['admin']): ?>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="id_type_user">Tipo</label>
                        <?php
                            $config['itens'] = $types_user;
                            $config['nome'] = 'id_type_user';
                            $config['extra'] = 'class="form-control" required="required"';
                            echo form_select($config, set_value('id_type_user', (isset($item->id_type_user) && $item->id_type_user) ? $item->id_type_user : ''))
                        ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            <div class="row form-section">
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="age">Idade</label>
                        <input type="number" name="age" id="age" min="18" class="form-control" value="<?php echo set_value('age', (isset($item->age) && $item->age) ? $item->age : '') ?>" />
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="genre">Sexo</label>
                        <?php
                            $genre = array(
                                (object) array('id' => 'M', 'descricao' => 'Masculino'),
                                (object) array('id' => 'F', 'descricao' => 'Feminino')
                            );
                            $config['itens'] = $genre;
                            $config['nome'] = 'genre';
                            $config['extra'] = 'class="form-control"';
                            echo form_select($config, set_value('genre', (isset($item->genre) && $item->genre) ? $item->genre : '' ))
                        ?>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="phone">Telefone</label>
                        <input type="text" name="phone" id="phone" class="form-control" value="<?php echo set_value('phone', (isset($item->phone) && $item->phone) ? $item->phone : '') ?>" />
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="cpf-cnpj">CPF/CNPJ</label>
                        <input type="text" name="cpf_cnpj" id="cpf-cnpj" class="form-control" value="<?php echo set_value('cpf_cnpj', (isset($item->cpf_cnpj) && $item->cpf_cnpj) ? $item->cpf_cnpj : '') ?>" required="required"/>
                    </div>
                </div>
            </div>
            <div class="row form-section">
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="is_pj" id="is-pj" value="1" <?php echo set_value('is_pj', (isset($item->is_pj) && $item->is_pj) ? 'checked="checked"' : '') ?> /> É Empresa
                        </label>
                    </div>
                </div>
            </div>
            <div class="row form-section zip-code">
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="id-address">CEP</label>
                        <input type="text" name="id_address" id="id-address" class="form-control" value="<?php echo set_value('id_address', (isset($item->id_address) && !empty($item->id_address)) ? $item->id_address : '') ?>" <?php echo (isset($item->id_address) && !empty($item->id_address) ? 'disabled="disabled"' : 'required="required"') ?> />
                    </div>
                </div>
            </div>
            <div class="row form-address <?php echo (isset($item->id_address) ? 'filled' : 'not-filled'); ?>">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="alert <?php echo (isset($item->id_address) ? 'alert-info' : ''); ?>">
                        <?php if(isset($item->id_address)): ?>
                            <?php echo $item->state.' - '.$item->city.' - '.$item->neighborhood.' - '.$item->street ; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="row form-section">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <button type="submit" id="submit" class="btn btn-primary">Salvar</button>
                    <!--<button type="reset" id="reset" class="btn btn-default">Limpar</button>-->
                </div>
            </div>
        </form>
    </div>
</div>