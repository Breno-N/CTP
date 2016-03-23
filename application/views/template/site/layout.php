<!DOCTYPE html>
<!--[if IE 8]>			<html class="ie ie8"> <![endif]-->
<!--[if IE 9]>			<html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]>
<!-->	
<html lang="pt-br"> 
<!--<![endif]-->

    <?php echo $header; ?>

    <body class="smoothscroll enable-animation">
        
        <!-- SLIDE TOP -->
        <div id="slidetop">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <h6><i class="icon-heart"></i> WHY SMARTY?</h6>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas metus nulla, commodo a sodales sed, dignissim pretium nunc. Nam et lacus neque. Ut enim massa, sodales tempor convallis et, iaculis ac massa. </p>
                    </div>
                    <div class="col-md-4">
                        <h6><i class="icon-attachment"></i> RECENTLY VISITED</h6>
                        <ul class="list-unstyled">
                            <li>Consectetur adipiscing elit amet</li>
                            <li>This is a very long text, very very very very very very</li>
                            <li>Lorem ipsum dolor sit amet</li>
                            <li>Dolor sit amet,consectetur adipiscing elit amet</li>
                            <li>Consectetur adipiscing elit amet,consectetur adipiscing elit</li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h6><i class="icon-envelope"></i> CONTACT INFO</h6>
                        <ul class="list-unstyled">
                            <li><b>Address:</b> Av. Deputado João Leopoldo Jacomel 33, <br />Braga, São José dos Pinhais - Paraná - Brasil</li>
                            <li><b>Telefone:</b> (41)-3355-6688</li>
                            <li><b>Email:</b> <a href="mailto:contatoctpgroup@gmail.com">contatoctpgroup@gmail.com</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <a class="slidetop-toggle" href="#"><!-- toggle button --></a>
        </div>
        <!-- /SLIDE TOP -->
        
        <div id="wrapper">
            <!-- NAVBAR -->
            <?php echo $navbar; ?>
            <!-- /NAVBAR -->
            
             <!-- CONTENT -->
            <?php echo $content; ?>
            <!-- /CONTENT -->
            
            <!-- FOOTER -->
            <?php echo $footer; ?>
            <!-- /FOOTER -->
            
        </div>
        
        <!-- SCROLL TO TOP -->
        <a href="#" id="toTop"></a>
        
        <!-- JAVASCRIPT FILES -->
        <script type="text/javascript">var plugin_path ='<?php echo base_url().'assets/site/plugins/' ?>';</script>
        <script type="text/javascript" src="<?php echo base_url().'assets/site/plugins/jquery/jquery-2.1.4.min.js'?>"></script>
        <script type="text/javascript" src="<?php echo base_url().'assets/site/js/scripts.js'?>"></script>
        
        <!-- PAGE LEVEL SCRIPTS -->
        <?php foreach ($js as $script) { echo $script; } ?>
        
    </body>
</html>