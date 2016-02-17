<?php if(isset($itens['itens']) && !empty($itens['itens'])): ?>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table id="data-table" class="table table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Usuário</th>
                            <th>Descrição</th>
                            <th>Negócio</th>
                            <th>Link</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($itens['itens'] as $item): ?>
                            <tr class="text-justify data-item" data-id="<?php echo $item->id; ?>">
                                <td><?php echo $item->user; ?></td>
                                <td><?php echo $item->description; ?></td>
                                <td><?php echo $item->business; ?></td>
                                <td>
                                    <a href="<?php echo base_url().'admin/pedidos/detalhes/'.$item->id_request; ?>">Comentário</a>
                                </td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php endif; ?>