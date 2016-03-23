<!-- CONTENT -->
<section>
    <div class="container">
        <div id="map" class="height-300 margin-bottom-60"></div>
        <div class="row">
            <div class="col-md-9 col-sm-9">
                <h3>Formulário de Contato</h3>
                <div id="alert_success" class="alert alert-success margin-bottom-30">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Obrigado!</strong> Sua mensagem foi enviada com sucesso!
                </div>

                <div id="alert_failed" class="alert alert-danger margin-bottom-30">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>[SMTP] Erro!</strong> Erro interno do servidor!
                </div>

                <div id="alert_mandatory" class="alert alert-danger margin-bottom-30">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Erro!</strong> Os campos obrigatórios(*) devem ser preenchidos!
                </div>

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