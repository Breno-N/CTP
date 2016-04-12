<footer id="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <img class="footer-logo" src="<?php echo base_url().'assets/site/images/logo-footer.png'?>"  alt="Logo - Faz que Falta" title="Logo - Faz que Falta" />
                <address>
                    <ul class="list-unstyled">
                        <li class="footer-sprite address">
                            São José dos Pinhais - Paraná - Brasil
                        </li>
                    </ul>
                    <hr />
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="clearfix">
                                <h5 class="margin-bottom-10 letter-spacing-1">Acompanhe o nosso sonho e vem com a gente!</h5>
                                <a href="#" class="social-icon social-icon-sm social-icon-transparent social-gplus pull-left" data-toggle="tooltip" data-placement="top" title="Google plus">
                                    <i class="icon-gplus"></i>
                                    <i class="icon-gplus"></i>
                                </a>
                                <a href="https://www.facebook.com/fazquefalta" class="social-icon social-icon-sm social-icon-transparent social-facebook pull-left" data-toggle="tooltip" data-placement="top" title="Facebook">
                                    <i class="icon-facebook"></i>
                                    <i class="icon-facebook"></i>
                                </a>
                                <a href="#" class="social-icon social-icon-sm social-icon-transparent social-linkedin pull-left" data-toggle="tooltip" data-placement="top" title="Linkedin">
                                    <i class="icon-linkedin"></i>
                                    <i class="icon-linkedin"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </address>
            </div>
            <div class="col-md-4" id="contato">
                <h5 class="letter-spacing-1">Tem alguma dúvida? Conta pra gente!</h5>
                <form id="form-contact">
                    <input type="hidden" value="1" name="send_message">
                    <input required type="text" value="" class="form-control" name="name" id="name" placeholder="* Nome">
                    <input required type="email" value="" class="form-control" name="from" id="email" placeholder="* E-mail">
                    <input required type="text" value="" class="form-control" name="subject" id="subject" placeholder="* Assunto">
                    <textarea required maxlength="10000" rows="8" class="form-control" name="message" id="message" placeholder="* Mensagem"></textarea>
                    <input type="submit" value="ENVIAR" class="btn btn-success" />
                </form>
                <div class="progress progress-send-mail">
                    <div class="progress-bar progress-bar-primary progress-bar-striped active" role="progressbar" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100" style="width: 75%">
                        <span>Enviando</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright">
        <div class="container">
            <ul class="list-inline inline-links mobile-block pull-right nomargin">
                <li><a href="<?php echo base_url().'home'; ?>">Home</a></li>
                <li><a href="<?php echo base_url().'negocios-abertos'; ?>">Negócios Já Abertos</a></li>
                <li><a href="<?php echo base_url().'quem-somos'; ?>">Quem Somos</a></li>
                <li><a href="<?php echo base_url().'acesso'; ?>">Login</a></li>
            </ul>
            &copy; Todos os Direitos Reservados, CTP GROUP
        </div>
    </div>
</footer>