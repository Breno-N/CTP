<?php if(isset($itens['itens']) && !empty($itens['itens'])): ?>
    <div id="content" class="padding-20">
        <div id="panel" class="panel panel-default">
            <div class="panel-heading">
                <span class="title elipsis">
                    <strong>LISTAGEM DE USUÁRIOS</strong>
                </span>
                <ul class="options pull-right list-inline">
                    <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a></li>
                </ul>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="data_table">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Tipo</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($itens['itens'] as $item): ?>
                            <tr class="text-justify data-item" data-id="<?php echo $item->id; ?>">
                                <td><?php echo $item->name; ?></td>
                                <td><?php echo $item->email; ?></td>
                                <td><?php echo $item->type_user; ?></td>
                                <td>
                                    <a href="<?php echo $action_editar.$item->id; ?>" class="btn btn-3d btn-default btn-update">
                                        <span class="fa fa-edit" aria-hidden="true"></span> Editar
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>