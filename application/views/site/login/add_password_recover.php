<div class="container">
    <?php if(validation_errors()): ?>
    <div class="row">
        <div class="col-lg-offset-2 col-md-offset-2 col-lg-8 col-md-8 col-sm-12 col-xs-12 ">
            <div class="alert alert-danger">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="ctp-errors">
                            <?php echo validation_errors('<h4>','</h4>'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif;?>
    <?php if(isset($info) && !empty($info)): ?>
    <div class="row">
        <div class="col-lg-offset-2 col-md-offset-2 col-lg-8 col-md-8 col-sm-12 col-xs-12 ">
            <div class="alert alert-info">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?php echo $info; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif;?>
    <div class="row">
        <div class="col-lg-offset-3 col-md-offset-3 col-lg-7 col-md-7 col-sm-12 col-xs-12">
            <form action="<?php echo $action; ?>" method="post">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="email">E-mail</label>
                                    <input type="email" name="email" id="email" class="form-control" required="required" />
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="btn-group btn-group-justified" role="group" >
                                    <div class="btn-group" role="group">
                                        <button type="submit" class="btn btn-primary">Recuperar Senha</button>
                                    </div>
                                    <div class="btn-group" role="group">
                                        <a href="<?php echo $action_back; ?>" class="btn btn-default">Voltar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>