<style>
	.body-artigos label {
		cursor: pointer;
	}
</style>
<form method="post" name="form_core">
	<div class="main-wrapper main-wrapper-1">
		<?php $this->load->view('restrita/layout/navbar'); ?>
		<?php $this->load->view('restrita/layout/sidebar'); ?>

		<div class="main-content">
			<section>
				<div class="section-body">
					<div class="row">
						<div class="col-12 col-md-12 col-lg-12">
							<div class="card">

								<div class="card-header">
									<h4><?= $titulo; ?></h4>
								</div>
								<div class="card-body body-artigos">

									<ul class="nav nav-tabs" id="myTab" role="tablist">
										<li class="nav-item">
											<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Dados básicos</a>
										</li>

										<li class="nav-item">
											<a class="nav-link" id="banners-tab" data-toggle="tab" href="#banners" role="tab" aria-controls="banners" aria-selected="false">Banners CTA</a>
										</li>

										<li class="nav-item">
											<a class="nav-link" id="semelhantes-tab" data-toggle="tab" href="#semelhantes" role="tab" aria-controls="semelhantes" aria-selected="false">Artigos semelhantes</a>
										</li>

										<li class="nav-item">
											<a class="nav-link" id="image-tab" data-toggle="tab" href="#image" role="tab" aria-controls="image" aria-selected="false">Fotos</a>
										</li>

										<li class="nav-item">
											<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Texto</a>
										</li>
									</ul>
									<div class="tab-content tab-bordered" id="myTabContent">

										<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
											<div class="form-row">

												<div class="form-group col-md-12">
													<label>* Título do artigo <small class="titulo text-info"></small></label>
													<div class="input-group">
														<div class="input-group-prepend">
															<div class="input-group-text">
																<i class="fas fa-cube text-info"></i>
															</div>
														</div>
														<input id="nome" autofocus type="text" class="form-control" name="artigo_titulo" value="<?= (isset($artigo) ? $artigo->artigo_titulo : set_value('artigo_titulo')); ?>">
													</div>
													<?= form_error('artigo_titulo', '<div class="text-danger">', '</div>'); ?>
													<div id="artigo_titulo"></div>
												</div>

												<div class="form-group col-md-12">
													<label>Legenda <small class="legenda text-info"></small></label>
													<div class="input-group">
														<div class="input-group-prepend">
															<div class="input-group-text">
																<i class="fas fa-stream text-info"></i>
															</div>
														</div>
														<input type="text" id="legenda" class="form-control" name="artigo_legenda" value="<?= (isset($artigo) ? $artigo->artigo_legenda : set_value('artigo_legenda')); ?>">
													</div>
													<?= form_error('artigo_legenda', '<div class="text-danger">', '</div>'); ?>
												</div>

												<div class="form-group col-md-12">
													<fieldset class="border p-2">
														<legend>Categorias e subcategorias</legend>
														<label class="mr-3">* Categoria principal</label>
														<div class="input-group">
															<div class="input-group-prepend">
																<div class="input-group-text">
																	<i class="fas fa-list-ol text-info"></i>
																</div>
															</div>
															<select id="master" class="form-control js-example-basic-single" name="artigo_categoria_pai_id">


																<?php if (isset($artigo)) : ?>

																	<?php foreach ($categorias_pai as $cat_pai) : ?>
																		<option value="<?= $cat_pai->categoria_pai_id; ?>" <?= ($artigo->artigo_categoria_pai_id == $cat_pai->categoria_pai_id ? 'selected' : '') ?>><?= $cat_pai->categoria_pai_nome; ?></option>
																	<?php endforeach; ?>

																<?php else : ?>

																	<option value="">Escolha uma categoria</option>

																	<?php foreach ($categorias_pai as $cat_pai) : ?>
																		<option value="<?= $cat_pai->categoria_pai_id; ?>"><?= $cat_pai->categoria_pai_nome; ?></option>
																	<?php endforeach; ?>

																<?php endif ?>

															</select>
														</div>
														<?= form_error('artigo_categoria_pai_id', '<div class="text-danger">', '</div>'); ?>


														<?php if (isset($artigo)) : ?>

															<div class="form-group col-md-12">
																<label class="mr-3">Categorias secundárias (Selecione várias)</label>
																<div id="artigo_categoria" class="p-2">
																	<?php foreach ($subcategorias_do_artigo as $sub) : ?>
																		<div class="custom-control custom-radio custom-control-inline badge badge-info"><input type="checkbox" id="<?= $sub->categoria_id ?>" class="custom-control-input sucategoria_artigo" value="<?= $sub->categoria_id ?>" checked name="artigo_categoria_id[]"><label class="custom-control-label" for="<?= $sub->categoria_id ?>"><?= $sub->categoria_nome ?></label></div>
																	<?php endforeach ?>
																	<?php foreach ($subcategorias as $sub) : ?>
																		<?php if ($sub->categoria_pai_id == $artigo->artigo_categoria_pai_id) {
																			echo '<div class="custom-control custom-radio custom-control-inline badge badge-info"><input type="checkbox" id="' . $sub->categoria_id . '" class="custom-control-input sucategoria_artigo" value="' . $sub->categoria_id . '" name="artigo_categoria_id[]"><label class="custom-control-label" for="' . $sub->categoria_id . '">' . $sub->categoria_nome . '</label></div>';
																		} ?>

																	<?php endforeach ?>
																</div>
															</div>

														<?php else : ?>

															<div class="form-group col-md-12">
																<!-- <label class="mr-3">Categorias secundárias (Selecione várias)</label> -->
																<div id="artigo_categoria" class="p-2">

																</div>
															</div>

														<?php endif ?>
													</fieldset>
												</div>

												<div class="form-group col-md-12">
													<fieldset class="border p-2">
														<legend>Adicione palavras tags ao seu artigo</legend>
														<small class="text-info">Facilita no sistema de buscas</small><br>
														<a data-toggle="tooltip" data-placement="Top" title="Clique para adionar nova palavra" href="javascript:;" class="add_seo btn btn-success mt-2 mb-4"><i class="fa fa-plus-circle"></i> Adicionar nova Tag</a>
														<div class="input_fields_wrap form-row">
															<?php if (isset($artigo)) : ?>
																<?php foreach ($seo as $s) : ?>
																	<div class="form-group col-md-2 p-1">
																		<div class="input-group">
																			<div class="input-group-prepend">
																				<div class="input-group-text"><i class="fa fa-hashtag text-info"></i></div>
																			</div><input type="text" value="<?= $s->seo_palavra ?>" class="form-control" name="artigo_seo[]" />
																		</div><a href="#" class="btn btn-danger remove_seo mt-1">Remover</a>
																	</div>
																<?php endforeach ?>
															<?php endif ?>
														</div>
													</fieldset>
												</div>



											</div>
										</div>

										<div class="tab-pane fade show" id="banners" role="tabpanel" aria-labelledby="banners-tab">
											<div class="form-row">
												<div class="form-group col-md-12">
													<p class="text-info">Escolha os banners que aparecerão no seu artigo (Não é obrigatório)</p>
												</div>


												<?php if (isset($artigo)) : ?>
													<?php foreach ($banners_do_artigo as $cta) { ?>
														<div class="form-group col-md-3 border p-2 text-center">
															<small><?= $cta->banner_titulo ?></small>
															<img src="<?= base_url('uploads/banners_site/' . $cta->banner_imagem) ?>" style="width: 100%; object-fit: contain; height: 80px" alt="">
															<div class="custom-control custom-radio custom-control-inline badge mt-2 badge-warning"><input type="checkbox" checked id="<?= $cta->banner_id ?>" class="custom-control-input" value="<?= $cta->banner_id ?>" name="artigo_banner_cta[]"><label class="custom-control-label" for="<?= $cta->banner_id ?>">Clique para selecionar</label></div><br>
															<span class="badge badge-info m-1"><?= $cta->banner_medida ?></span>
															<span class="badge badge-info m-1"><?= $cta->banner_tipo ?></span>
															<span class="badge badge-info m-1"><?= $cta->banner_tamanho ?></span>
														</div>
													<?php } ?>
													<?php foreach ($banners as $cta) { ?>
														<div class="form-group col-md-3 border p-2 text-center">
															<small><?= $cta->banner_titulo ?></small>
															<img src="<?= base_url('uploads/banners_site/' . $cta->banner_imagem) ?>" style="width: 100%; object-fit: contain; height: 80px" alt="">
															<div class="custom-control custom-radio custom-control-inline badge mt-2 badge-warning""><input type=" checkbox" id="<?= $cta->banner_id ?>" class="custom-control-input" value="<?= $cta->banner_id ?>" name="artigo_banner_cta[]"><label class="custom-control-label" for="<?= $cta->banner_id ?>">Clique para selecionar</label></div><br>
															<span class="badge badge-info m-1"><?= $cta->banner_medida ?></span>
															<span class="badge badge-info m-1"><?= $cta->banner_tipo ?></span>
															<span class="badge badge-info m-1"><?= $cta->banner_tamanho ?></span>
														</div>
													<?php } ?>
												<?php else : ?>


													<?php foreach ($banners as $cta) : ?>
														<div class="form-group col-md-3 border p-2 text-center">
															<small><?= $cta->banner_titulo ?></small>
															<img src="<?= base_url('uploads/banners_site/' . $cta->banner_imagem) ?>" style="width: 100%; object-fit: contain; height: 80px" alt="">
															<div class="custom-control custom-radio custom-control-inline badge mt-2 badge-warning"><input type="checkbox" id="<?= $cta->banner_id ?>" class="custom-control-input" value="<?= $cta->banner_id ?>" name="artigo_banner_cta[]"><label class="custom-control-label" for="<?= $cta->banner_id ?>">Clique para selecionar</label></div><br>
															<span class="badge badge-info m-1"><?= $cta->banner_medida ?></span>
															<span class="badge badge-info m-1"><?= $cta->banner_tipo ?></span>
															<span class="badge badge-info m-1"><?= $cta->banner_tamanho ?></span>
														</div>
													<?php endforeach ?>

												<?php endif ?>


											</div>
										</div>

										<div class="tab-pane fade show" id="semelhantes" role="tabpanel" aria-labelledby="semelhantes-tab">
											<div class="form-row">

												<div class="form-group col-md-12">
													<p class="text-info">Selecione artigos com conteúdo semelhante ao seu (Não é obrigatório)</p>
													<div class="p-2">
														<?php if (isset($artigo)) : ?>

															<?php foreach ($artigos_semelhantes_do_artigo as $art_do_artigo) { ?>

																<div class="custom-control custom-radio custom-control-inline badge badge-warning mb-2 text-center"><input type="checkbox" checked id="<?= $art_do_artigo->artigo_id ?>" class="custom-control-input" value="<?= $art_do_artigo->artigo_id ?>" name="artigos_semelhantes[]"><label class="custom-control-label" for="<?= $art_do_artigo->artigo_id ?>"><?= $art_do_artigo->artigo_titulo ?></label></div>

															<?php } ?>

															<?php foreach ($artigos_semelhantes as $art) { ?>

																<div class="custom-control custom-radio custom-control-inline badge badge-warning mb-2 text-center"><input type="checkbox" id="<?= $art->artigo_id ?>" class="custom-control-input" value="<?= $art->artigo_id ?>" name="artigos_semelhantes[]"><label class="custom-control-label" for="<?= $art->artigo_id ?>"><?= $art->artigo_titulo ?></label></div>


															<?php } ?>

														<?php else : ?>

															<?php foreach ($todos_artigos as $art) : ?>
																<div class="custom-control custom-radio custom-control-inline badge badge-warning mb-2 text-center"><input type="checkbox" id="<?= $art->artigo_id ?>" class="custom-control-input" value="<?= $art->artigo_id ?>" name="artigos_semelhantes[]"><label class="custom-control-label" for="<?= $art->artigo_id ?>"><?= $art->artigo_titulo ?></label></div>
															<?php endforeach ?>

														<?php endif ?>
													</div>
												</div>

											</div>
										</div>

										<div class="tab-pane fade" id="image" role="tabpanel" aria-labelledby="contact-tab">
											<div class="form-row">



												<div class="form-group col-md-12">
													<label>Dimensões max.: 3000x3000 <br>Extensões: PNG | JPG | GIF | SGV | WEBP <br>Tamanho max.: 3MB</label>
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

														<?php if (isset($fotos_artigo)) : ?>
															<?php foreach ($fotos_artigo as $foto) : ?>

																<div class="form-group col-md-3">


																	<img src="<?= base_url('uploads/artigos/' . $foto->foto_nome) ?>" alt="" style="height: 150px; width: 100%; object-fit: contain" class="img-thumbnail">
																	<input type="text" placeholder="Título da foto" class="form-control mt-2" name="foto_titulo[]" value="<?= $foto->foto_titulo ?>">
																	<div class="custom-control custom-radio"><input type="radio" class="mt-2 mb-4" name="foto_principal" id="<?= $foto->foto_nome ?>" <?= $foto->foto_principal ? 'checked' : '' ?> value="<?= $foto->foto_nome ?>"><label for="<?= $foto->foto_nome ?>" class="mt-2 ml-2"><?= $foto->foto_principal ? 'Foto principal' : '' ?></label></div>
																	<input type="hidden" class="imagem" id="fotos" name="fotos_produtos[]" value="<?= $foto->foto_nome ?>">
																	<button type="button" class="btn btn-danger btn-remove" style="width: 45px">X</button>


																</div>

															<?php endforeach ?>
														<?php else : ?>
															<div id="box-foto-produto"></div>
														<?php endif ?>

													</div>
												</div>

											</div>
										</div>

										<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
											<div class="form-row">
												<div class="form-group col-md-12">
													<label>* Texto do artigo</label>
													<textarea id="texto_artigo" class="texto_editor form-control" name="artigo_descricao" style="min-height: 200px"><?= (isset($artigo) ? $artigo->artigo_descricao : '') ?></textarea>
													<?= form_error('artigo_descricao', '<div class="text-danger">', '</div>'); ?>
												</div>


											</div>

										</div>
									</div>

								</div>

								<?php if (isset($artigo)) : ?>
									<input type="hidden" id="artigo_id" name="artigo_id" value="<?= $artigo->artigo_id; ?>">
								<?php endif; ?>


								<?php $this->load->view('restrita/layout/btn-footer'); ?>
							</div>

						</div>

					</div>
			</section>

			<?php $this->load->view('restrita/layout/sidebar_configuracoes'); ?>
		</div>


	</div>
</form>
<?php $this->load->view('restrita/layout/editor_texto'); ?>
