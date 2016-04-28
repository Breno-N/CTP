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
            <div class="col-md-4 col-sm-5">
                <div class="toggle toggle-transparent toggle-accordion  toggle-noicon">
                    <div class="toggle active">
                        <label class="size-20"><i class="fa fa-lock"></i> Realizar Login</label>
                        <div class="toggle-content">
                            <div class="box-static box-border-top padding-30">
                                <form class="nomargin" method="post" action="<?php echo $action_login; ?>" autocomplete="off">
                                    <div class="clearfix">
                                        <div class="form-group">
                                            <input type="text" name="email" class="form-control" placeholder="Email" required="">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control" placeholder="Senha" required="">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <button class="btn btn-primary">LOGAR</button>
                                        </div>
                                    </div>
                                </form>
                                <hr />
                                <div class="text-center">
                                    <div class="margin-bottom-20">&ndash; OU &ndash;</div>
                                    <a href="<?php echo base_url().'login/social/google'; ?>" class="btn btn-block btn-social btn-google margin-top-10">
                                        <i class="fa fa-google"></i> Login com Google
                                    </a>
                                    <a href="<?php echo base_url().'login/social/facebook'; ?>" class="btn btn-block btn-social btn-facebook margin-top-10">
                                        <i class="fa fa-facebook"></i> Login com Facebook
                                    </a>
                                    <a href="<?php echo base_url().'login/social/linkedin'; ?>" class="btn btn-block btn-social btn-linkedin margin-top-10">
                                        <i class="fa fa-linkedin"></i> Login com Linkedin
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="toggle">
                        <label class="size-20"><i class="fa fa-question-circle"></i> Esqueci minha senha</label>
                        <div class="toggle-content">
                            <div class="box-static box-border-top padding-30">
                                <form class="nomargin" method="post" action="<?php echo $action_recover_pass; ?>" autocomplete="off">
                                    <div class="clearfix">
                                        <div class="form-group">
                                            <input type="text" name="email" class="form-control" placeholder="Email" required="">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6 ">
                                            <button class="btn btn-primary">REENVIAR SENHA</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-sm-7">
                <div class="toggle toggle-transparent toggle-noicon">
                    <div class="toggle active">
                        <label class="size-20"><i class="fa fa-user"></i> Criar conta</label>
                        <div class="toggle-content">
                            <form class="nomargin sky-form boxed" action="<?php echo $action_register; ?>" method="post">
                                <fieldset class="nomargin">					
                                    <label class="input margin-bottom-10">
                                        <i class="ico-append fa fa-user"></i>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="* Nome" required="">
                                        <b class="tooltip tooltip-bottom-right">Informe seu nome</b>
                                    </label>
                                    <label class="input margin-bottom-10">
                                        <i class="ico-append fa fa-envelope"></i>
                                        <input type="email" name="email" id="email" class="form-control" placeholder="* E-mail" required="">
                                        <b class="tooltip tooltip-bottom-right">Informe endereço de e-mail válido</b>
                                    </label>
                                    <label class="input margin-bottom-10">
                                        <i class="ico-append fa fa-lock"></i>
                                        <input type="password" name="password" id="password" class="form-control" placeholder="* Senha" required="">
                                        <b class="tooltip tooltip-bottom-right">Informe a senha </b>
                                    </label>
                                    <?php if(isset($this->session->userdata['pedido_session']) && !empty($this->session->userdata['pedido_session'])): ?>
                                    <label class="input margin-bottom-10">
                                        <i class="ico-append fa fa-lock"></i>
                                        <input type="text" name="cpf" id="cpf" class="form-control masked" data-format="999.999.999-99" placeholder="* CPF" required="">
                                        <b class="tooltip tooltip-bottom-right">Informe seu CPF (Somente numeros) </b>
                                    </label>
                                    <label class="input margin-bottom-10">
                                        <i class="ico-append fa fa-map-marker"></i>
                                        <input type="text" name="id_address" id="id-address" class="form-control masked" data-format="99999999" placeholder="* CEP" required="">
                                        <b class="tooltip tooltip-bottom-right">Informe seu CEP (Somente numeros) </b>
                                    </label>
                                    <div class="margin-top-30">
                                        <div id="address" class="alert alert-info softhide"></div>
                                    </div>
                                    <div class="margin-top-30">
                                        <div id="test-cpf" class="alert alert-warning softhide">CPF Inválido</div>
                                    </div>
                                    <?php endif; ?>
                                </fieldset>
                                <div class="row margin-bottom-20">
                                    <div class="col-md-12">
                                        <button type="submit" id="submit" class="btn btn-primary">CADASTRAR</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>