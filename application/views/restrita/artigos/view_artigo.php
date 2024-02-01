<style>
    .bt1, .bt2{
        pointer-events: none !important
    }
</style>
<form method="post" name="form_core">
<div class="main-wrapper main-wrapper-1">

    <?php $this->load->view('restrita/layout/navbar'); ?>

    <?php $this->load->view('restrita/layout/sidebar'); ?>

    <!-- Main Content -->
    <div class="main-content">

        <section class="section">
            <div class="section-body">

                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">

                        <div class="card">
                                <div class="card-header">
                                    <h4>
                                        <?= $titulo; ?>
                                    </h4>
                                </div>
                                <div class="card-body">

                                    <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <h5>Título</h5>
                                        <p><?=$artigo->artigo_titulo?></p>
                                        <?php if($artigo->artigo_legenda) : ?>
                                            <h5>Legenda</h5>
                                            <p><?=$artigo->artigo_legenda?></p>
                                        <?php endif ?>

                                        <h5>Categoria principal</h5>
                                        <p><?=$artigo->categoria_pai_nome?></p>

                                        <h5>Categorias secundárias</h5>
                                        <p>
                                            <?php foreach($subcategorias_do_artigo as $sub) :?>
                                                <span class="badge badge-info"><?=$sub->categoria_nome?></span>&nbsp;&nbsp;
                                            <?php endforeach ?>
                                        </p>

                                        <h5>Tempo de leitura</h5>

                                             <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                    <i class="fas fas fa-clock"></i>
                                                    </div>
                                                </div>
                                                <input type="hidden" value="<?=$artigo->artigo_id?>" id="artigo_id">
                                                <input type="text" id="artigo_leitura" class="form-control" readonly name="artigo_tempo_leitura">
                                            </div><br>

                                            <h5>Texto do artigo</h5>
                                            <div id="content">
                                            <p><?= html_entity_decode($artigo->artigo_descricao) ?></p>
                                            </div>
                                    </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <h3>Fotos do artigo</h3>
                                        </div>
                                        <?php foreach($fotos_artigo as $foto) : ?>
                                            <div class="form-group col-md-3">
                                                <div style="height: 300px;">
                                                <img src="<?php echo base_url('uploads/artigos/'.$foto->foto_nome) ?>" alt="" class="img-thumbnail mr-1 mb2" style="height: 220px; width: 100%; object-fit: contain">
                                                <?=($foto->foto_titulo ? '<p>'.$foto->foto_titulo.'</p>' : '' )?>
                                                <p><?=($foto->foto_principal ? 'Foto principal' : '')?></p>
                                                </div>
                                            </div>
                                        <?php endforeach ?>
                                    </div>

                                    <?php if($banners_do_artigo) :?>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <h3>Banners CTA</h3>
                                        </div>
                                        <?php foreach($banners_do_artigo as $banner) : ?>
                                            <div class="form-group col-md-3">
                                                <div style="height: 300px;">
                                                <img src="<?php echo base_url('uploads/banners_site/'.$banner->banner_imagem) ?>" alt="" class="img-thumbnail mr-1 mb2" style="height: 220px; width: 100%; object-fit: contain">
                                                <p><?=$banner->banner_titulo ?></p>
                                                <p><?=$banner->banner_url ?></p>
                                                </div>
                                            </div>
                                        <?php endforeach ?>
                                    </div>
                                    <?php endif?>

                                    <?php if($artigos_semelhantes_do_artigo) :?>
                                        <div class="form-row mt-5">
                                            <div class="form-group col-md-12">
                                            <h3>Artigos semelhantes</h3>
                                            <p>
                                            <?php foreach($artigos_semelhantes_do_artigo as $art) :?>
                                                <span class="badge badge-success"><?=$art->artigo_titulo?></span>&nbsp;&nbsp;
                                            <?php endforeach ?>
                                            </p>
                                            </div>
                                        </div>
                                    <?php endif ?>

                                    <?php if($seo) :?>
                                        <div class="form-row mt-5">
                                            <div class="form-group col-md-12">
                                            <h3>Palavras SEO</h3>
                                            <p>
                                            <?php foreach($seo as $s) :?>
                                                <span class="badge badge-dark">#<?=$s->seo_palavra?></span>&nbsp;&nbsp;
                                            <?php endforeach ?>
                                            </p>
                                            </div>
                                        </div>
                                    <?php endif ?>
                                    

                                </div>

                                
                                <div class="card-footer">
                                

                                    <?php if($artigo->artigo_publicado) :?>
                                        <a data-toggle="tooltip" data-placement="top" title="Tudo Ok" href="<?php echo base_url('restrita/' . $this->router->fetch_class()); ?>" class="btn situacao btn-success" data-confirm="Tudo Ok com o arigo?"><i class="fas fa-comment"></i> Ok</a>

                                    <?php else :?>
                                        <a data-toggle="tooltip" data-placement="top" title="Publicar artigo" href="<?php echo base_url('restrita/' . $this->router->fetch_class() . '/situacao/' . $artigo->artigo_id); ?>" class="btn situacao btn-success" data-confirm="Deseja publicar o artigo?"><i class="fas fa-comment"></i> Publicar</a>

                                    <?php endif ?>

                                    <a data-toggle="tooltip" data-placement="top" title="Editar artigo" onclick="loading()" href="<?php echo base_url('restrita/' . $this->router->fetch_class() . '/core/' . $artigo->artigo_id); ?>" class="btn btn-info"><i class="far fa-edit"></i>&nbsp;Editar artigo</a>

                                </div>

                        </div>

                    </div>

                </div>

            </div>
        </section>

        <?php $this->load->view('restrita/layout/sidebar_configuracoes'); ?> 
    </div>
    </form> 
        





    

    


