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
                        <li>
                            <p class="margin-bottom-0">Horário de Atendimento</p><br>
                            <p>
                                <span class="block"><strong>Segunda - Sexta:</strong> 08:00 as 18:00</span><br>
                                <span class="block"><strong>Sabádo e Domingo:</strong> Fechado </span>
                            </p>
                        </li>
                    </ul>
                </address>
                <hr />
                <div class="row">
                    <div class="col-md-6 col-sm-6 hidden-xs">
                        <div class="clearfix">
                            <p class="margin-bottom-10">Acompanhe o nosso sonho e vem com a gente!</p>
                            <a href="#" class="social-icon social-icon-sm social-icon-transparent social-facebook pull-left" data-toggle="tooltip" data-placement="top" title="Facebook">
                                <i class="icon-facebook"></i>
                                <i class="icon-facebook"></i>
                            </a>
                            <a href="#" class="social-icon social-icon-sm social-icon-transparent social-gplus pull-left" data-toggle="tooltip" data-placement="top" title="Google plus">
                                <i class="icon-gplus"></i>
                                <i class="icon-gplus"></i>
                            </a>
                            <a href="#" class="social-icon social-icon-sm social-icon-transparent social-linkedin pull-left" data-toggle="tooltip" data-placement="top" title="Linkedin">
                                <i class="icon-linkedin"></i>
                                <i class="icon-linkedin"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4" id="contato">
                <h4 class="letter-spacing-1">Tem alguma dúvida? Conta pra gente!</h4>
                <form id="form-contact">
                    <input type="hidden" value="1" name="send_message">
                    <input required type="text" value="" class="form-control" name="name" id="name" placeholder="* Nome">
                    <input required type="email" value="" class="form-control" name="from" id="email" placeholder="* E-mail">
                    <input required type="text" value="" class="form-control" name="subject" id="subject" placeholder="* Assunto">
                    <textarea required maxlength="10000" rows="8" class="form-control" name="message" id="message" placeholder="* Mensagem"></textarea>
                    <input type="submit" value="ENVIAR" class="btn btn-success" />
                </form>
            </div>
        </div>
    </div>
    <div class="copyright">
        <div class="container">
            <ul class="list-inline inline-links mobile-block pull-right nomargin">
                <li><a href="<?php echo base_url().'home'; ?>">Home</a></li>
                <li><a href="<?php echo base_url().'negocios_abertos'; ?>">Negócios Já Abertos</a></li>
                <li><a href="<?php echo base_url().'quem_somos'; ?>">Quem Somos</a></li>
                <li><a href="<?php echo base_url().'acesso'; ?>">Login</a></li>
            </ul>
            &copy; Todos os Direitos Reservados, CTP GROUP
        </div>
    </div>
</footer>