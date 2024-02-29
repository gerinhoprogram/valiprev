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
											<label>* Título <small class="titulo text-info"></small></label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fas fa-user-tie text-info"></i>
													</div>
												</div>
												<input id="titulo" type="text" class="form-control" name="man_titulo" value="<?php echo (isset($mandato) ? $mandato->man_titulo : set_value('man_titulo')); ?>">
											</div>
											<?php echo form_error('man_titulo', '<div class="text-danger">', '</div>'); ?>
										</div>


										<div class="form-group col-md-12">
											<label>* Decreto <small class="decreto text-info"></small></label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fas fa-user-tie text-info"></i>
													</div>
												</div>
												<input id="decreto" type="text" class="form-control" name="man_decreto" value="<?php echo (isset($mandato) ? $mandato->man_decreto : set_value('man_decreto')); ?>">
											</div>
											<?php echo form_error('man_decreto', '<div class="text-danger">', '</div>'); ?>
										</div>

										<div class="form-group col-md-12">
											<label>* Posse <small class="posse text-info"></small></label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fas fa-user-tie text-info"></i>
													</div>
												</div>
												<input id="posse" type="text" class="form-control" name="man_posse" value="<?php echo (isset($mandato) ? $mandato->man_posse : set_value('man_posse')); ?>">
											</div>
											<?php echo form_error('man_posse', '<div class="text-danger">', '</div>'); ?>
										</div>

										<div class="form-group col-md-4">
											<label>Conselho</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fas fa-check-circle text-info"></i>
													</div>
												</div>
												<select class="custom-select" name="man_pagina_id">

													<?php if (isset($mandato)) : ?>

														<option value="91" <?php echo ($mandato->man_pagina_id == 0 ? 'selected' : ''); ?>>Administrativo</option>
														<option value="93" <?php echo ($mandato->man_pagina_id == 1 ? 'selected' : ''); ?>>Fiscal</option>

													<?php else : ?>

														<option value="91">Administativo</option>
														<option value="93">Fiscal</option>

													<?php endif; ?>

												</select>
											</div>

										</div>


										<?php if (isset($mandato)) : ?>
											<input type="hidden" name="man_id" value="<?php echo $mandato->man_id; ?>">
										<?php endif ?>
									</div>

									<div class="form-row">
										<div class="form-group col-md-12">
											<fieldset class="border p-2">
												<legend>Membros indicados livremente pelo Prefeito Municipal</legend>
												<label for="">Titulares</label>
												<div class="input-group mb-2">
													<div class="input-group-prepend">
														<div class="input-group-text">
															<i class="fas fa-user-tie text-info"></i>
														</div>
													</div>
													<input id="decreto" type="text" class="form-control" name="prefeito_titulares_indicados_1" value="<?php echo (isset($mandato) ? $mandato->man_decreto : set_value('prefeito_titulares_indicados_1')); ?>">
												</div>
												<?php echo form_error('prefeito_titulares_indicados_1', '<div class="text-danger">', '</div>'); ?>

												<div class="input-group mb-2">
													<div class="input-group-prepend">
														<div class="input-group-text">
															<i class="fas fa-user-tie text-info"></i>
														</div>
													</div>
													<input id="decreto" type="text" class="form-control" name="prefeito_titulares_indicados_2" value="<?php echo (isset($mandato) ? $mandato->man_decreto : set_value('prefeito_titulares_indicados_2')); ?>">
												</div>
												<?php echo form_error('prefeito_titulares_indicados_2', '<div class="text-danger">', '</div>'); ?>

												<div class="input-group mb-2">
													<div class="input-group-prepend">
														<div class="input-group-text">
															<i class="fas fa-user-tie text-info"></i>
														</div>
													</div>
													<input id="decreto" type="text" class="form-control" name="prefeito_titulares_indicados_3" value="<?php echo (isset($mandato) ? $mandato->man_decreto : set_value('prefeito_titulares_indicados_3')); ?>">
												</div>
												<?php echo form_error('prefeito_titulares_indicados_3', '<div class="text-danger">', '</div>'); ?>

												<label for="">Suplentes</label>
												<div class="input-group mb-2">
													<div class="input-group-prepend">
														<div class="input-group-text">
															<i class="fas fa-user-tie text-info"></i>
														</div>
													</div>
													<input id="decreto" type="text" class="form-control" name="prefeito_suplentes_indicados_1" value="<?php echo (isset($mandato) ? $mandato->man_decreto : set_value('prefeito_suplentes_indicados_1')); ?>">
												</div>
												<?php echo form_error('prefeito_suplentes_indicados_1', '<div class="text-danger">', '</div>'); ?>

												<div class="input-group mb-2">
													<div class="input-group-prepend">
														<div class="input-group-text">
															<i class="fas fa-user-tie text-info"></i>
														</div>
													</div>
													<input id="decreto" type="text" class="form-control" name="prefeito_suplentes_indicados_2" value="<?php echo (isset($mandato) ? $mandato->man_decreto : set_value('prefeito_suplentes_indicados_2')); ?>">
												</div>
												<?php echo form_error('prefeito_suplentes_indicados_2', '<div class="text-danger">', '</div>'); ?>

												<div class="input-group mb-2">
													<div class="input-group-prepend">
														<div class="input-group-text">
															<i class="fas fa-user-tie text-info"></i>
														</div>
													</div>
													<input id="decreto" type="text" class="form-control" name="prefeito_suplentes_indicados_3" value="<?php echo (isset($mandato) ? $mandato->man_decreto : set_value('prefeito_suplentes_indicados_3')); ?>">
												</div>
												<?php echo form_error('prefeito_suplentes_indicados_3', '<div class="text-danger">', '</div>'); ?>
											</fieldset>
										</div>
									</div>

									<div class="form-row">
										<div class="form-group col-md-12">
											<fieldset class="border p-2">
												<legend>Membros eleitos pelos servidores municipais efetivos ativos e inativos:</legend>
												<label for="">Titulares</label>
												<div class="input-group mb-2">
													<div class="input-group-prepend">
														<div class="input-group-text">
															<i class="fas fa-user-tie text-info"></i>
														</div>
													</div>
													<input id="decreto" type="text" class="form-control" name="servidores_titulares_indicados_1" value="<?php echo (isset($mandato) ? $mandato->man_decreto : set_value('servidores_titulares_indicados_1')); ?>">
												</div>
												<?php echo form_error('servidores_titulares_indicados_1', '<div class="text-danger">', '</div>'); ?>

												<div class="input-group mb-2">
													<div class="input-group-prepend">
														<div class="input-group-text">
															<i class="fas fa-user-tie text-info"></i>
														</div>
													</div>
													<input id="decreto" type="text" class="form-control" name="servidores_titulares_indicados_2" value="<?php echo (isset($mandato) ? $mandato->man_decreto : set_value('servidores_titulares_indicados_2')); ?>">
												</div>
												<?php echo form_error('servidores_titulares_indicados_2', '<div class="text-danger">', '</div>'); ?>

												<div class="input-group mb-2">
													<div class="input-group-prepend">
														<div class="input-group-text">
															<i class="fas fa-user-tie text-info"></i>
														</div>
													</div>
													<input id="decreto" type="text" class="form-control" name="servidores_titulares_indicados_3" value="<?php echo (isset($mandato) ? $mandato->man_decreto : set_value('servidores_titulares_indicados_3')); ?>">
												</div>
												<?php echo form_error('servidores_titulares_indicados_3', '<div class="text-danger">', '</div>'); ?>

												<label for="">Suplentes</label>
												<div class="input-group mb-2">
													<div class="input-group-prepend">
														<div class="input-group-text">
															<i class="fas fa-user-tie text-info"></i>
														</div>
													</div>
													<input id="decreto" type="text" class="form-control" name="servidores_suplentes_indicados_1" value="<?php echo (isset($mandato) ? $mandato->man_decreto : set_value('servidores_suplentes_indicados_1')); ?>">
												</div>
												<?php echo form_error('servidores_suplentes_indicados_1', '<div class="text-danger">', '</div>'); ?>

												<div class="input-group mb-2">
													<div class="input-group-prepend">
														<div class="input-group-text">
															<i class="fas fa-user-tie text-info"></i>
														</div>
													</div>
													<input id="decreto" type="text" class="form-control" name="servidores_suplentes_indicados_2" value="<?php echo (isset($mandato) ? $mandato->man_decreto : set_value('servidores_suplentes_indicados_2')); ?>">
												</div>
												<?php echo form_error('servidores_suplentes_indicados_2', '<div class="text-danger">', '</div>'); ?>

												<div class="input-group mb-2">
													<div class="input-group-prepend">
														<div class="input-group-text">
															<i class="fas fa-user-tie text-info"></i>
														</div>
													</div>
													<input id="decreto" type="text" class="form-control" name="servidores_suplentes_indicados_3" value="<?php echo (isset($mandato) ? $mandato->man_decreto : set_value('servidores_suplentes_indicados_3')); ?>">
												</div>
												<?php echo form_error('servidores_suplentes_indicados_3', '<div class="text-danger">', '</div>'); ?>
											</fieldset>
										</div>
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
