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
												<label>* Título do documento <small class="titulo text-info"></small></label>
												<div class="input-group">
													<div class="input-group-prepend">
														<div class="input-group-text">
															<i class="fas fa-user-tie text-info"></i>
														</div>
													</div>
													<input id="titulo" type="text" class="form-control" name="pdf_titulo" value="<?php echo (isset($pdf) ? $pdf->pdf_titulo : set_value('pdf_titulo')); ?>">
												</div>
												<?php echo form_error('pdf_titulo', '<div class="text-danger">', '</div>'); ?>

											</div>

											<div class="form-group col-md-6">
												<label>Tipo do documento</label>
												<div class="input-group">
													<div class="input-group-prepend">
														<div class="input-group-text">
															<i class="fas fa-check-circle text-info"></i>
														</div>
													</div>
													<select class="custom-select" name="pdf_tipo">

															<option value="Ata" <?php echo ($pdf->pdf_tipo == 'Ata' ? 'selected' : ''); ?>>Ata</option>
															<option value="Resolução" <?php echo ($pdf->pdf_tipo == 'Resolução' ? 'selected' : ''); ?>>Resolução</option>

													</select>
												</div>
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

													<input type="hidden" name="foto_produto" value="<?= $pdf->pdf_arquivo ?>">
													<a href="<?= base_url('uploads/paginas/eleicoes_dos_conselhos/pdf/' . $pdf->pdf_arquivo) ?>"><i style="font-size: 25pt" class='far fa-file-pdf'></i></a>
													<input type="hidden" name="pdf_tamanho" value="<?= $pdf->pdf_tamanho ?>">
													<br>Tamanho: <span class="badge badge-info"><?= $pdf->pdf_tamanho ?></span>

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
