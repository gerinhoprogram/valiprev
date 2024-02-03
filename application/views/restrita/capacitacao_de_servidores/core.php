<style>
	.custom-control-label:hover{
		cursor: pointer;
	}
</style>
<form method="post" name="form_core" >


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

										<div class="form-group col-md-8">
											<label>* Nome <small class="titulo text-info"></small></label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fas fa-user-tie text-info"></i>
													</div>
												</div>
												<input id="titulo" type="text" class="form-control" name="serv_nome" value="<?php echo (isset($servidor) ? $servidor->serv_nome : set_value('serv_nome')); ?>">
											</div>
											<?php echo form_error('serv_nome', '<div class="text-danger">', '</div>'); ?>

										</div>

										<div class="form-group col-md-4">
                                            <label>Status</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-check-circle text-info"></i>
                                                    </div>
                                                </div>
                                                <select class="custom-select" name="serv_status">

                                                    <?php if (isset($servidor)): ?>

                                                        <option value="0" <?php echo ($servidor->serv_status == 0 ? 'selected' : ''); ?>>Inativo</option>
                                                        <option value="1" <?php echo ($servidor->serv_status == 1 ? 'selected' : ''); ?>>Ativo</option>

                                                    <?php else: ?>

                                                        <option value="1">Ativo</option>
                                                        <option value="0">Inativo</option>

                                                    <?php endif; ?>

                                                </select>
                                            </div>
                                        </div>

									</div>

									<div class="form-row">



												<div class="form-group col-md-12">
													<label>Carregar arquivos em PDF</label>
													<div id="fileuploader"></div>
													<div id="carregando"></div>
													<div id="erro_uploaded" class="text-danger">
													</div>
													<small id="error_imagem" class="text-danger"></small>
													<?= form_error('fotos_produtos', '<div class="text-danger">', '</div>'); ?>
												</div>

											</div>

											<div class="form-row">
												<div class="form-group col-md-12">
													<div class="form-row" id="uploaded_image">

														<?php if (isset($pdf)) : ?>
															<?php foreach ($pdf as $p) : ?>

																<div class="form-group col-md-3">


																	<!-- <img src="<?= base_url('uploads/artigos/' . $p->foto_nome) ?>" alt="" style="height: 150px; width: 100%; object-fit: contain" class="img-thumbnail">
																	<input type="text" placeholder="Título da foto" class="form-control mt-2" name="foto_titulo[]" value="<?= $p->foto_titulo ?>">
																	<div class="custom-control custom-radio"><input type="radio" class="mt-2 mb-4" name="foto_principal" id="<?= $p->foto_nome ?>" <?= $p->foto_principal ? 'checked' : '' ?> value="<?= $p->foto_nome ?>"><label for="<?= $p->foto_nome ?>" class="mt-2 ml-2"><?= $p->foto_principal ? 'Foto principal' : '' ?></label></div>
																	<input type="hidden" class="imagem" id="fotos" name="fotos_produtos[]" value="<?= $p->foto_nome ?>">
																	<button type="button" class="btn btn-danger btn-remove" style="width: 45px">X</button> -->


																</div>

															<?php endforeach ?>
														<?php else : ?>
															
														<?php endif ?>

													</div>
												</div>

											</div>
									


								</div>
								<?php if (isset($servidor)) : ?>
									<input type="hidden" name="serv_id" value="<?php echo $servidor->serv_id; ?>">
								<?php endif; ?>
								<?php $this->load->view('restrita/layout/btn-footer') ?>

							</div>
						</div>
					</div>
				</div>
			</section>

			<?php $this->load->view('restrita/layout/sidebar_configuracoes'); ?>

		</div>





</form>
