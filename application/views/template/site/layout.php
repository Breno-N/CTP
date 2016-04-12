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
            <?php echo $navbar; ?>
            <?php echo $content; ?>
            <?php echo $footer; ?>
        </div>
        <a href="#" id="toTop"></a>
        <script type="text/javascript">var plugin_path ='<?php echo base_url().'assets/site/plugins/' ?>'; var url_default = '<?php echo base_url(); ?>'</script>
        <script type="text/javascript" src="<?php  echo base_url().'assets/site/js/script.min.js'?>"></script>
    </body>
</html>