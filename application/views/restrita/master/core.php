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
											<a class="nav-link" id="image-tab" data-toggle="tab" href="#image" role="tab" aria-controls="image" aria-selected="false">ícones</a>
										</li>


									</ul>

									<div class="tab-content tab-bordered" id="myTabContent">

										<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

											<div class="form-row">

												<div class="form-group col-md-8">
													<label>* Título <small class="titulo text-info"></small></label>
													<div class="input-group">
														<div class="input-group-prepend">
															<div class="input-group-text">
																<i class="fas fa-cube text-info"></i>
															</div>
														</div>
														<input autofocus type="text" id="categoria_pai_nome" class="form-control" name="categoria_pai_nome" value="<?php echo (isset($categoria) ? $categoria->categoria_pai_nome : set_value('categoria_pai_nome')); ?>">
													</div>
													
													<?php echo form_error('categoria_pai_nome', '<div class="text-danger">', '</div>'); ?>

												</div>

												<div class="form-group col-md-4">
													<label>Status</label>
													<div class="input-group">
														<div class="input-group-prepend">
															<div class="input-group-text">
																<i class="fas fa-check-circle text-info"></i>
															</div>
														</div>
														<select class="custom-select" name="categoria_pai_ativa">

															<?php if (isset($categoria)) : ?>

																<option value="0" <?php echo ($categoria->categoria_pai_ativa == 0 ? 'selected' : ''); ?>>Inativo</option>
																<option value="1" <?php echo ($categoria->categoria_pai_ativa == 1 ? 'selected' : ''); ?>>Ativo</option>

															<?php else : ?>

																<option value="1">Ativo</option>
																<option value="0">Inativo</option>

															<?php endif; ?>

														</select>
													</div>
												</div>

												<!-- <div class="form-group col-md-6">
													<label>Cor</label>
													<div class="input-group">
														<div class="input-group-prepend">
															<div class="input-group-text">
																<i class="fa fa-paint-brush text-info"></i>
															</div>
														</div>
														<input type="color" style="height: 150px" class="form-control" name="categoria_pai_cor" value="">
													</div>
												</div> -->

											</div>

										</div>
										<div class="tab-pane fade" id="image" role="tabpanel" aria-labelledby="contact-tab">

											
												<p class="mb-3">Escolha um Ícone para a categoria</p>
												
												<div style="overflow: auto; height: 500px">
												<?php if (isset($categoria)) : ?>
													<div class="icon-container row">
														<?php foreach ($icones as $icone) : ?>
															

															<div class="col-sm-6 col-md-3 col-lg-1">
															<label for="icones<?= $icone->icone_id ?>">
																<div class="preview">
																	<div class="icon-preview">
																		<i class="text-info <?=$icone->icone_nome?>"></i>
																	</div>
																	<div class="icon-class"><input <?= ($categoria->categoria_pai_classe_icone == $icone->icone_nome ? 'checked' : '') ?>  id="icones<?= $icone->icone_id ?>" type="radio" name="categoria_pai_classe_icone" value="<?= $icone->icone_nome ?>"></div>

																</div>
																</label>

																
															</div>
														<?php endforeach ?>
													</div>
												<?php else : ?>
													<div class="icon-container row">
														<?php $cont = 0 ?>
														<?php foreach ($icones as $icone) : ?>
															<div class="col-sm-12 col-md-4 col-lg-1">
																
																<label for="icones<?= $icone->icone_id ?>">
																<div class="preview">
																	<div class="icon-preview">
																		<i class="text-info <?=$icone->icone_nome?>"></i>
																	</div>
																	<div class="icon-class"><input id="icones<?= $icone->icone_id ?>" type="radio" <?= ($cont == 0 ? 'checked' : '') ?> name="categoria_pai_classe_icone" value="<?= $icone->icone_nome ?>"></div>
																	
																</div>
																</label>

																
															</div>
															
															<?php $cont++ ?>
														<?php endforeach ?>
													</div>
												<?php endif ?>

												</div>
										</div>


									</div>

								</div>

								

										<?php if (isset($categoria)) : ?>
											<input type="hidden" name="categoria_pai_id" value="<?php echo $categoria->categoria_pai_id; ?>">
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