<?php $this->load->view('web/layout/navbar'); ?>

<div class="section-padding">
    <div class="container">

        <div class="product-info row">

            <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="mb-3 caminho">
                <a href="<?=base_url()?>" class=""><i class="fa fa-home"></i></a> / <a href="<?= base_url('busca/master/' . $artigo->categoria_pai_meta_link) ?>" class=""><?=$artigo->categoria_pai_nome?></a> 
                <?php foreach($categorias as $categoria) :?>
                    / <a href="<?= base_url('busca/categoria/' . $categoria->categoria_meta_link) ?>" class=""><?=$categoria->categoria_nome?></a>
                <?php endforeach ?>
                </div>
            </div>

            <div class="col-lg-9 col-md-12 col-xs-12">

                <div class="details-box bg-white mt-0">
                    <div class="ads-details-info artigo_descricao">


                        <h1 class="mb-3"><?= $artigo->artigo_titulo; ?></h1>
                        <?php if($artigo->artigo_legenda) :?>
                            <p class="mb-3 legenda"><?= $artigo->artigo_legenda ?></p>
                        <?php endif ?>
                        
                      
                        <small>Por: <?= $artigo->nome_anunciante ?> em <?= formata_data_banco_sem_hora($artigo->artigo_data_criacao); ?> | Tempo de leitura: <?= $artigo->artigo_tempo_leitura ?></small>
                        <br><br>
                        <p class="mb-5"><?= html_entity_decode($artigo->artigo_descricao) ?></p>
                    
                        <div id="owl-demo" class="owl-carousel owl-theme mt-5">

                            <?php foreach ($artigos_fotos as $foto) : ?>
                                <div class="item">
                                    <div class="product-img text-center">
                                        <img title="<?= $artigo->artigo_titulo; ?>" class="img-fluid" src="<?= base_url('uploads/artigos/' . $foto->foto_nome); ?>" alt="<?= $artigo->artigo_titulo; ?>">
                                    </div>
                                </div>
                            <?php endforeach; ?>

                        </div>
                    
                    </div>

                    <div class="tag-bottom compartilhe">
                        <p>Compartilhe</p>
                        <a class="badge p-1" href="https://www.facebook.com/sharer/sharer.php?u=<?= base_url('detalhes/' . $artigo->artigo_url) ?>" target="_blank" data-wpel-link="internal">
                            <i class="fab fa-facebook"></i>
                        </a>
                       
                        <a class="badge p-1" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?= base_url('detalhes/' . $artigo->artigo_url) ?>&amp;<?= $artigo->artigo_titulo ?>&amp;source=<?= base_url() ?>" target="_blank" data-wpel-link="internal">
                            <i class="fab fa-linkedin"></i>
                        </a>

                        <a class="badge p-1" href="https://api.whatsapp.com/send?text=<?= $artigo->artigo_titulo ?><?= base_url('detalhes/' . $artigo->artigo_url) ?>/?utm_source=<?= base_url() ?>&utm_medium=social_share&utm_content=whatsapp" target="_blank" data-wpel-link="external" rel="external noopener">
                            <i class="fab fa-whatsapp"></i>
                        </a>

                    </div>

                    <div class="tag-bottom">
                        <?php foreach ($tags_seo as $palavra) : ?>
                            <a class="badge p-1" href="<?= base_url('busca/tags/' . $palavra->seo_url) ?>">
                                #<?= $palavra->seo_palavra ?>
                            </a>
                        <?php endforeach ?>
                    </div>
                </div>

                <div class="ads-details-wrapper mt-4 mb-4 text-center">
                    <a href="<?=base_url()?>" class="btn btn-info btn-common"><i class="fas fa-chevron-left"></i> Voltar</a>
                </div>

            </div>

            <div class="col-lg-3 col-md-12 col-xs-12">

                <aside class="details-sidebar">

                    <?php if ($banners) : ?>

                        <?php foreach ($banners as $banner) : ?>
                            <div class="widget bg-white">
                               
                                    <img class="banner-cta-artigo" src="<?= base_url('uploads/banners_site/' . $banner->banner_imagem); ?>" alt="<?= $banner->banner_titulo; ?>">
                                
                            </div>
                        <?php endforeach ?>

                    <?php endif ?>

                    <?php if ($artigos_semelhantes) : ?>
                        <div class="widget bg-white">
                            <h4 class="widget-title">Veja também</h4>
                            <ul class="posts-list">
                                <?php foreach ($artigos_semelhantes as $semelhante) : ?>
                                    <li>
                                        <p><i class="fas fa-chevron-right"></i> <a href="<?= base_url('detalhes/' . $semelhante->artigo_url); ?>"><?= character_limiter($semelhante->artigo_titulo, 30) ?></a></p>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif ?>

                    <div class="widget bg-white">
                        <h4 class="widget-title">Artigos de <?= $artigo->nome_anunciante; ?></h4>
                        <ul class="posts-list">
                            <?php foreach ($todos_artigos_anunciante as $artigo) : ?>
                                <li>
                                    <p><i class="fas fa-chevron-right"></i> <a href="<?= base_url('detalhes/' . $artigo->artigo_url); ?>"><?= character_limiter($artigo->artigo_titulo, 30) ?></a></p>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </aside>

            </div>

        </div>

    </div>
</div>