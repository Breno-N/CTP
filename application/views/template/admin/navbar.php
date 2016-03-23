<aside id="aside">
    <nav id="sideNav">
        <ul class="nav nav-list">
            <li class="">
                <a class="dashboard" href="<?php echo base_url().'admin/painel/'; ?>">
                    <i class="main-icon fa fa-dashboard"></i> <span>Painel de Controle</span>
                </a>
            </li>
            <li>
                <a class="dashboard" href="<?php echo base_url().'admin/pedidos/'; ?>">
                    <i class="main-icon fa fa-comments-o"></i> <span>Pedidos</span>
                </a>
            </li>
            <li class="">
                <a class="dashboard" href="<?php echo base_url(); ?>">
                    <i class="main-icon fa fa-sitemap"></i> <span>Site</span>
                </a>
            </li>
            <?php if(isset($this->session->userdata['admin']) && $this->session->userdata['admin']): ?>
            <li>
                <a class="dashboard" href="<?php echo base_url().'admin/usuarios/'; ?>">
                    <i class="main-icon fa fa-users"></i> <span>Usuários</span>
                </a>
            </li>
            <li>
                <a class="dashboard" href="<?php echo base_url().'admin/negocios/'; ?>">
                    <i class="main-icon fa fa-briefcase"></i> <span>Negócios</span>
                </a>
            </li>
            <li>
                <a class="dashboard" href="<?php echo base_url().'admin/noticias/'; ?>">
                    <i class="main-icon fa fa-newspaper-o"></i> <span>Noticias</span>
                </a>
            </li>
            <li>
                <a href="#">
                <i class="fa fa-menu-arrow pull-right"></i>
                <i class="main-icon fa fa-tags"></i> <span>Tipos</span>
                </a>
                <ul>
                    <li>
                        <a class="dashboard" href="<?php echo base_url().'admin/tipos_usuarios/'; ?>">
                            <i class="main-icon fa fa-tag"></i> <span>Usuários</span>
                        </a>
                    </li>
                    <li>
                        <a class="dashboard" href="<?php echo base_url().'admin/tipos_negocios/'; ?>">
                            <i class="main-icon fa fa-tag"></i> <span>Negócios</span>
                        </a>
                    </li>
                    <li>
                        <a class="dashboard" href="<?php echo base_url().'admin/tipos_noticias/'; ?>">
                            <i class="main-icon fa fa-tag"></i> <span>Notícias</span>
                        </a>
                    </li>
                    <li>
                        <a class="dashboard" href="<?php echo base_url().'admin/tipos_status_requisicoes/'; ?>">
                            <i class="main-icon fa fa-tag"></i> <span>Status de Pedidos</span>
                        </a>
                    </li>
                </ul>
            </li>
            <?php endif; ?>
        </ul>
    </nav>
    <span id="asidebg"></span>
</aside>
<header id="header">
    <button id="mobileMenuBtn"></button>
    <span class="logo pull-left">
        <img src="<?php echo base_url().'/assets/admin/images/logo_light.png'?>" alt="admin panel" height="35" />
    </span>
    <nav>
        <ul class="nav pull-right">
            <li class="dropdown pull-left">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                    <img class="user-avatar" alt="" src="<?php echo base_url().'/assets/admin/images/noavatar.jpg'?>" height="34" /> 
                    <span class="user-name">
                        <span class="hidden-xs">
                            <?php echo (isset($this->session->userdata['name']) && !empty($this->session->userdata['name']) ? $this->session->userdata['name'] : ''); ?><i class="fa fa-angle-down"></i>
                        </span>
                    </span>
                </a>
                <ul class="dropdown-menu hold-on-click">
                    <li>
                        <a href="<?php echo base_url().'admin/usuarios/editar/'.(isset($this->session->userdata['id']) && $this->session->userdata['id'] ? $this->session->userdata['id'] : 0); ?>"><i class="fa fa-cogs"></i> Settings</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="<?php echo base_url().'acesso/logoff'; ?>"><i class="fa fa-power-off"></i> Log Out</a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</header>