<?php $this->load->view('web/layout/navbar');?>
<section class="featured section-padding">
<h1 class="section-title"><?=$titulo?></h1>
        <div class="container">
            <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="row">

                                <?php if(isset($artigos)) :?>
                                <?php foreach($artigos as $art) : ?>
                                    
                                        <?php $descricao_limpa = strip_tags(html_entity_decode($art->artigo_descricao)) ?>

                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                                            <div id="list-view" class="tab-pane fade active show">
                                            <div class="featured-box artigos">
                                                    <figure class="text-center">
                                                        <a target="_parent" href="<?= base_url('detalhes/' . $art->artigo_url) ?>" class="img-box">
                                                            <img class="img-box-background" sty src="<?= base_url('uploads/artigos/' . $art->foto_nome) ?>" alt="<?= $art->artigo_titulo ?>" title="<?= $art->artigo_titulo ?>"></a>
                                                    </figure>
                                                    <div class="feature-content">
                                                        <div class="product">
                                                            <a target="_parent" href="<?= base_url('busca/master/' . $art->categoria_pai_meta_link) ?>">
                                                                <?= $art->categoria_pai_nome ?>
                                                            </a>

                                                        </div>
                                                        <a target="_parent" href="<?= base_url('detalhes/' . $art->artigo_url) ?>"><p class="titulo-artigo"><strong><?= character_limiter($art->artigo_titulo, 30) ?></strong></p></a>
                                                        
                                                        <p class="dsc mb-2 mt-2">
                                                            <?= character_limiter($descricao_limpa, 60) ?>
                                                        </p>
                                                        <div class="meta-tag mt-4">
                                                            <small>
                                                                
                                                                Por: <b><?= $art->first_name ?></b>
                                                                em <?= formata_data_banco_sem_hora($art->artigo_data_criacao) ?> | 
                                                                <?= $art->artigo_tempo_leitura ?> de leitura
                                                            </small>

                                                        </div>
                                                        

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                <?php endforeach ?>
                                <?php endif ?>
                        </div>
                  </div>
            </div>
           
            
        </div>
    </section>

<?php $this->load->view('web/home/todos_artigos'); ?>
