<div class="navbar" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>
    <div class="navbar-collapse collapse sidebar-navbar-collapse">
        <div id="img-user" class="text-center">
            <a href="<?php echo base_url().'admin/usuarios/editar/'.$this->session->userdata['id']; ?>" alt="avatar do usuario">
                <img class="img-circle" src="<?php echo base_url().'assets/images/user.jpg'; ?>" title="avatar do usuario">
            </a>
            <br>
            <span class="title-user">Usuario: <?php echo $this->session->userdata['name']; ?></span>
        </div>
        <ul class="nav nav-pills nav-stacked menu">
            <span class="menu-title">Principal</span>
            <li role="presentation" class="menu-body">
                <a href="<?php echo base_url(); ?>">
                    <span class="glyphicon glyphicon-home" aria-hidden="true"></span> Site
                </a>
            </li>
            <li role="presentation" class="menu-body">
                <a href="<?php echo base_url().'admin/painel/'; ?>">
                    <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Painel
                </a>
            </li>
            <li role="presentation" class="menu-body">
                <a href="<?php echo base_url().'admin/pedidos/'; ?>">
                    <span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span> Pedidos
                </a>
            </li>
            <li role="presentation" class="menu-body">
                <a href="<?php echo base_url().'login/logoff'; ?>">
                    <span class="glyphicon glyphicon-off" aria-hidden="true"></span> Sair
                </a>
            </li>
        </ul>
        <?php if($this->session->userdata['admin']): ?>
            <ul class="nav nav-pills nav-stacked menu">Administrativo
                <li role="presentation">
                    <a href="<?php echo base_url().'admin/usuarios/'; ?>">
                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span> Usuários
                    </a>
                </li>
                <li role="presentation">
                    <a href="<?php echo base_url().'admin/bairros/'; ?>">
                        <span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> Bairros
                    </a>
                </li>
                <li role="presentation">
                    <a href="<?php echo base_url().'admin/negocios/'; ?>">
                        <span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span> Negócios
                    </a>
                </li>
                <li role="presentation">
                    <a href="<?php echo base_url().'admin/noticias/'; ?>">
                        <span class="glyphicon glyphicon-book" aria-hidden="true"></span> Noticias
                    </a>
                </li>
                <li role="presentation">
                    <a href="<?php echo base_url().'admin/tipos_usuarios/'; ?>">
                        <span class="glyphicon glyphicon-tags" aria-hidden="true"></span> Tipos de Usuários
                    </a>
                </li>
                <li role="presentation">
                    <a href="<?php echo base_url().'admin/tipos_negocios/'; ?>">
                        <span class="glyphicon glyphicon-tags" aria-hidden="true"></span> Tipos de Negócios
                    </a>
                </li>
                <li role="presentation">
                    <a href="<?php echo base_url().'admin/tipos_noticias/'; ?>">
                        <span class="glyphicon glyphicon-tags" aria-hidden="true"></span> Tipos de Notícias
                    </a>
                </li>
                <li role="presentation">
                    <a href="<?php echo base_url().'admin/tipos_status_requisicoes/'; ?>">
                        <span class="glyphicon glyphicon-tags" aria-hidden="true"></span> Tipos de Status de Pedidos
                    </a>
                </li>
            </ul>
        <?php endif; ?>
    </div><!--/.nav-collapse -->
</div><!--/.nav-default -->