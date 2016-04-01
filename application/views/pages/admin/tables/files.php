<?php if(isset($itens['itens']) && !empty($itens['itens'])): ?>
    <div id="content" class="padding-20">
        <div id="panel" class="panel panel-default">
            <div class="panel-heading">
                <span class="title elipsis">
                    <strong>LISTAGEM DE ARQUIVOS</strong>
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
                                <th>Id</th>
                                <th>Descrição</th>
                                <th>Tipo</th>
                                <th>Feito</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($itens['itens'] as $item): ?>
                            <tr class="text-justify data-item" data-id="<?php echo $item->id; ?>">
                                <td><?php echo $item->id; ?></td>
                                <td><?php echo $item->description; ?></td>
                                <td><?php echo $item->type; ?></td>
                                <td><?php echo $item->done; ?></td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>