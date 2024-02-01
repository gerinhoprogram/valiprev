<?php 
$sistema = info_header_footer();
?>
<section class="featured section-padding">
    <div class="container">
        <div class="row">

            <?php if($destaque) :?>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
                
                    <div class="featured-box">
                        <figure class="text-center mb-3">
                            <a href="<?= base_url('detalhes/'.$destaque->artigo_url) ?>" class="img-box" >
                                    <img class="img-box-background artigo-destaque" src="<?= base_url('uploads/artigos/'.$destaque->foto_nome) ?>" alt="<?= $destaque->artigo_titulo ?>" title="<?= $destaque->artigo_titulo ?>"></a>
                        </figure>
                        
                            <a href="<?= base_url('detalhes/'.$destaque->artigo_url) ?>">
                                <h2 class="p-4">
                                    <?= $destaque->artigo_titulo ?>
                                </h2>
                            </a>
                            
                    </div>
            </div>
            <?php endif ?>

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                <div class="featured-box p-3">
                    <?php if($artigos) :?>
                    <?php foreach($artigos as $colunas) :?>
                        <a href="<?= base_url('detalhes/').$colunas->artigo_url ?>">
                            <div class="mb-3 mt-3 pl-3 colunas">
                            <p class="titulo-artigo">
                            <?= $colunas->artigo_titulo ?><br>
                            </p>
                            <p>
                            <small>Por <b><?= $colunas->first_name ?></b>
                            em <?= formata_data_banco_sem_hora($colunas->artigo_data_criacao) ?> | Tempo de leitura: <?=$colunas->artigo_tempo_leitura?>
                            </small>
                            </p>
                            </div>
                        </a>
                    <?php endforeach ?>
                    <?php endif ?>
                </div>
            </div>
        </div>
        <div class="row">

        <?php if($artigos_linha) :?>
        <?php foreach ($artigos_linha as $artigo) : ?>

            <?php $descricao_limpa = strip_tags(html_entity_decode($artigo->artigo_descricao)) ?>

            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4">
                <div class="featured-box border rounded artigos-linha">

                    <a href="<?= base_url('detalhes/' . $artigo->artigo_url) ?>" class="img-box">
                        <figure>
                            <img src="<?= base_url('uploads/artigos/' . $artigo->foto_nome) ?>" class="img-box-background" alt="<?=$artigo->artigo_titulo?>" title="<?=$artigo->artigo_titulo?>">
                        </figure>
                    </a>
                    <div class="feature-content mt-0">
                        <div class="mb-2">
                            <small><?= $artigo->categoria_pai_nome ?></small>

                        </div>

                        <a href="<?= base_url('detalhes/' . $artigo->artigo_url) ?>">
                            <p class="titulo-artigo"><strong><?= $artigo->artigo_titulo ?></strong></p>
                        </a>

                        <p class="dsc">
                            <?= character_limiter($descricao_limpa, 70) ?>
                        </p>

                        <div class="meta-tag mb-4">
                            <small>Por <b><?= $artigo->first_name ?></b>
                            em <?= formata_data_banco_sem_hora($artigo->artigo_data_criacao) ?> | Tempo de leitura: <?=$artigo->artigo_tempo_leitura?>
                            </small>
                        </div>
                        <a href="detalhes/<?= $artigo->artigo_url ?>" targe="_parent" class="btn btn-common btn-veja-mais float-right">
                            Veja +
                            </a>
                    </div>
                </div>
            </div>

        <?php endforeach ?>
        <?php endif ?>
        </div>
    </div>
</section>