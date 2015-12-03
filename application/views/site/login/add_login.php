<div id="ctp-content">
    <div class="container">
         <div class="row">
            <div class="col-lg-offset-3 col-lg-6 col-lg-offset-3 col-md-12 col-sm-12 col-xs-12 erro-login">
                <?php if(validation_errors()): ?>
                    <div class="alert alert-danger">
                        <h4 class="text-center">Acesso Negado</h4>
                        <?php echo validation_errors('<h4 class="text-center">', '</h4>');?>
                    </div>
                <?php endif;?>
                <?php if(isset($error) && $error): ?>
                    <div class="alert alert-danger">
                        <h4 class="text-center">Acesso Negado</h4>
                        <h4 class="text-center"><?php echo $error; ?></h4>
                    </div>
                <?php endif;?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-offset-3 col-lg-6 col-lg-offset-3 col-md-12 col-sm-12 col-xs-12 field-login">
                <form action="<?php echo $action; ?>" method="post">
                    <fieldset>
                        <legend>Acessar sistema</legend>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="email">E-mail</label>
                                    <input type="text" name="email" id="email" class="form-control" required="required" />
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="password">Senha</label>
                                    <input type="password" name="password" id="password" class="form-control" required="required" />
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="btn-group btn-group-justified" role="group" >
                                    <div class="btn-group" role="group">
                                        <button type="submit" class="btn btn-primary">Logar</button>
                                    </div>
                                    <div class="btn-group" role="group">
                                        <a href="<?php echo $action_acess; ?>" class="btn btn-default">Criar Acesso</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>