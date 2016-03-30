<!DOCTYPE html>
<!--[if IE 8]>			<html class="ie ie8"> <![endif]-->
<!--[if IE 9]>			<html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]>
<!-->	
<html lang="pt-br"> 
<!--<![endif]-->

    <?php echo $header; ?>

    <body class="smoothscroll enable-animation">
        
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