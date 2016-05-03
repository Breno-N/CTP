<section id="middle">
    <header id="page-header">
        <h1 class="margin-bottom-20"> Arquivos </h1>
        <?php echo $breadcrumbs; ?>
    </header>
    <div class="margin-left-20 margin-top-20">
        <div class="margin-bottom-10">
            <!--<a href="<?php //echo $action_adicionar; ?>" class="btn btn-3d btn-blue"><i class="fa fa-files-o"></i>Importar</a>-->
            <button id="btn-done" class="btn btn-3d btn-green"><i class="fa fa-check"></i>Concluir</button>
            <button id="btn-delete" class="btn btn-3d btn-red"><i class="fa fa-close"></i>Excluir</button>
        </div>
    </div>
    <?php echo $data_table; ?>
</section>