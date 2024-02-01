<style>
	#box-foto-banner img {
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

									<?php if (isset($menu)) : ?>

										<div class="form-row">
											<div class="form-group col-md-12">

												<p>Criado por: <?= $menu->men_criador ?></p>

											</div>
										</div>
									<?php endif ?>

									<div class="form-row">

										<div class="form-group col-md-6">
											<label>* Nome do menu principal <small class="titulo text-info"></small></label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fas fa-cube text-info"></i>
													</div>
												</div>

												<?php if (isset($menu)) : ?>

													<input type="text" <?= ($menu->men_criador == 'sistema' ? 'readonly' : '') ?> id="men_nome" class="form-control" name="men_nome" value="<?php echo (isset($menu) ? $menu->men_nome : set_value('men_nome')); ?>">


												<?php else : ?>

													<input autofocus type="text" id="men_nome" class="form-control" name="men_nome" value="<?php echo (isset($menu) ? $menu->men_nome : set_value('men_nome')); ?>">

												<?php endif ?>

											</div>

											<?php echo form_error('men_nome', '<div class="text-danger">', '</div>'); ?>
											<div class="text-info">Menu criado pelo sistema não pode ter seu nome e URL alterados.</div>

										</div>

										<div class="form-group col-md-3">
											<label>Status</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fas fa-check-circle text-info"></i>
													</div>
												</div>
												<select class="custom-select" name="men_status">

													<?php if (isset($menu)) : ?>

														<option value="0" <?php echo ($menu->men_status == 0 ? 'selected' : ''); ?>>Inativo</option>
														<option value="1" <?php echo ($menu->men_status == 1 ? 'selected' : ''); ?>>Ativo</option>

													<?php else : ?>

														<option value="1">Ativo</option>
														<option value="0">Inativo</option>

													<?php endif; ?>

												</select>
											</div>
										</div>
										<div class="form-group col-md-3">
											<label>Ordenação</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fas fa-check-circle text-info"></i>
													</div>
												</div>
												<select class="custom-select" name="men_ordem">

													<?php if (isset($menu)) : ?>

														<option value="1" <?php echo ($menu->men_ordem == 1 ? 'selected' : ''); ?>>1</option>
														<option value="2" <?php echo ($menu->men_ordem == 2 ? 'selected' : ''); ?>>2</option>
														<option value="3" <?php echo ($menu->men_ordem == 3 ? 'selected' : ''); ?>>3</option>
														<option value="4" <?php echo ($menu->men_ordem == 4 ? 'selected' : ''); ?>>4</option>
														<option value="5" <?php echo ($menu->men_ordem == 5 ? 'selected' : ''); ?>>5</option>
														<option value="6" <?php echo ($menu->men_ordem == 6 ? 'selected' : ''); ?>>6</option>
														<option value="7" <?php echo ($menu->men_ordem == 7 ? 'selected' : ''); ?>>7</option>

													<?php else : ?>

														<option value="1">1</option>
														<option value="2">2</option>
														<option value="3">3</option>
														<option value="4">4</option>
														<option value="5">5</option>
														<option value="6">6</option>
														<option value="7">7</option>

													<?php endif; ?>

												</select>
											</div>
										</div>

									</div>

									<div class="form-row">
										<div class="form-group col-md-3">
											<label>Submenu</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fas fa-check-circle text-info"></i>
													</div>
												</div>
												<select class="custom-select" name="men_tem_submenu">

													<?php if (isset($menu)) : ?>

														<option value="0" <?php echo ($menu->men_tem_submenu == 0 ? 'selected' : ''); ?>>Não</option>
														<option value="1" <?php echo ($menu->men_tem_submenu == 1 ? 'selected' : ''); ?>>Sim</option>

													<?php else : ?>

														<option value="0">Não</option>
														<option value="1">Sim</option>

													<?php endif; ?>

												</select>
											</div>
										</div>
									</div>

								</div>

							</div>

							<?php if (isset($menu)) : ?>
								<input type="hidden" name="men_id" value="<?php echo $menu->men_id; ?>">
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
