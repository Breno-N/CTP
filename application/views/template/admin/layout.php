<!DOCTYPE HTML>
<html lang="pt-br">
    
    <?php echo $header; ?>
    
    <body>
        <!-- WRAPPER -->
        <div id="wrapper" class="clearfix">
            
            <!-- NAVBAR -->
            <?php echo $navbar; ?>
            <!-- /NAVBAR -->
            
            <!-- MIDDLE  -->
            <?php echo $content; ?>
            <!-- /MIDDLE  -->
            
        </div>
        
        <!-- JAVASCRIPT FILES -->
        <script type="text/javascript">var plugin_path = '<?php echo base_url().'assets/admin/plugins/' ?>';</script>
        <script type="text/javascript" src="<?php echo base_url().'assets/admin/plugins/jquery/jquery-2.1.4.min.js'?>"></script>
        <script type="text/javascript" src="<?php echo base_url().'assets/admin/js/app.min.js'?>"></script>
        
        <!-- PAGE LEVEL SCRIPTS -->
        <?php foreach ($js as $script) { echo $script; } ?>
        
    </body>
</html>