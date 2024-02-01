<style>

    #box-foto-banner img{
        width: 100%;
        height: 200px;
        object-fit: contain
    }
</style>
 <form method="post" name="form_core">
	 
	 
<div class="main-wrapper main-wrapper-1">


    <?php $this->load->view('restrita/layout/navbar'); ?>

    <?php $this->load->view('restrita/layout/sidebar'); ?>

    <!-- Main Content -->
    <div class="main-content">

        <section>
            <div class="section-body">

                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">


                        <div class="card">
                                <div class="card-header">
                                    <h4><?php echo $titulo; ?></h4>
                                </div>
                                <div class="card-body">
									
									<div class="form-row">
											<div class="form-group col-md-6">
												<label>Banner título</label>
												<div class="input-group">
													<div class="input-group-prepend">
														<div class="input-group-text">
															<i class="fas fa-image text-info"></i>
														</div>
													</div>
													<input type="text" class="form-control" name="banner_titulo" value="<?php echo (isset($banner) ? $banner->banner_titulo: set_value('banner_titulo')); ?>">
												</div>
												<div class="error_nome_banner"></div>
												<?php echo form_error('banner_titulo', '<div class="text-danger">', '</div>'); ?>

											</div>

											<div class="form-group col-md-6">
												<label>URL link</label>
												<div class="input-group">
													<div class="input-group-prepend">
														<div class="input-group-text">
															<i class="fas fa-external-link-alt text-info"></i>
														</div>
													</div>
													<input type="text" class="form-control" name="banner_url" value="<?php echo (isset($banner) ? $banner->banner_url: set_value('banner_url')); ?>">
												</div>
											</div>
									</div>
									
									<fieldset class="mb-4 border p-2">
											<legend class="font-md">Banner</legend>

											<div class="form-group row">
												<div class="form-group col-md-12">
												<label class="text-info">Dimenssões max.: 1500x1500<br>Tam. max: 3MB<br>Extensões: PNG | JPG | SVG | GIF | WEBP<br>Clique no botão e selecione os banners</label>

													<div class="input-group">
														<div class="input-group-prepend">
															<div class="input-group-text">
																<i class="fas fa-image text-info"></i>
															</div>
														</div>
														<input type="file" class="form-control" name="banner_site">
													</div>
													<div id="carregando_banner"></div>
														<div id="banner_foto_troca"></div>
														<?php echo form_error('banner','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>

												</div>

												<div class="form-group col-md-12">
													

													<?php if(isset($banner)) : ?>
														<div id="box-foto-banner">
														<label>Banner atual</label>
														<input type="hidden" name="banner_imagem" value="<?php echo (isset($banner) ? $banner->banner_imagem : '') ?>">
														<img src="<?php echo base_url('uploads/banners_site/'.$banner->banner_imagem)  ?>" alt="" class='img-thumbnail'>
														<input type="text" class="form-control mt-2" name="banner_tipo" readonly value="<?=$banner->banner_tipo?>">	
														<input type="text" class="form-control mt-2" name="banner_tamanho" readonly value="<?=$banner->banner_tamanho?>">
														<input type="text" class="form-control mt-2" name="banner_medida" readonly value="<?=$banner->banner_medida?>">		
													</div>
													<?php else :?>
														<div id="box-foto-banner"></div>
													<?php endif ?>
												</div>

											</div>
									</fieldset>

                                </div>
								<?php if (isset($banner)): ?>
                                            <input type="hidden" name="banner_id" value="<?php echo $banner->banner_id; ?>">
                                    <?php endif; ?>
									<?php $this->load->view('restrita/layout/btn-footer'); ?>
                                
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php $this->load->view('restrita/layout/sidebar_configuracoes'); ?>

    </div>
		
								
</form>
	
	
	