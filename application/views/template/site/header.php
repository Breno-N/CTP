<head>
    <meta charset="UTF-8">
    <title><?php echo ((isset($title) && $title) ? $title : '') ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="<?php echo ((isset($description) && $description) ? $description : '') ?>">
    <meta name="keywords" content="<?php echo ((isset($keywords) && $keywords) ? $keywords : '') ?>">
    
    <!-- mobile settings -->
    <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    
    <!-- WEB FONTS : use %7C instead of | (pipe) -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400%7CRaleway:300,400,500,600,700%7CLato:300,400,400italic,600,700" rel="stylesheet" type="text/css" />

    <!-- CORE CSS -->
    <link href="<?php echo base_url().'assets/site/plugins/bootstrap/css/bootstrap.min.css'?>" rel="stylesheet" type="text/css" />

    <!-- THEME CSS -->
    <link href="<?php echo base_url().'assets/site/css/essentials.css'?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url().'assets/site/css/layout.css" rel="stylesheet'?>" type="text/css" />
    
    <!-- PAGE LEVEL SCRIPTS -->
    <link href="<?php echo base_url().'assets/site/css/header-1.css'?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url().'assets/site/css/color_scheme/green.css'?>" rel="stylesheet" type="text/css" id="color_scheme" />
</head>