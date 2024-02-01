<div class="main-wrapper main-wrapper-1">

    <?php $this->load->view('restrita/layout/navbar'); ?>

    <?php $this->load->view('restrita/layout/sidebar'); ?>

    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>
                                    <?=$titulo?>
                                </h4>
                            </div>
                            <div class="card-body">
                                <div id="aniimated-thumbnials" class="list-unstyled row clearfix">
                                    <?php foreach($banners as $banner) : ?>

                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="mb-4 border">
                                            <a href="<?= base_url('uploads/banners_cta/' . $banner->cta_imagem) ?>" data-sub-html="<?=$banner->cta_titulo?>">
                                                <img class="img-responsive thumbnail" src="<?= base_url('uploads/banners_cta/' . $banner->cta_imagem) ?>" alt="" style="height: 200px; width: 100%; object-fit: contain">
                                            </a>
                                            <small><?=$banner->cta_titulo?></small>
                                        </div>
                                    </div>

                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php $this->load->view('restrita/layout/sidebar_configuracoes'); ?>


    </div>