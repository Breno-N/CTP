<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <h1>Ativação de Cadastro</h1>
            </div>
        </div>
        <div class="row">
            <?php if(validation_errors()): ?>
            <div class="col-md-12 col-sm-12">
                <div class="alert alert-danger margin-bottom-30">
                    <?php echo validation_errors(); ?>
                </div>
            </div>
            <?php endif; ?>
            <?php if(isset($info['message']) && !empty($info['message'])): ?>
            <div class="col-md-12 col-sm-12">
                <div class="alert alert-<?php echo ($info['error'] ? 'danger' : 'info'); ?>">
                    <?php echo $info['message']; ?>
                </div>
            </div>
            <?php endif; ?>
            <div class="col-md-12 col-sm-12 margin-top-20">
                <a class="size-20 font-lato" href="<?php echo base_url().'acesso'; ?>">
                    <i class="glyphicon glyphicon-menu-left margin-right-10 size-16"></i> Logar / Registrar
                </a>
            </div>
        </div>
    </div>
</section>