<?php if(!isset($item->id_address)):; ?>
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
                        <label for="zip-code">CEP</label>
                        <input type="text" name="zip_code" id="zip-code" class="form-control" value="<?php echo set_value('zip_code', (isset($item->zip_code) && $item->zip_code) ? $item->zip_code : '') ?>" required="required" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="state">UF</label>
                        <?php
                            $config['itens'] = $states;
                            $config['nome'] = 'state';
                            $config['extra'] = 'class="form-control"';
                            echo form_select($config, set_value('state', (isset($item->id_state_selected) && $item->id_state_selected) ? $item->id_state_selected : '' ))
                        ?>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="city">Cidade</label>
                        <input type="hidden" name="id_city_selected" id="id_city_selected" value="<?php echo set_value('id_city_selected', (isset($item->id_city_selected) && $item->id_city_selected) ? $item->id_city_selected : '') ?>">
                        <select name="id_city" id="city" class="form-control">
                            <option value="">Selecione...</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="neighborhood">Bairro</label>
                        <input type="text" name="neighborhood" id="neighborhood" class="form-control" value="<?php echo set_value('neighborhood', (isset($item->neighborhood) && $item->neighborhood) ? $item->neighborhood : '') ?>" required="required" />
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="street">Rua</label>
                        <input type="text" name="street" id="street" class="form-control" value="<?php echo set_value('street', (isset($item->street) && $item->street) ? $item->street : '') ?>" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="number">Número</label>
                        <input type="number" name="number" id="number" class="form-control" min="1" value="<?php echo set_value('number', (isset($item->number) && $item->number) ? $item->number : '') ?>" />
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="complement">Complemento</label>
                        <input type="text" name="complement" id="complement" class="form-control" value="<?php echo set_value('complement', (isset($item->complement) && $item->complement) ? $item->complement : '') ?>" />
                    </div>
                </div>
            </div>
            <div class="row form-section">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <button type="reset" class="btn btn-default">Limpar</button>
                </div>
            </div>
        </form>
    </div>
</div>