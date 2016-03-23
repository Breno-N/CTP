<section id="middle">
    <header id="page-header">
        <h1 class="margin-bottom-20"> Usuários </h1>
        <?php echo $breadcrumbs; ?>
    </header>
    
    <div id="content" class="padding-20">
        <div class="page-profile">
            <div class="row">
                <div class="col-md-4 col-lg-3">
                    <section class="panel">
                        <div class="panel-body noradius padding-10">
                            
                            <figure class="margin-bottom-10">
                                <img class="img-responsive" src="<?php echo base_url().'assets/admin/images/demo/9_full.jpg'; ?>" alt="<?php echo $item->name; ?>" />
                            </figure>

                            <hr class="half-margins" />

                            <h3 class="text-black">
                                <?php echo $item->name; ?>
                                <small class="text-gray size-14"> / <?php echo $item->type_user; ?></small>
                            </h3>
                            <p class="size-12">
                                E-mail: 
                                <?php if(isset($item->email)): ?>
                                    <?php echo $item->email; ?>
                                <?php endif; ?>
                                <br>
                                <br>
                                CPF: 
                                <?php if(isset($item->cpf)): ?>
                                    <?php echo $item->cpf; ?>
                                <?php endif; ?>
                                <br>
                                <br>
                                Endereço: 
                                <?php if(isset($item->id_address)): ?>
                                    <?php echo $item->id_address.' - '.$item->state.' - '.$item->city.' - '.$item->neighborhood.' - '.$item->street ; ?>
                                <?php endif; ?>
                            </p>
                            
                        </div>
                    </section>
                </div>
                
                <div class="col-md-8 col-lg-6">
                    <div class="tabs white nomargin-top">
                        <div class="tab-content">
                            <div id="edit" class="tab-pane active">
                                <form class="form-horizontal" method="post">
                                    
                                    <h4>Informação Pessoal</h4>
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="name">Nome</label>
                                            <div class="col-md-8">
                                                <input type="text" name="name" id="name" class="form-control" value="<?php echo set_value('name', (isset($item->name) && $item->name) ? $item->name : '') ?>" required="required"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="age">Idade</label>
                                            <div class="col-md-8">
                                                <input type="text" name="age" id="age" min="18" max="999" class="form-control stepper" value="<?php echo set_value('age', (isset($item->age) && $item->age) ? $item->age : '') ?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="genre">Sexo</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control pointer" id="genre" value="<?php echo ((isset($item->genre) && $item->genre) ? $item->genre : '' )?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="phone">Telefone</label>
                                            <div class="col-md-8">
                                                <input type="text" name="phone" id="phone" class="form-control masked" data-format="(99)9999-99999" data-placeholder="X" value="<?php echo set_value('phone', (isset($item->phone) && $item->phone) ? $item->phone : '') ?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="sky-form">
                                                <label class="col-md-3 control-label">Foto</label>
                                                <div class="col-md-8">
                                                    <label for="file" class="input input-file">
                                                        <div class="button">
                                                            <input type="file" id="file" onchange="this.parentNode.nextSibling.value = this.value">Imagem
                                                        </div>
                                                        <input type="text" readonly>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    
                                    <hr />
                                    <h4>Trocar Senha</h4>
                                    <fieldset class="mb-xl">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="password">Nova Senha</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" id="password">
                                            </div>
                                        </div>
                                    </fieldset>
                                    
                                    <div class="row">
                                        <div class="col-md-9 col-md-offset-3">
                                            <button type="submit" class="btn btn-success btn-3d">Salvar</button>
                                            <button type="reset" class="btn btn-default btn-3d">Limpar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</section>
