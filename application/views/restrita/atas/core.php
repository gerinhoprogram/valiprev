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
											<label>* Nome <small class="ata_nome text-info"></small></label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fas fa-user-tie text-info"></i>
													</div>
												</div>
												<input id="ata_nome" type="text" class="form-control" name="ata_nome" value="<?php echo (isset($ata) ? $ata->ata_nome : set_value('ata_nome')); ?>">
											</div>
											<?php echo form_error('ata_nome', '<div class="text-danger">', '</div>'); ?>
										</div>

										<div class="form-group col-md-6">
											<label>Conselho</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fas fa-check-circle text-info"></i>
													</div>
												</div>
												<select class="custom-select" name="ata_pagina_id">

													<?php if (isset($ata)) : ?>

														<option value="91" <?php echo ($ata->ata_pagina_id == 0 ? 'selected' : ''); ?>>Administrativo</option>
														<option value="93" <?php echo ($ata->ata_pagina_id == 1 ? 'selected' : ''); ?>>Fiscal</option>

													<?php else : ?>

														<option value="91">Administativo</option>
														<option value="93">Fiscal</option>

													<?php endif; ?>

												</select>
											</div>

										</div>

										<div class="form-group col-md-6">
											<label>* Ano <small class="ata_ano text-info"></small></label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fas fa-user-tie text-info"></i>
													</div>
												</div>
												<input id="ata_ano" type="text" class="form-control" name="ata_ano" value="<?php echo (isset($ata) ? $ata->ata_ano : set_value('ata_ano')); ?>">
											</div>
											<?php echo form_error('ata_ano', '<div class="text-danger">', '</div>'); ?>
										</div>

										<div class="form-group col-md-12">
											<label>Arquivo</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="text-info fas fa-image"></i>
													</div>
												</div>
												<input type="file" class="form-control" name="ata_foto">
											</div>
											<div id="logo_foto_troca"></div>
											<?= form_error('ata_foto', '<small id="emailHelp" class="form-text text-danger">', '</small>'); ?>

										</div>
										<div class="form-group col-md-12">
											<div id="box-foto-logo">
												<?php if (isset($ata)) : ?>
													<input type="hidden" name="ata_foto" value="<?= $ata->ata_foto ?>">

														<a href="<?= base_url('uploads/paginas/conselhos/atas/' . $ata->ata_foto) ?>"><span class='badge badge-info'>Documento</span> </a>

												<?php endif ?>
											</div>
										</div>

										<?php if (isset($ata)) : ?>
										<input type="hidden" name="ata_id" value="<?php echo $ata->ata_id; ?>">
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
