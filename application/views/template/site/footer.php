<footer id="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <img class="footer-logo" src="<?php echo base_url().'assets/images/logo-footer.png'?>"  alt="Logo - Faz que Falta" title="Logo - Faz que Falta" />
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
                                <a href="http://www.google.com/+FazquefaltaBrctp" target="_blank" class="social-icon social-icon-sm social-icon-transparent social-gplus pull-left" data-toggle="tooltip" data-placement="top" title="Google plus">
                                    <i class="icon-gplus"></i>
                                    <i class="icon-gplus"></i>
                                </a>
                                <a href="https://www.facebook.com/fazquefalta" target="_blank" class="social-icon social-icon-sm social-icon-transparent social-facebook pull-left" data-toggle="tooltip" data-placement="top" title="Facebook">
                                    <i class="icon-facebook"></i>
                                    <i class="icon-facebook"></i>
                                </a>
                                <a href="https://www.linkedin.com/in/fazquefalta" target="_blank" class="social-icon social-icon-sm social-icon-transparent social-linkedin pull-left" data-toggle="tooltip" data-placement="top" title="Linkedin">
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
                    <input type="submit" value="ENVIAR" id="send-mail" class="btn btn-3d btn-teal btn-block" />
                </form>
                <div class="progress progress-send-mail">
                    <div class="progress-bar progress-bar-primary progress-bar-striped active" role="progressbar" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100" style="width: 75%">
                        <span>Enviando</span>
                    </div>
                </div>
            </div>
        </div>
        <?php if(FALSE): ?>
        <div class="row">
            <div class="col-md-12 pull-right">
                <!--- DO NOT EDIT - GlobalSign SSL Site Seal Code - DO NOT EDIT --->
                <table width=125 border=0 cellspacing=0 cellpadding=0 title="CLICK TO VERIFY: This site uses a GlobalSign SSL Certificate to secure your personal information." >
                    <tr>
                        <td>
                            <span id="ss_img_wrapper_gmogs_image_90-35_en_dblue">
                                <a href="https://www.globalsign.com/" target=_blank title="GlobalSign Site Seal" rel="nofollow">
                                    <img alt="SSL" border=0 id="ss_img" src="//seal.globalsign.com/SiteSeal/images/gs_noscript_90-35_en.gif">
                                </a>
                            </span>
                            <script type="text/javascript" src="//seal.globalsign.com/SiteSeal/gmogs_image_90-35_en_dblue.js"></script>
                        </td>
                    </tr>
                </table>
                <!--- DO NOT EDIT - GlobalSign SSL Site Seal Code - DO NOT EDIT --->
            </div>
        </div>
        <?php endif; ?>
    </div>
    <div class="copyright">
        <div class="container">
            <ul class="list-inline inline-links mobile-block pull-right nomargin">
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
                <li><a href="<?php echo base_url().'negocios-abertos'; ?>">Negócios Já Abertos</a></li>
                <li><a href="<?php echo base_url().'quem-somos'; ?>">Quem Somos</a></li>
                <li><a href="<?php echo base_url().'login'; ?>">Login</a></li>
            </ul>
            &copy; Todos os Direitos Reservados, CTP GROUP
        </div>
    </div>
</footer>