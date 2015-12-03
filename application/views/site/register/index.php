<?php if(validation_errors()): ?>
<div class="col-lg-offset-2 col-md-offset-2 col-lg-8 col-md-8 col-sm-12 col-xs-12 ">
    <div class="alert alert-danger">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="ctp-errors">
                    <?php echo validation_errors('<h4>','</h4>'); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php if(isset($info['error'])): ?>
<div class="col-lg-offset-2 col-md-offset-2 col-lg-8 col-md-8 col-sm-12 col-xs-12 ">
    <div class="alert alert-<?php echo (($info['error']) ? 'danger' : 'success'); ?>">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="ctp-infos">
                    <h4><?php echo $info['message']; ?></h4>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<div class="col-lg-offset-2 col-md-offset-2 col-lg-8 col-md-8 col-sm-12 col-xs-12 ">
    <form action="<?php echo $action; ?>" method="post">
        <div class="panel panel-default">
            <div class="panel-heading text-center">
                <h4>Cadastre-se</h4>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="name">* Nome</label>
                            <input type="text" name="name" id="name" class="form-control" value="<?php echo set_value('name'); ?>" required="required" />
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="age">* Idade</label>
                            <input type="number" min="0" name="age" id="age" class="form-control" value="<?php echo set_value('age'); ?>" required="required" />
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="genre">* Sexo</label>
                            <?php
                                $genders = array(
                                        (object) array('id' => 'M', 'descricao' => 'Masculino'),
                                        (object) array('id' => 'F', 'descricao' => 'Feminino')
                                );
                                $config['itens'] = $genders;
                                $config['nome'] = 'genre';
                                $config['extra'] = 'class="form-control" required="required"';
                                echo form_select($config, set_value('genre'));
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="email">* E-mail</label>
                            <input type="email" name="email" id="email" class="form-control" value="<?php echo set_value('email'); ?>" required="required" />
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="password">* Senha</label>
                            <input type="password" name="password" id="password" class="form-control" value="" required="required" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <div class="btn-group" role="group">
                            <button type="submit" class="btn btn-primary">Salvar</button>
                            <button type="reset" class="btn btn-default">Limpar</button>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <a href="<?php echo base_url().'login'; ?>" class="btn btn-default pull-right">Fazer Login</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>