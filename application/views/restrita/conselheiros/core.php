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

										<div class="form-group col-md-8">
											<label>* Nome <small class="titulo text-info"></small></label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fas fa-user-tie text-info"></i>
													</div>
												</div>
												<input id="titulo" type="text" class="form-control" name="con_nome" value="<?php echo (isset($conselho) ? $conselho->con_nome : set_value('con_nome')); ?>">
											</div>
											<?php echo form_error('con_nome', '<div class="text-danger">', '</div>'); ?>
										</div>

										<div class="form-group col-md-4">
											<label>Categoria</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fas fa-check-circle text-info"></i>
													</div>
												</div>
												<select class="custom-select" name="con_categoria">

													<?php if (isset($conselho)) : ?>

														<option value="Eleição" <?php echo ($conselho->con_categoria == 'Eleição' ? 'selected' : ''); ?>>Eleição</option>
														<option value="Indicação" <?php echo ($conselho->con_categoria == 'Indicação' ? 'selected' : ''); ?>>Indicação</option>

													<?php else : ?>

														<option value="Indicação">Indicação</option>
														<option value="Eleição">Eleição</option>

													<?php endif; ?>

												</select>
											</div>

										</div>

										<div class="form-group col-md-8">
											<label>* Cargo <small class="titulo text-info"></small></label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fas fa-user-tie text-info"></i>
													</div>
												</div>
												<input id="cargo" type="text" class="form-control" name="con_cargo" value="<?php echo (isset($conselho) ? $conselho->con_cargo : set_value('con_cargo')); ?>">
											</div>
											<?php echo form_error('con_cargo', '<div class="text-danger">', '</div>'); ?>
										</div>

										<div class="form-group col-md-4">
											<label>Conselho</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fas fa-check-circle text-info"></i>
													</div>
												</div>
												<select class="custom-select" name="con_pagina_id">

													<?php if (isset($conselho)) : ?>

														<option value="91" <?php echo ($conselho->con_pagina_id == 0 ? 'selected' : ''); ?>>Administrativo</option>
														<option value="93" <?php echo ($conselho->con_pagina_id == 1 ? 'selected' : ''); ?>>Fiscal</option>

													<?php else : ?>

														<option value="91">Administativo</option>
														<option value="93">Fiscal</option>

													<?php endif; ?>

												</select>
											</div>

										</div>

										<div class="form-group col-md-12">
											<label>Foto</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="text-info fas fa-image"></i>
													</div>
												</div>
												<input type="file" class="form-control" name="con_foto">
											</div>
											<div id="logo_foto_troca"></div>
											<?= form_error('con_foto', '<small id="emailHelp" class="form-text text-danger">', '</small>'); ?>

										</div>
										<div class="form-group col-md-12">
											<div id="box-foto-logo">
												<?php if (isset($conselho)) : ?>
													<input type="hidden" name="foto_produto" value="<?= $conselho->con_foto ?>">
													<img src="<?= base_url('uploads/paginas/conselhos/conselheiros/' . $conselho->con_foto) ?>" style="height: 200px; object-fit: contain">

												<?php endif ?>
											</div>
										</div>

										<?php if (isset($conselho)) : ?>
										<input type="hidden" name="con_id" value="<?php echo $conselho->con_id; ?>">
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
