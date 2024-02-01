<div class="main-wrapper main-wrapper-1">

	<?php $this->load->view('restrita/layout/navbar'); ?>

	<?php $this->load->view('restrita/layout/sidebar'); ?>

	<!-- Main Content -->
	<div class="main-content">

		<section class="">
			<div class="section-body">

				<div class="row">
					<div class="col-12 col-md-12 col-lg-12">

						<div class="card">
							<?php if ($mensagem = $this->session->flashdata('erro')): ?>

							<div class="alert alert-danger alert-dismissible show fade">
								<div class="alert-body" style="color: white !important">
									<button class="close" data-dismiss="alert">
										<span>&times;</span>
									</button>
									<?php echo $mensagem; ?>
								</div>
							</div>

							<?php endif; ?>

							<form method="post" name="form_core">

								<div class="card-header">
									<h4><?php echo $titulo; ?></h4>
								</div>

								<div class="card-body">

									<div class="form-row">
										<div class="form-group col-md-12">
											<label class="text-info">Dimenssões max.: 1500x1500<br>Tam. max: 3MB<br>Extensões: PNG | JPG | SVG | GIF | WEBP<br>Clique no botão e selecione os banners</label>
											<div id="fileuploader"> </div>
											<div id="carregando"></div>
											<div id="erro_uploaded" class="text-danger"></div>
											<div id="icone_foto"></div>
											<div id="banner_foto"></div>
											<?php echo form_error('banners', '<div class="text-danger">', '</div>'); ?>
										</div>
									</div>

									<div class="form-row" id="uploaded_image">

									</div>

								</div>

								<?php $this->load->view('restrita/layout/btn-footer'); ?>

								


							</form>
						</div>


					</div>

				</div>

			</div>
		</section>


		<?php $this->load->view('restrita/layout/sidebar_configuracoes'); ?>


	</div>
