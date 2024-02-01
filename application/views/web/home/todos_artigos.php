<?php 
    $todos_artigos = todos_artigos();
    $banner = banners_home();
    $categorias_pai = categorias_pai_sidebar();
    $get_all_seo = get_all_seo();
    $categorias_filhas = categorias_filhas() ?>
<div class="conteudo-artigos">

<?php if(info_header_footer()->sistema_categorias) :?>
    <section id="categories" class="mt-5">
        <p class="section-title">Categorias principais</p>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-12 col-xs-12">
                    <div id="categories-icon-slider" class="categories-wrapper owl-carousel owl-theme">
                        <?php foreach ($categorias_pai as $cat) : ?>
                            <div class="item">
                                <a href="<?= base_url('busca/master/') . $cat->categoria_pai_meta_link ?>" target="_parent">
                                    <div class="category-icon-item">
                                        <div class="icon-box">
                                            <div class="icon">
                                                <i class="<?= $cat->categoria_pai_classe_icone ?>"></i>
                                            </div>
                                            <p><?= $cat->categoria_pai_nome ?></p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif ?>
    
    <div class="main-container section-padding" id="lista_artigos">
        <div class="container">

            <div class="row">

                <div class="col-lg-9 col-md-12 col-xs-12 page-content">

                    <div class="adds-wrapper">
                        <div class="tab-content">
                            <div id="list-view" class="tab-pane fade active show bg-light">
                                <div class="row">
                                    <table class="table-home" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th class="nosort"><p class="widget-title ultimas">Últimas matérias</p></th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php if($todos_artigos) :?>
                                            <?php foreach ($todos_artigos as $artigo) : ?>

                                                <?php $descricao_limpa = strip_tags(html_entity_decode($artigo->artigo_descricao)) ?>

                                                <tr class="mb-5">
                                                    <td>

                                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                            <div class="featured-box artigos">
                                                                <figure class="text-center">
                                                                    <a target="_parent" href="<?= base_url('detalhes/' . $artigo->artigo_url) ?>" class="img-box">
                                                                        <img class="img-box-background" sty src="<?= base_url('uploads/artigos/' . $artigo->foto_nome) ?>" alt="<?= $artigo->artigo_titulo ?>" title="<?= $artigo->artigo_titulo ?>"></a>
                                                                </figure>
                                                                <div class="feature-content">
                                                                    <div class="product">
                                                                        <a target="_parent" href="<?= base_url('busca/master/' . $artigo->categoria_pai_meta_link) ?>">
                                                                            <?= $artigo->categoria_pai_nome ?>
                                                                        </a>

                                                                    </div>
                                                                    <a target="_parent" href="<?= base_url('detalhes/' . $artigo->artigo_url) ?>"><p class="titulo-artigo"><strong><?= $artigo->artigo_titulo ?></strong></p></a>
                                                                    
                                                                    <p class="dsc mb-2 mt-2">
                                                                        <?= character_limiter($descricao_limpa, 100) ?>
                                                                        <br>
                                                                        <small>                                                                            
                                                                            Por: <b><?= $artigo->first_name ?></b>
                                                                            em <?= formata_data_banco_sem_hora($artigo->artigo_data_criacao) ?> | 
                                                                            <?= $artigo->artigo_tempo_leitura ?> de leitura
                                                                        </small>

                                                                    </p>                                                                  

                                                                </div>
                                                            </div>
                                                        </div>

                                                    </td>

                                                </tr>
                                            <?php endforeach ?>
                                            <?php endif ?>
                                        </tbody>

                                    </table>

                                </div>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="col-lg-3 col-md-12 col-xs-12 page-sidebar mt-4">
                    <aside>

                        <?php if($categorias_filhas) :?>
                        <div class="widget categories bg-white categorias_filhas">
                            <p class="widget-title">Outras categorias</p>
                            <ul class="categories-list">
                                <?php foreach ($categorias_filhas as $categoria) : ?>
                                    <li>
                                        <a href="<?= base_url('busca/categoria/' . $categoria->categoria_meta_link) ?>" target="_parent">
                                        
                                        <i class="<?= $categoria->categoria_pai_classe_icone ?>"></i>&nbsp; <?= $categoria->categoria_nome ?>
                                        </a>
                                    </li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                        <?php endif ?>

                        <?php if ($banner) : ?>
                            <div class="widget">
                                <a href="<?= $banner->banner_url ?>" target="_blank" rel="noopener noreferrer">
                                    <img class="banner-artigos" src="<?= base_url('uploads/banners_site/' . $banner->banner_imagem) ?>" alt="<?= $banner->banner_imagem ?>">
                                </a>
                            </div>
                        <?php endif ?>

                        <?php if($get_all_seo) : ?>
                        <div class="widget categories bg-white">
                            <p class="widget-title">Mural de tags</p>
                            <div class="p-2 text-center">
                                <?php foreach ($get_all_seo as $palavra) : ?>
                                    <a class="badge p-1 mb-1 tags" target="_parent" href="<?= base_url('busca/tags/' . $palavra->seo_url) ?>">
                                        #<?= $palavra->seo_palavra ?>
                                    </a>
                                <?php endforeach ?>
                            </div>
                        </div>
                        <?php endif ?>

                        

                    </aside>
                </div>

            </div>
        </div>
    </div>

</div>