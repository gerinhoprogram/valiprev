<section class="featured section-padding">
    <div class="container">

        <div class="row">

            <?php foreach ($artigos as $artigo) : ?>

            <?php $descricao_limpa = strip_tags(html_entity_decode($artigo->artigo_descricao)) ?>

            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4">
                <div class="featured-box border rounded " style="position: relative">

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
                        <a href="busca/master/<?= $artigo->categoria_pai_meta_link ?>" targe="_parent" class="btn btn-common btn-veja-mais float-right">
                            Veja +
                            </a>
                    </div>
                </div>
            </div>


            <?php endforeach ?>
        </div>
        <div class="row">

            <?php foreach ($artigos_linha as $coluna) : ?>

            <?php $descricao_limpa = strip_tags(html_entity_decode($coluna->artigo_descricao)) ?>

            <div class="col-xs-6 col-sm-12 col-md-4 col-lg-3">
                <div class="featured-box border">
                    <figure class="text-center">
                        <a href="<?= base_url('detalhes/' . $coluna->artigo_url) ?>" class="img-box">
                                <img class="img-box-background" src="<?= base_url('uploads/artigos/' . $coluna->foto_nome) ?>" alt="<?= $coluna->artigo_titulo ?>" title="<?= $coluna->artigo_titulo ?>"></a>
                    </figure>
                    <div class="feature-content">

                    <div class="mb-2">
                            <small><?= $artigo->categoria_pai_nome ?></small>

                        </div>

                        <a href="<?= base_url('detalhes/' . $coluna->artigo_url) ?>">
                            <p class="titulo-artigo"><strong><?= character_limiter($coluna->artigo_titulo, 30) ?></strong></p>
                        </a>
                        <p>
                            <?= 
                                character_limiter($descricao_limpa, 50)
                                ?>
                        </p>
                        <div class="meta-tag mb-4 mt-3">
                            <small>Por: <b><?= $coluna->first_name ?></b> em <?= formata_data_banco_sem_hora($coluna->artigo_data_criacao) ?> <br>Tempo de leitura: <?=$coluna->artigo_tempo_leitura?></small>
                        </div>
                        <a href="busca/master/<?= $coluna->categoria_pai_meta_link ?>" targe="_parent" class="btn btn-common btn-veja-mais float-right">
                            Veja +
                            </a>
                    </div>
                </div>
            </div>

            <?php endforeach ?>

        </div>
    </div>
</section>