<head>
    <meta charset="UTF-8">
    <title><?php echo ((isset($title) && $title) ? $title : '') ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="<?php echo ((isset($description) && $description) ? $description : '') ?>">
    <meta name="keywords" content="<?php echo ((isset($keywords) && $keywords) ? $keywords : '') ?>">
    <!-- mobile settings -->
    <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <link href="<?php echo base_url().'assets/images/favicon.ico'; ?>" rel="shortcut icon" type="image/x-icon" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400%7CRaleway:300,400,500,600,700%7CLato:300,400,400italic,600,700" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url().'assets/css/style_admin.min.css'?>" rel="stylesheet" type="text/css" />
    
    <?php if(FALSE):?>
    <!-- CORE CSS -->
    <link href="<?php echo base_url().'assets/plugins/bootstrap/css/bootstrap.min.css'?>" rel="stylesheet" type="text/css" />

     THEME CSS 
    <link href="<?php echo base_url().'assets/css/admin/essentials.min.css'?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url().'assets/css/admin/layout.min.css'?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url().'assets/css/admin/layout-datatables.min.css'?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url().'assets/css/admin/color_scheme/green.min.css'?>" rel="stylesheet" type="text/css" id="color_scheme" />
    <?php endif;?>
    
</head>