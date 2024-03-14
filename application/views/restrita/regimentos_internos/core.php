<style>
	.custom-control-label:hover {
		cursor: pointer;
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

										<div class="form-group col-md-12">
											<label>* Nome <small class="reg_nome text-info"></small></label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fas fa-user-tie text-info"></i>
													</div>
												</div>
												<input id="reg_nome" type="text" class="form-control" name="reg_nome" value="<?php echo (isset($regimento) ? $regimento->reg_nome : set_value('reg_nome')); ?>">
											</div>
											<?php echo form_error('reg_nome', '<div class="text-danger">', '</div>'); ?>
										</div>

										<div class="form-group col-md-6">
											<label>Conselho</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fas fa-check-circle text-info"></i>
													</div>
												</div>
												<select class="custom-select" name="reg_pagina_id">

													<?php if (isset($regimento)) : ?>

														<option value="91" <?php echo ($regimento->reg_pagina_id == 0 ? 'selected' : ''); ?>>Administrativo</option>
														<option value="93" <?php echo ($regimento->reg_pagina_id == 1 ? 'selected' : ''); ?>>Fiscal</option>

													<?php else : ?>

														<option value="91">Administativo</option>
														<option value="93">Fiscal</option>

													<?php endif; ?>

												</select>
											</div>

										</div>

										<div class="form-group col-md-12">
											<label>Arquivo</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="text-info fas fa-image"></i>
													</div>
												</div>
												<input type="file" class="form-control" name="reg_foto">
											</div>
											<div id="logo_foto_troca"></div>
											<?= form_error('reg_foto', '<small id="emailHelp" class="form-text text-danger">', '</small>'); ?>

										</div>
										<div class="form-group col-md-12">
											<div id="box-foto-logo">
												<?php if (isset($regimento)) : ?>
													<input type="hidden" name="reg_foto" value="<?= $regimento->reg_foto ?>">

													<?php if ($regimento->reg_tipo_arquivo != 'pdf') : ?>
														<img src="<?= base_url('uploads/paginas/conselhos/regimentos/' . $regimento->reg_foto) ?>" style="height: 200px; object-fit: contain">
													<?php else : ?>
														<a href="<?= base_url('uploads/paginas/conselhos/regimentos/' . $regimento->reg_foto) ?>"><span class='badge badge-info'>Documento</span> </a></a>

													<?php endif ?>
												<?php endif ?>
											</div>
										</div>

										<?php if (isset($regimento)) : ?>
										<input type="hidden" name="reg_id" value="<?php echo $regimento->reg_id; ?>">
										<?php endif ?>
									</div>

								</div>



								<?php $this->load->view('restrita/layout/btn-footer') ?>

							</div>
						</div>
					</div>
				</div>
			</section>

			<?php $this->load->view('restrita/layout/sidebar_configuracoes'); ?>

		</div>





</form>
