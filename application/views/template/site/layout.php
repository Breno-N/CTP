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
        <script type="text/javascript" src="<?php echo base_url().'assets/site/js/scripts.min.js'?>"></script>
        
        <!-- PAGE LEVEL SCRIPTS -->
        <?php foreach ($js as $script) { echo $script; } ?>
        
        <!-- GOOGLE ANALYTICS -->
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-75979753-1', 'auto');
            ga('send', 'pageview');

        </script>
        
    </body>
</html>