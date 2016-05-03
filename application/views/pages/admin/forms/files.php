<section id="middle">
    <header id="page-header">
        <h1 class="margin-bottom-20">Formulário de Arquivos</h1>
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
                <div class="alert alert-warning">
                    <p>* A extensão do arquivo deve ser CSV.</p>
                    <p>* A ordem dos campos deve ser respeitada.</p>
                    <p>* Ordem: Nome do usuário, CPF(999.999.999.-99), CEP(99999-999), e-mail e ID do Pedido</p>
                    <p>* NÃO deve ser incluso o usuário que abriu o pedido.</p>
                </div>
            </div>
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <label for="file">Anexo</label>
                                        <input class="custom-file-upload" type="file" id="file" name="files" data-btn-text="Arquivo" />
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