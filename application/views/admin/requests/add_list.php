<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <legend>Requisições</legend>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <a href="<?php echo $action_adicionar; ?>" class="btn btn-primary btn-q">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Novo Pedido
        </a>
        <?php if($this->session->userdata['type'] == '3'): ?>
            <a href="" id="btn-delete" class="btn btn-danger btn-q">
                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Excluir
            </a>
        <?php endif; ?>
    </div>
</div>
<?php echo $data_table; ?>