<header id="header-wrap">

    

    <div class="top-bar">
        <div class="container">
            <div class="row elemento-pai pt-3 pb-3">
                
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 pt-3  div-logo">

                    <a href="<?= base_url('/') ?>" targe="_parent">
                    <figure>
                    <img src="<?= base_url('uploads/sistema/logo/' . info_header_footer()->sistema_logo) ?>" alt="<?= info_header_footer()->sistema_site_titulo ?>">
                    </figure>    
                    </a>

                </div>

                <div class="col-lg-3 col-md-4 pesquisar-mb col-sm-6 col-xs-6 pt-3">
                    <div class="btn-group text-center" role="group" aria-label="Basic example">  
                        <button type="button" class="btn border bg-white pesquisar" data-toggle="modal" data-target=".bd-pesquisar-modal-lg"><i class="fa fa-search"></i>&nbsp; Pesquisar</button>
                    </div>
                </div>

                <div class="col-lg-6 col-md-4 col-sm-12">
                        <div class="navbar-header"></div>
                </div>

                <div class="col-lg-3 col-md-4 col-sm-12  pt-3 pesquisar-dk">

                    <div class="btn-group float-right" role="group" aria-label="Basic example">
                        
                        <button type="button" class="border bg-white pesquisar" data-toggle="modal" data-target=".bd-pesquisar-modal-lg"><i class="fa fa-search"></i></button>
                    </div>

                </div>
            </div>

	        <?php if(info_header_footer()->sistema_menu) :?>
                <div class="row mt-2">
                <div class="col-lg-12 col-md-12 col-xs-12">
                    <nav class="navbar navbar-expand-lg">
                        <div class="container">

                            <div class="collapse navbar-collapse" id="main-navbar">
                               
                                <ul class="navbar-nav w-100 mr-auto justify-content-center">
                                
                                    <?php foreach (categorias_pai_menu() as $menu) : ?>
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle text-center" href="<?= base_url('busca/master/'.$menu->categoria_pai_meta_link) ?>">
                                                   <?=$menu->categoria_pai_nome?>
                                                </a>
                                                <div class="dropdown-menu">
                                                    <?php foreach (categorias_filhas() as $sub) : ?>
                                                        <?php if($sub->categoria_pai_id == $menu->categoria_pai_id) :?>
                                                        <a class="dropdown-item" href="<?= base_url('busca/categoria/' . $sub->categoria_meta_link) ?>"><?= $sub->categoria_nome ?></a>
                                                        <?php endif ?>
                                                    <?php endforeach ?>
                                                </div>
                                            </li>
                                    <?php endforeach ?>
                                
                                </ul>

                            </div>
                        </div>

                                                
                        <ul class="mobile-menu">

                            <?php foreach (categorias_pai_menu() as $menu) : ?>
                                    <li>
                                        <a href="<?= base_url('busca/master/'.$menu->categoria_pai_meta_link) ?>">
                                            <?=$menu->categoria_pai_nome?> 
                                        </a>
                                        
                                        <ul class="dropdown">
                                            <?php foreach (categorias_filhas() as $sub) : ?>
                                                <?php if($sub->categoria_pai_id == $menu->categoria_pai_id) :?>
                                                <li>
                                                    <a href="<?= base_url('busca/categoria/' . $sub->categoria_meta_link) ?>"><?= $sub->categoria_nome ?></a>
                                                </li>
                                                <?php endif ?>
                                            <?php endforeach ?>
                                        </ul>
                                    </li>
                            <?php endforeach ?>

                        </ul>
                    </nav>
                    
                </div>
                </div>
              <?php endif ?> 
            
        </div>
    </div>

    

</header>