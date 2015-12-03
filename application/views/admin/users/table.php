<?php if(isset($itens['itens']) && !empty($itens['itens'])): ?>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table id="data-table" class="table table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Idade</th>
                            <th>Tipo</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($itens['itens'] as $item): ?>
                            <tr class="text-justify data-item" data-id="<?php echo $item->id; ?>">
                                <td><?php echo $item->name; ?></td>
                                <td><?php echo $item->email; ?></td>
                                <td><?php echo $item->age; ?></td>
                                <td><?php echo $item->type_user; ?></td>
                                <td>
                                    <a href="<?php echo $action_editar.$item->id; ?>" class="btn btn-default btn-update">
                                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Detalhes
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php endif; ?>