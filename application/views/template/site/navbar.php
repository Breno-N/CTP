<div id="header" class="sticky clearfix">
    <header id="topNav">
        <div class="container">
            <button class="btn btn-mobile" data-toggle="collapse" data-target=".nav-main-collapse">
                <i class="fa fa-bars"></i>
            </button>
            <a class="logo pull-left" href="<?php echo base_url(); ?>">
                <img src="<?php echo base_url().'assets/site/images/logo_dark.png'?>" alt="" />
            </a>
            <div class="navbar-collapse pull-right nav-main-collapse collapse">
                <nav class="nav-main">
                    <ul id="topMain" class="nav nav-pills nav-main nav-onepage">
                        <li>
                            <a href="<?php echo base_url(); ?>">Home</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url().'negocios_abertos'; ?>">Negócios Já Abertos</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url().'sobre'; ?>">Quem Somos</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url().'contato'; ?>">Contato</a>
                        </li>
                        <?php if(isset($this->session->userdata['id']) && !empty($this->session->userdata['id'])): ?>
                            <li>
                                <a href="<?php echo base_url().'admin/painel'?>">
                                    <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                                    Painel
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url().'acesso/logoff'?>">
                                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                    Deslogar
                                </a>
                            </li>
                        <?php else : ?>
                            <li>
                                <a href="<?php echo base_url().'acesso'?>">
                                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                    Login
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
</div>