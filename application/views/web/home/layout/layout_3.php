
<?php 
$sistema = info_header_footer();
$banners_home_primario = banners_home('home', 1);
$banners_home_secundario = banners_home('home', 2);
?>
<section class="featured section-padding">
    <div class="container">

        <div class="row">
        <div class="col-xs-3 col-sm-12 col-md-12 col-lg-3">
                <div class="featured-box border-right pl-2 pr-2 pt-2">
                    <?php foreach($artigos_coluna as $colunas) :?>
                    <a href="<?= base_url('detalhes/').$colunas->artigo_url ?>">
                        <h5 class="border-bottom pb-1 pt-2">
                            <?= $colunas->artigo_titulo ?>
                        </h5>
                    </a>
                    <?php endforeach ?>
                    <?php if($banners_home_primario) :?>
                    <a href="<?=$banners_home_primario[0]->banner_url?>">
                            <img src="<?= base_url('uploads/banners_site/'.$banners_home_primario[0]->banner_imagem)?>" alt="NCWBrasil" title="" style="height: 112px; width: 100%; object-fit: contain">
                            </a>
                    <?php endif ?>
                </div>

                <?php foreach($artigos_bonus as $bonus) : ?>

                <hr>
                <a href="detalhes/<?=$bonus->artigo_url?>">
                    <div class="p-2 bg-white">
                        <h5>
                            <?=character_limiter($bonus->artigo_descricao, 100);?>
                        </h5>
                        <small><?= formata_data_banco_sem_hora($bonus->artigo_data_criacao) ?></small>
                    </div>
                </a>

                <?php endforeach ?>
                <hr>
                <?php if($banners_home_secundario) :?>
                <a href="<?=$banners_home_secundario[0]->banner_url?>">
                            <img src="<?= base_url('uploads/banners_site/'.$banners_home_secundario[0]->banner_imagem)?>" alt="NCWBrasil" title="" style="height: 300px; width: 100%; object-fit: contain">
                            </a>
                <?php endif ?>
            </div>
            <div class="col-xs-6 col-sm-12 col-md-12 col-lg-6">
                <div class="row">
                    <?php foreach($artigos as $coluna) : ?>

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="featured-box">
                            <figure class="text-center">
                                <a href="<?= base_url('detalhes/'.$coluna->artigo_url) ?>" class="img-box">
                                    <img style="height: 200px; width: 100%; object-fit: cover" class="img-box-background" src="<?= base_url('uploads/artigos/'.$coluna->foto_nome) ?>" alt="<?= $coluna->artigo_titulo ?>" title="<?= $coluna->artigo_titulo ?>"></a>
                            </figure>
                            <div class="feature-content" style="width: 100%">
                                <div class="product">
                                    <a class="badge badge-info p-2 text-white" href="<?= base_url('busca/master/'.$coluna->categoria_pai_meta_link) ?>">
                                        <?= $coluna->categoria_pai_nome ?>
                                    </a>
                                </div>
                                <h4><a href="<?= base_url('detalhes/'.$coluna->artigo_url) ?>"><?= character_limiter($coluna->artigo_titulo, 30) ?></a></h4>
                                <div class="meta-tag">
                                    <span>
                                        Por: <a href="<?=base_url('busca/redatores/'.$coluna->user_url)?>"><?= $coluna->first_name ?></a>  | <?= formata_data_banco_sem_hora($coluna->artigo_data_criacao) ?> 
                                    </span>

                                </div>
                                <p class="dsc text-muted">
                                    <?= character_limiter($coluna->artigo_descricao, 80) ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <?php endforeach ?>
                </div>
            </div>
            <div class="col-xs-3 col-sm-12 col-md-12 col-lg-3">
                <div class="featured-box border-left pl-2 pr-2 pt-2">
                    <h5>Destaques</h5>
                    <?php foreach($artigos_destaque as $destaque) :?>
                        <div class="border-bottom p-2">
                            <small><?=$destaque->categoria_pai_nome?></small>
                            <a href="<?= base_url('detalhes/').$destaque->artigo_url ?>">
                            <h5 class="mb-1"><?= $destaque->artigo_titulo ?></h5>
                            </a>
                            <small><i class="lni lni-alarm-clock"></i> Tempo de leitura: <?=$destaque->artigo_tempo_leitura?></small>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
            
        </div>
    </div>
</section>