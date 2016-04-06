<!-- CONTENT -->
<section>
    <div class="container">
        <div class="row">
            <?php if(validation_errors()): ?>
            <div class="col-md-12 col-sm-12">
                <div class="padding-20">
                    <div class="alert alert-danger">
                        <?php echo validation_errors(); ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <?php if(isset($info['message']) && !empty($info['message'])): ?>
            <div class="col-md-12 col-sm-12">
                <div class="padding-20">
                    <div class="alert alert-<?php echo ($info['error'] ? 'danger' : 'info'); ?>">
                        <?php echo $info['message']; ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <div class="col-md-9 col-sm-9">
                <h3>Formulário de Contato</h3>
                <form action="<?php echo $action; ?>" method="post">
                    <fieldset>
                        <input type="hidden" name="action" value="contact_send" />
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="name">Nome *</label>
                                    <input required type="text" value="" class="form-control" name="name" id="name">
                                </div>
                                <div class="col-md-6">
                                    <label for="email">E-mail *</label>
                                    <input required type="email" value="" class="form-control" name="email" id="email">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="subject">Assunto *</label>
                                    <input required type="text" value="" class="form-control" name="subject" id="subject">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="message">Mensagem *</label>
                                    <textarea required maxlength="10000" rows="8" class="form-control" name="message" id="message"></textarea>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Enviar Mensagem</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /FORM -->

            <!-- INFO -->
            <div class="col-md-3 col-sm-3">
                <h2>Venha nos visitar</h2>
                <p>
                    Lid est laborum dolo rumes fugats untras. Etharums ser quidem rerum facilis dolores nemis omnis fugats vitaes nemo minima rerums unsers sadips amets.
                </p>
                <hr />
                <p>
                    <span class="block"><strong><i class="fa fa-map-marker"></i> Endereço:</strong> Av. Deputado João Leopoldo Jacomel 33, São José dos Pinhais - PR - Brasil</span>
                    <span class="block"><strong><i class="fa fa-phone"></i> Telefone:</strong> (41)3355-6677</span>
                    <span class="block"><strong><i class="fa fa-envelope"></i> Email:</strong> <a href="mailto:contatoctpgroup@gmail.com">contatoctpgroup@gmail.com</a></span>
                </p>
                <hr />
                <h4 class="font300">Horário de Atendimento</h4>
                <p>
                    <span class="block"><strong>Segunda - Sexta:</strong> 08:00 as 18:00</span>
                    <span class="block"><strong>Sabádo e Domingo:</strong> Fechado </span>
                </p>
            </div>
            <!-- /INFO -->
        </div>
    </div>
</section>
<!-- /CONTENT -->