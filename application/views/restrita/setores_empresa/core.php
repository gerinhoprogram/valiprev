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
													<label>* Nome do setor <small class="titulo text-info"></small></label>
													<div class="input-group">
														<div class="input-group-prepend">
															<div class="input-group-text">
																<i class="fas fa-cube text-info"></i>
															</div>
														</div>
														<input type="text" id="titulo" autofocus max_length="150" class="form-control" name="setor_nome" value="<?php echo (isset($setor) ? $setor->setor_nome : set_value('setor_nome')); ?>">
													</div>
													<div class="error_nome_setor"></div>
													<?php echo form_error('setor_nome', '<div class="text-danger">', '</div>'); ?>

												</div>

											</div>

								</div>
								<?php if (isset($setor)) : ?>
									<input type="hidden" name="setor_id" value="<?= $setor->setor_id ?>">
								<?php endif ?>


								<?php $this->load->view('restrita/layout/btn-footer'); ?>
							</div>
						</div>
					</div>
				</div>
			</section>

			<?php $this->load->view('restrita/layout/sidebar_configuracoes'); ?>

		</div>

</form>