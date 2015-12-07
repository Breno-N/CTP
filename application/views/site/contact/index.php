<?php if(validation_errors()): ?>
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
<?php endif; ?>
<?php if(isset($info['error'])): ?>
<div class="col-lg-offset-2 col-md-offset-2 col-lg-8 col-md-8 col-sm-12 col-xs-12 ">
    <div class="alert alert-<?php echo (($info['error']) ? 'danger' : 'success'); ?>">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="ctp-infos">
                    <h4><?php echo $info['message']; ?></h4>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<div class="col-lg-offset-2 col-md-offset-2 col-lg-8 col-md-8 col-sm-12 col-xs-12" id="contact">
    <div class="panel panel-default">
        <div class="panel-heading text-uppercase">
            <div class="row">
                <div class="col-lg-offset-1 col-md-offset-1 col-lg-10 col-md-10 col-sm-12 col-xs-12">
                    <h4>Contato</h4>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <form action="<?php echo $action; ?>" method="post">
                <div class="row">
                    <div class="col-lg-offset-1 col-md-offset-1 col-lg-10 col-md-10 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="name">Nome </label>
                            <input type="text" name="name" id="name" class="form-control" required="required" />
                        </div>
                    </div>
                    <div class="col-lg-offset-1 col-md-offset-1 col-lg-10 col-md-10 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="cc">Email </label>
                            <input type="email" name="cc" id="cc" class="form-control" required="required" />
                        </div>
                    </div>
                    <div class="col-lg-offset-1 col-md-offset-1 col-lg-10 col-md-10 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="subject">Assunto </label>
                            <input type="text" name="subject" id="subject" class="form-control" required="required" />
                        </div>
                    </div>
                    <div class="col-lg-offset-1 col-md-offset-1 col-lg-10 col-md-10 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="message">Mensagem </label>
                            <textarea name="message" id="message" class="form-control" required="required" rows="6"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-offset-1 col-md-offset-1 col-lg-5 col-md-5 col-sm-12 col-xs-12">
                        <button type="submit" class="btn btn-primary btn-block">Enviar</button>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                        <button type="reset" class="btn btn-default btn-block">Limpar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>