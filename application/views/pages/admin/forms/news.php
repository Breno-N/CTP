<section id="middle">
    <header id="page-header">
        <h1 class="margin-bottom-20">Formulário de notícias</h1>
        <?php echo $breadcrumbs; ?>
    </header>
    <div id="content" class="padding-20">
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
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <label for="title">Titulo</label>
                                            <input type="text" name="title" id="title" class="form-control" value="<?php echo set_value('title', (isset($item->title) && $item->title) ? $item->title : '') ?>" required="required"/>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <label for="id_news_category">Categoria</label>
                                            <?php
                                                $config['itens'] = $news_categories;
                                                $config['nome'] = 'id_news_category';
                                                $config['extra'] = 'class="form-control pointer" required="required"';
                                                echo form_select($config,((isset($item->id_news_category) && $item->id_news_category) ? $item->id_news_category : ''));
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <label for="description">Descrição</label>
                                            <textarea name="description" id="description" class="form-control" required="required"><?php echo set_value('description', (isset($item->description) && $item->description) ? $item->description : '') ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <label class="switch switch-success">
                                                <input type="checkbox" name="active" <?php echo ((isset($item->active) && $item->active) ? 'checked="checked"' : ''); ?>>
                                                <span class="switch-label" data-on="SIM" data-off="NÃO"></span>
                                                <span>Ativar</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-3d btn-success margin-top-30">SALVAR</button>
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