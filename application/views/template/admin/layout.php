<!DOCTYPE HTML>
<html lang="pt-br">
    <?php echo $header; ?>
    <body>
        <div id="wrapper" class="clearfix">
            <?php echo $navbar; ?>
            <?php echo $content; ?>
        </div>
        <script type="text/javascript"> var plugin_path = '<?php echo base_url().'assets/admin/plugins/' ?>'; var url_default = '<?php echo base_url(); ?>'; window.page_action = '<?php echo (strstr($_SERVER['HTTP_HOST'], 'localhost') ? '/ctp/'.uri_string().'/' : '/'.uri_string().'/'); ?>'; </script>
        <!--<script type="text/javascript" src="<?php //echo base_url().'assets/admin/js/script.min.js'?>"></script>-->
        
        <script type="text/javascript" src="<?php echo base_url().'assets/admin/plugins/jquery/jquery-2.1.4.min.js'?>"></script>
        <script type="text/javascript" src="<?php echo base_url().'assets/admin/js/app.min.js'?>"></script>
        <script type="text/javascript" src="<?php echo base_url().'assets/admin/js/script.min.js'?>"></script>
        
    </body>
</html>