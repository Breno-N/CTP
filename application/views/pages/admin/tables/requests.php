<?php if(isset($itens['itens']) && !empty($itens['itens'])): ?>
    <div id="content" class="padding-20">
        <div id="panel" class="panel panel-default">
            <div class="panel-heading">
                <span class="title elipsis">
                    <strong>LISTAGEM DE PEDIDOS</strong>
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
                                <th>Negócio</th>
                                <th>Categoria</th>
                                <th>Nº de Solitações</th>
                                <th>Status</th>
                                <th>Data de criação</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($itens['itens'] as $item): ?>
                            <tr class="text-justify data-item" data-id="<?php echo $item->id; ?>">
                                <td><?php echo $item->business; ?></td>
                                <td><?php echo $item->type_business; ?></td>
                                <td><?php echo $item->quantity; ?></td>
                                <td><?php echo $item->type_request_status; ?></td>
                                <td><?php echo $item->date_create; ?></td>
                                <td>
                                    <a href="<?php echo $action_detalhes.$item->id; ?>" class="btn btn-3d btn-default btn-update">
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
    </div>
<?php endif; ?>