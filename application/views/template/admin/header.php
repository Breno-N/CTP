<head>
    <title><?php echo ((isset($title) && $title) ? $title : '') ?></title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo ((isset($description) && $description) ? $description : '') ?>">
    <meta name="keywords" content="<?php echo ((isset($keywords) && $keywords) ? $keywords : '') ?>">
    <link rel="stylesheet" href="<?php echo base_url().'assets/css/bootstrap/bootstrap.min.css'; ?>">
    <link rel="stylesheet" href="<?php echo base_url().'assets/css/style.css'; ?>">
    <script src="<?php echo base_url().'assets/js/bootstrap/jquery.js'; ?>"></script>
    <script src="<?php echo base_url().'assets/js/bootstrap/bootstrap.js'; ?>"></script>
    <?php echo implode(PHP_EOL, $includes); ?>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>