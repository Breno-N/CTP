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
    <link href="<?php echo base_url().'assets/css/style_site.min.css'?>" rel="stylesheet" type="text/css" />
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-75979753-1', 'auto');
        ga('send', 'pageview');
    </script>
</head>