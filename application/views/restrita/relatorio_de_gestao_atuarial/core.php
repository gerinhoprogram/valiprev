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

									<?php if (isset($pdf)) : ?>

										<div class="form-row">

											<div class="form-group col-md-12">
												<label>* Título do documento <small class="pdf_titulo text-info"></small></label>
												<div class="input-group">
													<div class="input-group-prepend">
														<div class="input-group-text">
															<i class="fas fa-user-tie text-info"></i>
														</div>
													</div>
													<input id="pdf_titulo" type="text" class="form-control" name="pdf_titulo" value="<?php echo (isset($pdf) ? $pdf->pdf_titulo : set_value('pdf_titulo')); ?>">
												</div>
												<?php echo form_error('pdf_titulo', '<div class="text-danger">', '</div>'); ?>

											</div>

											<div class="form-group col-md-12">
												<label>Arquivo em PDF</label>
												<div class="input-group">
													<div class="input-group-prepend">
														<div class="input-group-text">
															<i class="text-info fas fa-image"></i>
														</div>
													</div>
													<input type="file" class="form-control" name="pdf_arquivo">
												</div>
												<div id="logo_foto_troca"></div>
												<?= form_error('pdf_arquivo', '<small id="emailHelp" class="form-text text-danger">', '</small>'); ?>

											</div>
											<div class="form-group col-md-12">
												<div id="box-foto-logo">
													
												<input type="hidden" name="pdf_arquivo" value="<?= $pdf->pdf_arquivo ?>">
													<p><a href="<?= base_url($folder . $pdf->pdf_arquivo) ?>" target="_blank"><span class="badge badge-info">Documento</span></a></p>
													<input type="text" class="form-control" readonly name="pdf_tamanho" value="<?= $pdf->pdf_tamanho ?>">
												
												</div>
											</div>


										<input type="hidden" name="pdf_id" value="<?php echo $pdf->pdf_id; ?>">
										</div>
									<?php else : ?>

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


											</div>
										</div>

									</div>

									<?php endif; ?>

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
