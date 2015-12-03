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
                        <label for="state">Estados</label>
                        <?php
                            $config['itens'] = $states;
                            $config['nome'] = 'state';
                            $config['extra'] = 'class="form-control" required="required"';
                            echo form_select($config,((isset($item->id_state_selected) && $item->id_state_selected) ? $item->id_state_selected : ''));
                        ?>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="id_city">Cidade</label>
                        <input type="hidden" name="id_city_selected" id="id_city_selected" value="<?php echo set_value('id_city_selected', (isset($item->id_city_selected) && $item->id_city_selected) ? $item->id_city_selected : '') ?>">
                        <select name="id_city" id="city" class="form-control" required="required">
                            <option value="">Selecione...</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="description">Descrição</label>
                        <input type="text" name="description" id="description" class="form-control" value="<?php echo set_value('description', (isset($item->description) && $item->description) ? $item->description : '') ?>" required="required"/>
                    </div>
                </div>
            </div>
            <div class="row form-section">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="active" id="active" value="1" <?php echo ((isset($item->active) && $item->active) ? 'checked="checked"' : ''); ?> > Ativo
                        </label>
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