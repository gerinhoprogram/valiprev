<?php 
$sistema = info_header_footer();
$banners_home_primario = banners_home('home', 1);
$banners_home_secundario = banners_home('home', 2);
?>
<section class="cities bg-light section-padding">
    <div class="container">
        <h1 class="section-title">Blog</h1>
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                <a href="<?=base_url('detalhes/'.$artigos_layout_4[0]->artigo_url)?>" class="img-box">
                    <div class="img-box-content">
                        <small class="text-white"><i class="lni lni-alarm-clock"></i> <?=$artigos_layout_4[0]->artigo_tempo_leitura?> | 
                        <i class="lni lni-calendar"></i> <?= formata_data_banco_sem_hora($artigos_layout_4[0]->artigo_data_criacao) ?></small> 
                        <h4><?=$artigos_layout_4[0]->artigo_titulo?><br><small><?=$artigos_layout_4[0]->categoria_pai_nome?></small></h4>
                    </div>
                    <div class="img-box-background">
                        <img class="img-fluid" src="<?=base_url('uploads/artigos/'.$artigos_layout_4[0]->foto_nome)?>" alt="NCWBrasil">
                    </div>
                </a>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <a href="<?=base_url('detalhes/'.$artigos_layout_4[1]->artigo_url)?>" class="img-box">
                            <div class="img-box-content">
                            <small class="text-white"><i class="lni lni-alarm-clock"></i> <?=$artigos_layout_4[1]->artigo_tempo_leitura?> | 
                        <i class="lni lni-calendar"></i> <?= formata_data_banco_sem_hora($artigos_layout_4[1]->artigo_data_criacao) ?></small> 
                            <h4><?=$artigos_layout_4[1]->artigo_titulo?><br><small><?=$artigos_layout_4[1]->categoria_pai_nome?></small></h4>
                            </div>
                            <div class="img-box-background">
                                <img class="img-fluid" src="<?=base_url('uploads/artigos/'.$artigos_layout_4[1]->foto_nome)?>" alt="NCWBrasil">
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <a href="<?=base_url('detalhes/'.$artigos_layout_4[2]->artigo_url)?>" class="img-box">
                            <div class="img-box-content">
                            <small class="text-white"><i class="lni lni-alarm-clock"></i> <?=$artigos_layout_4[2]->artigo_tempo_leitura?> | 
                        <i class="lni lni-calendar"></i> <?= formata_data_banco_sem_hora($artigos_layout_4[2]->artigo_data_criacao) ?></small> 
                            <h4><?=$artigos_layout_4[2]->artigo_titulo?><br><small><?=$artigos_layout_4[2]->categoria_pai_nome?></small></h4>
                            </div>
                            <div class="img-box-background">
                                <img class="img-fluid" src="<?=base_url('uploads/artigos/'.$artigos_layout_4[2]->foto_nome)?>" alt="NCWBrasil">
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <a href="<?=base_url('detalhes/'.$artigos_layout_4[3]->artigo_url)?>" class="img-box">
                            <div class="img-box-content">
                            <small class="text-white"><i class="lni lni-alarm-clock"></i> <?=$artigos_layout_4[3]->artigo_tempo_leitura?> | 
                        <i class="lni lni-calendar"></i> <?= formata_data_banco_sem_hora($artigos_layout_4[3]->artigo_data_criacao) ?></small> 
                            <h4><?=$artigos_layout_4[3]->artigo_titulo?><br><small><?=$artigos_layout_4[3]->categoria_pai_nome?></small></h4>
                            </div>
                            <div class="img-box-background">
                                <img class="img-fluid" src="<?=base_url('uploads/artigos/'.$artigos_layout_4[3]->foto_nome)?>" alt="NCWBrasil">
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <a href="<?=base_url('detalhes/'.$artigos_layout_4[4]->artigo_url)?>" class="img-box">
                            <div class="img-box-content">
                            <small class="text-white"><i class="lni lni-alarm-clock"></i> <?=$artigos_layout_4[4]->artigo_tempo_leitura?> | 
                        <i class="lni lni-calendar"></i> <?= formata_data_banco_sem_hora($artigos_layout_4[4]->artigo_data_criacao) ?></small> 
                            <h4><?=$artigos_layout_4[4]->artigo_titulo?><br><small><?=$artigos_layout_4[4]->categoria_pai_nome?></small></h4>
                            </div>
                            <div class="img-box-background">
                                <img class="img-fluid" src="<?=base_url('uploads/artigos/'.$artigos_layout_4[4]->foto_nome)?>" alt="NCWBrasil">
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                <a href="<?=base_url('detalhes/'.$artigos_layout_4[5]->artigo_url)?>" class="img-box">
                    <div class="img-box-content">
                    <small class="text-white"><i class="lni lni-alarm-clock"></i> <?=$artigos_layout_4[5]->artigo_tempo_leitura?> | 
                        <i class="lni lni-calendar"></i> <?= formata_data_banco_sem_hora($artigos_layout_4[5]->artigo_data_criacao) ?></small> 
                    <h4><?=$artigos_layout_4[5]->artigo_titulo?><br><small><?=$artigos_layout_4[5]->categoria_pai_nome?></small></h4>
                    </div>
                    <div class="img-box-background">
                        <img class="img-fluid" src="<?=base_url('uploads/artigos/'.$artigos_layout_4[5]->foto_nome)?>" alt="NCWBrasil">
                    </div>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                <?php if($banners_home_primario) :?>
                <a href="<?=$banners_home_primario[0]->banner_url?>" class="img-box">
                    <div class="img-box-background">
                    <img src="<?= base_url('uploads/banners_site/'.$banners_home_primario[0]->banner_imagem)?>" alt="NCWBrasil" title="">      
                    </div>
                </a>
                <?php endif ?>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <?php if($banners_home_secundario) :?>
                        <a href="<?=$banners_home_secundario[0]->banner_url?>" class="img-box">
                            <div class="img-box-background">
                            <img src="<?= base_url('uploads/banners_site/'.$banners_home_secundario[0]->banner_imagem)?>" alt="NCWBrasil" title="">      
                            </div>
                        </a>
                        <?php endif ?>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="img-box-content">
                            <?php foreach($artigos_coluna as $colunas) :?>
                                <small><a href="<?=base_url('busca/master/'.$colunas->categoria_pai_meta_link)?>"><?=$colunas->categoria_pai_nome?></a> </small>
                                <a href="<?= base_url('detalhes/').$colunas->artigo_url ?>">
                                    <h5 class="border-bottom pb-1 mb-2">
                                        <?= $colunas->artigo_titulo ?>
                                    </h5>
                                </a>
                                <?php endforeach ?>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>