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

									<ul class="nav nav-tabs" id="myTab" role="tablist">
										<li class="nav-item">
											<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Dados básicos</a>
										</li>

										<li class="nav-item">
											<a class="nav-link" id="image-tab" data-toggle="tab" href="#image" role="tab" aria-controls="image" aria-selected="false">FAQ</a>
										</li>


									</ul>

									<div class="tab-content tab-bordered" id="myTabContent">

										<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

											<div class="form-row">
												<div class="form-group col-12">
													<p>Nome da página: <?php echo $pagina->pag_nome; ?> (tag H1)</p>
													<p>
														<?=$pagina->pag_status ? '<span class="badge badge-success m-2">Página ativa</span>' : '<span class="badge badge-danger m-2">Página inativa</span>'?>
														<?=$pagina->pag_pdf ? '<a href="'.base_url('restrita/'.$this->router->fetch_class().'/pdf_listagem/'.$pagina->pag_id).'"><span class="badge badge-info m-2">PDFs da página</span></a>' : ''?>

													</p>

												</div>
											</div>

											<div class="form-row">

												<div class="form-group col-md-12">
													<label>* Título da página (tag H2)<small class="titulo text-info"></small></label>
													<div class="input-group">
														<div class="input-group-prepend">
															<div class="input-group-text">
																<i class="fas fa-cube text-info"></i>
															</div>
														</div>
														<input autofocus type="text" id="cont_titulo" class="form-control" name="cont_titulo" value="<?php echo (isset($pagina) ? $pagina->cont_titulo : set_value('cont_titulo')); ?>">
													</div>

													<?php echo form_error('cont_titulo', '<div class="text-danger">', '</div>'); ?>

												</div>

												<div class="form-group col-md-12">
													<label>Subtitulo da página (tag H3)<small class="titulo text-info"></small></label>
													<div class="input-group">
														<div class="input-group-prepend">
															<div class="input-group-text">
																<i class="fas fa-cube text-info"></i>
															</div>
														</div>
														<input type="text" id="cont_subtitulo" class="form-control" name="cont_subtitulo" value="<?php echo (isset($pagina) ? $pagina->cont_subtitulo : set_value('cont_subtitulo')); ?>">
													</div>

													<?php echo form_error('cont_subtitulo', '<div class="text-danger">', '</div>'); ?>

												</div>


											</div>

											<div class="form-group row">

												<div class="form-group col-md-12">
													<label>Foto/Banner (PNG | JPG | WEBP | Tam. max.: 6MB | 1950x600 )</label>
													<div class="input-group">
														<div class="input-group-prepend">
															<div class="input-group-text">
																<i class="text-info fas fa-image"></i>
															</div>
														</div>
														<input type="file" class="form-control" name="cont_foto">
													</div>
													<div id="logo_foto_troca"></div>
													<?= form_error('cont_foto', '<small id="emailHelp" class="form-text text-danger">', '</small>'); ?>

												</div>

												<div class="form-group col-md-12">
													<div id="box-foto-logo">
														<input type="hidden" name="logo_foto_troca" value="<?= $pagina->cont_foto ?>">
														<img style="height: 150px; width: 100%; object-fit: contain" src="<?= base_url('uploads/paginas/' . $this->router->fetch_class() . '/' . $pagina->cont_foto) ?>" alt="" class=''>

													</div>
												</div>

											</div>

										</div>
										
										<div class="tab-pane fade" id="image" role="tabpanel" aria-labelledby="contact-tab">

											<a data-toggle="tooltip" data-placement="Top" title="Adicionar FAQ" href="javascript:;" class="add_faq btn btn-success mt-2 mb-4"><i class="fa fa-plus-circle"></i> Adicionar nova dúvida</a>
											<div class="input_fields_wrap form-row">
												<?php if (isset($pagina)) : ?>
													<?php foreach ($faq as $s) : ?>
														<div class="form-group col-12">
															
															<label for="">Dúvida</label>
															<input type="text" value="<?= $s->cep_titulo ?>" class="form-control mb-3" name="cep_titulo[]" />
															<label for="">Resposta</label>
															<textarea name="cep_texto[]" class="form-control texto_editor"><?= $s->cep_texto ?></textarea>
															
															<a href="#" class="btn btn-danger remove_seo mt-1">Remover</a>
														</div>
													<?php endforeach ?>
												<?php endif ?>
											</div>

										</div>


									</div>

								</div>



								<?php if (isset($pagina)) : ?>
									<input type="hidden" name="pag_id" value="<?php echo $pagina->pag_id; ?>">
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
<?php $this->load->view('restrita/layout/editor_texto'); ?>
