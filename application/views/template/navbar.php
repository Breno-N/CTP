<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="home">FAZ FALTA!</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a href="#">Negócios Já Abertos</a>
                </li>
                <li>
                    <a href="#">Notícias</a>
                </li>
                <li>
                    <a href="#">Quem Somos</a>
                </li>
                <li>
                    <a href="#">Contato</a>
                </li>
            </ul>
            <form class="navbar-form navbar-left" role="search">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Cidade ou Estabelecimento">
                </div>
                <button type="submit" class="btn btn-default">Encontrar</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <?php if(isset($this->session->userdata['id']) && !empty($this->session->userdata['id'])): ?>
                    <li>
                        <a href="<?php echo base_url().'admin/painel'?>">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                            Painel
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url().'login/logoff'?>">
                            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                            Deslogar
                        </a>
                    </li>
                <?php else : ?>
                    <li>
                        <a href="<?php echo base_url().'login'?>">
                            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                            Logar
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav><!-- /nav-->