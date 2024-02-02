<style>
	.custom-control-label:hover{
		cursor: pointer;
	}
</style>
<form method="post" name="form_core" >


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
											
											<?php echo form_error('pdf_descricao', '<div class="text-danger">', '</div>'); ?>

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
												<input type="hidden" name="logo_foto_troca" value="<?= $pagina->cont_foto ?>">
												<img style="height: 150px; width: 100%; object-fit: contain" src="<?= base_url('uploads/paginas/' . $this->router->fetch_class() . '/' . $pagina->cont_foto) ?>" alt="" class=''>

											</div>
										</div>

										

									</div>
									


								</div>
								<?php if (isset($pdf)) : ?>
									<input type="hidden" name="pdf_id" value="<?php echo $pdf->pdf_id; ?>">
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
