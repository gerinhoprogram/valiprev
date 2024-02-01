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
											<label>* Nome do arquivo <small class="titulo text-info"></small></label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fas fa-user-tie text-info"></i>
													</div>
												</div>
												<input id="titulo" type="text" class="form-control" name="name" value="<?php echo (isset($pdf) ? $pdf->name : set_value('name')); ?>">
											</div>
											<?php echo form_error('name', '<div class="text-danger">', '</div>'); ?>

										</div>

										<div class="form-group col-md-12">
											<label>Breve descrição/resumo <small class="description text-info"></small></label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fas fa-user-tie text-info"></i>
													</div>
												</div>
												<textarea class="form-control" name="pdf_descricao"></textarea>
											</div>
											
											<?php echo form_error('description', '<div class="text-danger">', '</div>'); ?>

										</div>

									</div>
									


								</div>
								<?php if (isset($pdf)) : ?>
									<input type="hidden" name="setor_id" value="<?php echo $pdf->_pdf_id; ?>">
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
