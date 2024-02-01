<style>
	.custom-control-label:hover{
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
											<label>* Nome do grupo <small class="titulo text-info"></small></label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fas fa-user-tie text-info"></i>
													</div>
												</div>
												<input id="titulo" type="text" class="form-control" name="name" value="<?php echo (isset($setor) ? $setor->name : set_value('name')); ?>">
											</div>
											<?php echo form_error('name', '<div class="text-danger">', '</div>'); ?>

										</div>

										<div class="form-group col-md-12">
											<label>Breve descrição do grupo <small class="description text-info"></small></label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fas fa-user-tie text-info"></i>
													</div>
												</div>
												<input type="text" id="description" class="form-control" name="description" value="<?php echo (isset($setor) ? $setor->description : set_value('description')); ?>">
											</div>
											
											<?php echo form_error('description', '<div class="text-danger">', '</div>'); ?>

										</div>

									</div>
									<div class="form-row">

										<div class="form-group col-md-12">
											<label class="mr-3">Selecione as áreas que o grupo terá permissões de acesso</label>
											<div class="areas"></div>
											<?php echo form_error('areas', '<div class="text-danger">', '</div>'); ?>
											<div class="p-2">
												<?php if (isset($setor)) : ?>

													<?php
													foreach ($areas_acesso as $acesso) {

														echo '<input type="hidden" value="' . $acesso->excluir . '" name="excluir[]">';
														echo '<input type="hidden" value="' . $acesso->editar . '" name="editar[]">';
														echo '<input type="hidden" value="' . $acesso->adicionar . '" name="adicionar[]">';
														echo '<div class="custom-control mb-2 custom-radio custom-control-inline badge badge-info"><input type="checkbox" checked id="' . $acesso->area_id . '" class="custom-control-input areas" value="' . $acesso->area_id . '" name="areas[]"><label class="custom-control-label" for="' . $acesso->area_id . '">' . $acesso->area_nome . '</label></div>';
													}

													foreach ($areas as $area) {
														if ($area->area_id) {
															echo '<div class="custom-control mb-2 custom-radio custom-control-inline badge badge-info"><input type="checkbox" id="' . $area->area_id . '" class="custom-control-input areas" value="' . $area->area_id . '" name="areas[]"><label class="custom-control-label" for="' . $area->area_id . '">' . $area->area_nome . '</label></div>																	';
														}
													}

													?>

												<?php else : ?>

													<?php foreach ($areas as $area) : ?>

														<div class="custom-control mb-2 custom-radio custom-control-inline badge badge-info"><input type="checkbox" id="<?= $area->area_id ?>" class="custom-control-input" value="<?= $area->area_id ?>" name="areas[]"><label class="custom-control-label" for="<?= $area->area_id ?>"><?= $area->area_nome ?></label></div>

													<?php endforeach ?>

												<?php endif ?>

											</div>
										</div>

									</div>


								</div>
								<?php if (isset($setor)) : ?>
									<input type="hidden" name="setor_id" value="<?php echo $setor->id; ?>">
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