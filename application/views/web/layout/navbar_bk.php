<style>
    
    <?php if($pag_detalhe) :?>
        .banner-estatico{
            background: url(<?=base_url('uploads/categorias_pai/small/'.$artigo->categoria_pai_banner) ?>);
        background-size: cover; height: 45vh; background-position: center; background-repeat: no-repeat
        }
            
    <?php else :?>
        .banner-estatico{
            background: url(<?=base_url('uploads/sistema/capa/'.info_header_footer()->sistema_capa)?>);
        background-size: cover; height: 45vh; background-position: center; background-repeat: no-repeat;

        }
    <?php endif?>  
</style>
<header id="header-wrap">

    <div class="top-bar">
        <div class="container">
            <div class="row">
                <!-- fixed-top -->
                <div class="col-lg-4 col-md-5 col-xs-12 text-center pt-3">
                            
                    <a href="<?=base_url('/')?>" class="navbar-brand" targe="_parent"><img class="logo-topo" src="<?=base_url('uploads/sistema/logo/'.info_header_footer()->sistema_logo)?>" alt="<?=info_header_footer()->sistema_site_titulo?>"></a>
                            
                </div>
                <div class="col-lg-5 col-md-5 col-xs-12">
                    <nav class="navbar navbar-expand-lg">
                        <div class="container">

                            <!-- <div class="navbar-header">
                                <a href="<?=base_url('/')?>" class="navbar-brand" targe="_parent"><img class="logo-topo" src="<?=base_url('uploads/sistema/logo/'.info_header_footer()->sistema_logo)?>" alt="<?=info_header_footer()->sistema_site_titulo?>"></a>
                            </div> -->
                            <div class="collapse navbar-collapse" id="main-navbar">
                                <ul class="navbar-nav mr-auto w-100 justify-content-center">
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?=base_url('/')?>" target="_parent">
                                            Home
                                        </a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="<?=base_url('home/todos_artigos')?>" data-toggle="dropdown">
                                        Categorias
                                        </a>
                                        <div class="dropdown-menu">
                                            <?php foreach (categorias_pai_menu() as $menu) :?>
                                            <a class="dropdown-item" href="<?=base_url('busca/master/'.$menu->categoria_pai_meta_link)?>"><?=$menu->categoria_pai_nome?></a>
                                            <?php endforeach ?>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?=base_url('home/todos_artigos')?>" target="_parent">
                                            Artigos
                                        </a>
                                    </li>
                                </ul>

                            </div>
                        </div>

                    </nav>
                </div>

                <div class="col-lg-3 col-md-7 col-xs-12 pt-3">

                    <div class="row">
                        <div class="col-lg-2 col-md-7 col-xs-12 p-0">
                            <span id="revelar" class="btn btn-default"> <i class="lni lni-search-alt text-warning"></i></span>
                        </div>
                        <div class="sidebar" id="esconder">
                            <div class="col-lg-11 col-md-7 col-xs-12 p-0">
                                <div class="menu-collapse">
                                    <form class="search-form" method="post" action="<?php echo base_url('busca'); ?>">
                                        <div class="inputwithicon">
                                            <input type="text" id="busca" name="busca" title="Digite para pesquisar" class="form-control" placeholder="Pesquisar...">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-7 col-xs-12 p-0">
                            <div id="carregar"></div>
                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- carousel -->
    <?php if(info_header_footer()->carousel && banner_carousel() && $carousel_home) : ?>
    <div id="main-slide" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <?php foreach(banner_carousel() as $banner) :?>

            <div class="carousel-item <?=($banner->principal ? 'active' : '')?> ">
                <div class="filtro-carousel"></div>
                <img src="<?=base_url('uploads/sistema/carousel/'.$banner->banner)?>" alt="<?=info_header_footer()->sistema_site_titulo?>">
                <div class="carousel-caption d-md-block">
        
                    <h1 class="animated wow fadeInDown hero-heading" data-wow-delay=".4s">
                       <?=$banner->texto ? $banner->texto : ''?>
                    </h1>
            
                    <p class="animated wow fadeInUp hero-sub-heading" data-wow-delay=".6s">
                        <?=$banner->link ? "<a href='".$banner->link."' class='text-light' target='_blanck'>Acesse e veja mais</a>" : ''?>
                    </p>
                </div>
               
            </div>
          
            <?php endforeach ?>
        </div>
        <span class="carousel-control-prev" href="#main-slide" target="_parente" role="button" data-slide="prev">
            <span class="carousel-control" aria-hidden="true"><img src="<?=base_url('public/web/assets/img/left.png')?>" alt="Anterior" width="50"></span>
        </span>
        <span class="carousel-control-next" href="#main-slide" target="_parente" role="button" data-slide="next">
            <span class="carousel-control" aria-hidden="true"><img src="<?=base_url('public/web/assets/img/right.png')?>" alt="Próximo" width="50"></span>  
        </span>
    </div>
    <!-- fim carousel -->
    <?php else: ?>

        <!-- banner estático -->
        <div id="hero-area" class="banner-estatico">
            
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 text-center">
                            <div class="contents-ctg">
                            
                            </div>
                        </div>
                    </div>
                </div>
        </div>

    <?php endif ?>
    

    <!-- foto perfil -->
    <section id="categories">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12 col-xs-12">
                    <div class="item card-perfil">
                        <?php if($pag_detalhe) :?>
                        <div class="category-icon-item">
                            <div class="icon pt-4" style="background: #f8b415">
                                <img class="categorias" src="<?=base_url('uploads/icones/'.$artigo->categoria_pai_classe_icone)?>" alt="<?=$artigo->categoria_pai_nome?>" title="<?=$artigo->categoria_pai_nome?>">
                            </div>
                        </div>
                        <?php else :?>
                        <div class="category-icon-item">
                            <div class="icon">
                                <img class="perfil" src="<?=base_url('uploads/sistema/perfil/'.info_header_footer()->sistema_foto_perfil)?>" alt="<?=info_header_footer()->sistema_site_titulo?>" title="<?=info_header_footer()->sistema_site_titulo?>">
                            </div>
                        </div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

</header>
