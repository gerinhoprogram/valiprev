<style>
	#logo_foto_troca img,
	#box-foto-logo img {
		width: 100%;
		height: 200px;
		object-fit: contain
	}
</style>
<?php $leitura = ($editar ? '' : 'readonly') ?>
<form action="" method="POST" name="form-index" accept_charset="utf-8">
	<div class="main-wrapper main-wrapper-1">

		<?php $this->load->view('restrita/layout/navbar'); ?>

		<?php $this->load->view('restrita/layout/sidebar'); ?>

		<!-- Main Content -->
		<div class="main-content">
			<section >
				<div class="section-body">

					<div class="row">
						<div class="col-12 col-md-12 col-lg-12">
							<div class="card">
								<div class="card-header">
									<h4>
										<?= $titulo ?>
									</h4>
								</div>

								<div class="card-body">

									<ul class="nav nav-tabs" id="myTab" role="tablist">
										<li class="nav-item">
											<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Dados básicos</a>
										</li>

										<li class="nav-item">
											<a class="nav-link" id="image-tab" data-toggle="tab" href="#image" role="tab" aria-controls="image" aria-selected="false">Redes sociais</a>
										</li>

										<li class="nav-item">
											<a class="nav-link" id="banner-tab" data-toggle="tab" href="#banner" role="tab" aria-controls="banner" aria-selected="false">Mídias</a>
										</li>

										<li class="nav-item">
											<a class="nav-link" id="banner-prog" data-toggle="tab" href="#banner-pro" role="tab" aria-controls="banner-pro" aria-selected="false">Banner Propaganda</a>
										</li>

										<li class="nav-item">
											<a class="nav-link" id="artigos-prog" data-toggle="tab" href="#artigos-pro" role="tab" aria-controls="artigos-pro" aria-selected="false">Artigos para destaque</a>
										</li>
										
									</ul>

									<div class="tab-content tab-bordered" id="myTabContent">

										<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

											<fieldset class="mb-4 border p-2">
												<legend class="font-md">Dados básicos</legend>
												<div class="form row">
													<div class="form-group col-md-12">
														<label>*Título do site / blog / sistema</label>
														<div class="input-group">
															<div class="input-group-prepend">
																<div class="input-group-text">
																	<i class="text-info fas fa-mobile-alt"></i>
																</div>
															</div>
															<input <?= $leitura ?> type="text" class="form-control" name="sistema_site_titulo" value="<?= (isset($sistema) ? $sistema->sistema_site_titulo : set_value('sistema_site_titulo')) ?>">
														</div>
														<?= form_error('sistema_site_titulo', '<div class="text-danger">', '</div>') ?>
														<div id="sistema_site_titulo"></div>
													</div>
													<div class="form-group col-md-12">
														<label>Descrição</label>
														
															
															<textarea <?= $leitura ?> class="form-control texto_editor" name="sistema_descricao"><?= $sistema->sistema_descricao ?></textarea>

													</div>
													<div class="form-group col-md-12">
														<label>Tags SEO</label>
														<div class="input-group">
															<div class="input-group-prepend">
																<div class="input-group-text">
																	<i class="text-info fas fa-laptop-code"></i>
																</div>
															</div>
															<textarea <?= $leitura ?> class="form-control" name="sistema_palavras_seo"><?= $sistema->sistema_palavras_seo ?></textarea>
														</div>
													</div>
												</div>
											</fieldset>

											<fieldset class="mb-4 border p-2">
												<legend class="font-md">Contato</legend>
												<div class="form row">
													<div class="form-group col-md-4">
														<label>Telefone</label>
														<div class="input-group">
															<div class="input-group-prepend">
																<div class="input-group-text">
																	<i class="text-info fas fa-phone"></i>
																</div>
															</div>
															<input <?= $leitura ?> type="text" class="form-control phone_with_ddd" name="sistema_telefone_fixo" value="<?= (isset($sistema) ? $sistema->sistema_telefone_fixo : set_value('sistema_telefone_fixo')) ?>">
														</div>
														<?= form_error('sistema_telefone_fixo', '<div class="text-danger">', '</div>') ?>
													</div>
													<div class="form-group col-md-4">
														<label>Whats</label>
														<div class="input-group">
															<div class="input-group-prepend">
																<div class="input-group-text">
																	<i class="text-info fab fa-whatsapp"></i>
																</div>
															</div>
															<input <?= $leitura ?> type="text" class="form-control sp_celphones" name="sistema_telefone_movel" value="<?= (isset($sistema) ? $sistema->sistema_telefone_movel : set_value('sistema_telefone_movel')) ?>">
														</div>
														<?= form_error('sistema_telefone_movel', '<div class="text-danger">', '</div>') ?>
													</div>
													<div class="form-group col-md-4">
														<label>E-mail</label>
														<div class="input-group">
															<div class="input-group-prepend">
																<div class="input-group-text">
																	<i class="text-info far fa-paper-plane"></i>
																</div>
															</div>
															<input <?= $leitura ?> type="email" class="form-control" name="sistema_email" value="<?= (isset($sistema) ? $sistema->sistema_email : set_value('sistema_email')) ?>">
														</div>
														<?= form_error('sistema_email', '<div class="text-danger">', '</div>') ?>
													</div>
												</div>
											</fieldset>

											<fieldset class="mb-4 border p-2">
												<legend class="font-md">Localização</legend>
												<div class="form row">
													<div class="form-group col-md-3">
														<label>CEP</label>
														<div class="input-group">
															<div class="input-group-prepend">
																<div class="input-group-text">
																<i class="text-info fas fa-map-marked"></i>
																</div>
															</div>
															<input <?= $leitura ?> type="text" class="form-control cep" name="sistema_cep" value="<?= (isset($sistema) ? $sistema->sistema_cep : set_value('sistema_cep')) ?>">
														</div>
														<?= form_error('sistema_cep', '<div class="text-danger">', '</div>') ?>
													</div>
													<div class="form-group col-md-9">
														<label>Endereço</label>
														<div class="input-group">
															<div class="input-group-prepend">
																<div class="input-group-text">
																	<i class="text-info fas fa-road"></i>
																</div>
															</div>
															<input <?= $leitura ?> type="text" class="form-control" name="sistema_endereco" value="<?= (isset($sistema) ? $sistema->sistema_endereco : set_value('sistema_endereco')) ?>">
														</div>
														<?= form_error('sistema_endereco', '<div class="text-danger">', '</div>') ?>
													</div>
													
												</div>

												<div class="form row">
													<div class="form-group col-md-2">
														<label>Estado</label>
														<div class="input-group">
															<div class="input-group-prepend">
																<div class="input-group-text">
																	<i class="text-info fas fa-globe-americas"></i>
																</div>
															</div>
															<?php if ($editar) : ?>
																<select class="custom-select" name="sistema_estado">
																	<option value="AC" <?= ($sistema->sistema_estado == 'AC' ? 'selected' : ''); ?>>AC</option>
																	<option value="AL" <?= ($sistema->sistema_estado == 'AL' ? 'selected' : ''); ?>>AL</option>
																	<option value="AP" <?= ($sistema->sistema_estado == 'AP' ? 'selected' : ''); ?>>AP</option>
																	<option value="AM" <?= ($sistema->sistema_estado == 'AM' ? 'selected' : ''); ?>>AM</option>
																	<option value="BA" <?= ($sistema->sistema_estado == 'BA' ? 'selected' : ''); ?>>BA</option>
																	<option value="CE" <?= ($sistema->sistema_estado == 'CE' ? 'selected' : ''); ?>>CE</option>
																	<option value="DF" <?= ($sistema->sistema_estado == 'DF' ? 'selected' : ''); ?>>DF</option>
																	<option value="ES" <?= ($sistema->sistema_estado == 'ES' ? 'selected' : ''); ?>>ES</option>
																	<option value="GO" <?= ($sistema->sistema_estado == 'GO' ? 'selected' : ''); ?>>GO</option>
																	<option value="MA" <?= ($sistema->sistema_estado == 'MA' ? 'selected' : ''); ?>>MA</option>
																	<option value="MT" <?= ($sistema->sistema_estado == 'MT' ? 'selected' : ''); ?>>MT</option>
																	<option value="MS" <?= ($sistema->sistema_estado == 'MS' ? 'selected' : ''); ?>>MS</option>
																	<option value="MG" <?= ($sistema->sistema_estado == 'MG' ? 'selected' : ''); ?>>MG</option>
																	<option value="PA" <?= ($sistema->sistema_estado == 'PA' ? 'selected' : ''); ?>>PA</option>
																	<option value="PB" <?= ($sistema->sistema_estado == 'PB' ? 'selected' : ''); ?>>PB</option>
																	<option value="PR" <?= ($sistema->sistema_estado == 'PR' ? 'selected' : ''); ?>>PR</option>
																	<option value="PE" <?= ($sistema->sistema_estado == 'PE' ? 'selected' : ''); ?>>PE</option>
																	<option value="PI" <?= ($sistema->sistema_estado == 'PI' ? 'selected' : ''); ?>>PI</option>
																	<option value="RJ" <?= ($sistema->sistema_estado == 'RJ' ? 'selected' : ''); ?>>RJ</option>
																	<option value="RN" <?= ($sistema->sistema_estado == 'RN' ? 'selected' : ''); ?>>RN</option>
																	<option value="RS" <?= ($sistema->sistema_estado == 'RS' ? 'selected' : ''); ?>>RS</option>
																	<option value="RO" <?= ($sistema->sistema_estado == 'RO' ? 'selected' : ''); ?>>RO</option>
																	<option value="RR" <?= ($sistema->sistema_estado == 'RR' ? 'selected' : ''); ?>>RR</option>
																	<option value="SC" <?= ($sistema->sistema_estado == 'SC' ? 'selected' : ''); ?>>SC</option>
																	<option value="SP" <?= ($sistema->sistema_estado == 'SP' ? 'selected' : ''); ?>>SP</option>
																	<option value="SE" <?= ($sistema->sistema_estado == 'SE' ? 'selected' : ''); ?>>SE</option>
																	<option value="TO" <?= ($sistema->sistema_estado == 'TO' ? 'selected' : ''); ?>>TO</option>
																</select>
															<?php else : ?>
																<input <?= $leitura ?> type="text" class="form-control" name="sistema_bairro" value="<?= (isset($sistema) ? $sistema->sistema_estado : set_value('sistema_bairro')) ?>">

															<?php endif ?>

														</div>
													</div>
													<div class="form-group col-md-4">
														<label>Cidade</label>
														<div class="input-group">
															<div class="input-group-prepend">
																<div class="input-group-text">
																	<i class="text-info fas fa-globe-americas"></i>
																</div>
															</div>
															<input <?= $leitura ?> type="text" class="form-control" name="sistema_cidade" value="<?= (isset($sistema) ? $sistema->sistema_cidade : set_value('sistema_cidade')) ?>">
														</div>
													</div>
													<div class="form-group col-md-4">
														<label>Bairro</label>
														<div class="input-group">
															<div class="input-group-prepend">
																<div class="input-group-text">
																	<i class="text-info fas fa-globe-americas"></i>
																</div>
															</div>
															<input <?= $leitura ?> type="text" class="form-control" name="sistema_bairro" value="<?= (isset($sistema) ? $sistema->sistema_bairro : set_value('sistema_bairro')) ?>">
														</div>
													</div>
													<div class="form-group col-md-2">
														<label>Número</label>
														<div class="input-group">
															<div class="input-group-prepend">
																<div class="input-group-text">
																<i class="text-info fas fa-sort-numeric-up"></i>
																</div>
															</div>
															<input <?= $leitura ?> type="text" class="form-control" name="sistema_numero" value="<?= (isset($sistema) ? $sistema->sistema_numero : set_value('sistema_numero')) ?>">
														</div>
													</div>
												</div>
											</fieldset>
										</div>

										<div class="tab-pane fade" id="image" role="tabpanel" aria-labelledby="contact-tab">

											<fieldset class="mb-4 border p-2">
												<legend class="font-md">Redes sociais</legend>

												<div class="form-group row">
													<div class="form-group col-md-6">
														<label>Instagram</label>
														<div class="input-group">
															<div class="input-group-prepend">
																<div class="input-group-text">
																	<i class="text-info fab fa-instagram"></i>
																</div>
															</div>
															<input <?= $leitura ?> type="text" class="form-control" name="sistema_instagram" value="<?= (isset($sistema) ? $sistema->sistema_instagram : set_value('sistema_instagram')) ?>">
														</div>
													</div>
													<div class="form-group col-md-6">
														<label>Facebook</label>
														<div class="input-group">
															<div class="input-group-prepend">
																<div class="input-group-text">
																	<i class="text-info fab fa-facebook"></i>
																</div>
															</div>
															<input <?= $leitura ?> type="text" class="form-control" name="sistema_facebook" value="<?= (isset($sistema) ? $sistema->sistema_facebook : set_value('sistema_facebook')) ?>">
														</div>
													</div>
													<div class="form-group col-md-6">
														<label>YouTube</label>
														<div class="input-group">
															<div class="input-group-prepend">
																<div class="input-group-text">
																	<i class="text-info fab fa-youtube"></i>
																</div>
															</div>
															<input <?= $leitura ?> type="text" class="form-control" name="sistema_you_tube" value="<?= (isset($sistema) ? $sistema->sistema_you_tube : set_value('sistema_you_tube')) ?>">
														</div>
													</div>
													<div class="form-group col-md-6">
														<label>Linkedin</label>
														<div class="input-group">
															<div class="input-group-prepend">
																<div class="input-group-text">
																	<i class="text-info fab fa-linkedin"></i>
																</div>
															</div>
															<input <?= $leitura ?> type="text" class="form-control" name="sistema_linkedin" value="<?= (isset($sistema) ? $sistema->sistema_linkedin : set_value('sistema_linkedin')) ?>">
														</div>
													</div>
													<div class="form-group col-md-6">
														<label>Behance</label>
														<div class="input-group">
															<div class="input-group-prepend">
																<div class="input-group-text">
																	<i class="text-info fab fa-behance"></i>
																</div>
															</div>
															<input <?= $leitura ?> type="text" class="form-control" name="sistema_behance" value="<?= (isset($sistema) ? $sistema->sistema_behance : set_value('sistema_behance')) ?>">
														</div>
													</div>
													<div class="form-group col-md-6">
														<label>Link site</label>
														<div class="input-group">
															<div class="input-group-prepend">
																<div class="input-group-text">
																	<i class="text-info fas fa-external-link-alt"></i>
																</div>
															</div>
															<input <?= $leitura ?> type="text" class="form-control" name="sistema_link_site" value="<?= (isset($sistema) ? $sistema->sistema_link_site : set_value('sistema_link_site')) ?>">
														</div>
													</div>
												</div>

											</fieldset>
										</div>

										<div class="tab-pane fade" id="banner" role="tabpanel" aria-labelledby="banner-tab">
											<fieldset class="mb-4 border p-2">
												<legend class="font-md">Logo principal (Para fundo escuro)</legend>

												<div class="form-group row">

													<?php if ($editar) : ?>
														<div class="form-group col-md-12">
															<label>(PNG | JPG | WEBP | Tam. max.: 2MB | 1950x600 )</label>
															<div class="input-group">
																<div class="input-group-prepend">
																	<div class="input-group-text">
																		<i class="text-info fas fa-image"></i>
																	</div>
																</div>
																<input type="file" class="form-control" name="sistema_logo">
															</div>
															<div id="logo_foto_troca"></div>
															<?= form_error('sistema_logo', '<small id="emailHelp" class="form-text text-danger">', '</small>'); ?>

														</div>
													<?php endif ?>

													<div class="form-group col-md-12">
														<div id="box-foto-logo bg-dark">
															<figure class="bg-dark">
															<input type="hidden" name="logo_foto_troca" value="<?= $sistema->sistema_logo ?>">
															<img style="height: 150px; width: 100%; object-fit: contain" src="<?= base_url('uploads/sistema/logo/' . $sistema->sistema_logo) ?>" alt="" class=''>
															</figure>
														</div>
													</div>

												</div>
											</fieldset>

											<fieldset class="mb-4 border p-2">
												<legend class="font-md">Logo secundário (Para fundo claro)</legend>

												<div class="form-group row">

													<?php if ($editar) : ?>
														<div class="form-group col-md-12">
															<label>(PNG | JPG | WEBP | Tam. max.: 2MB | 1950x600 )</label>
															<div class="input-group">
																<div class="input-group-prepend">
																	<div class="input-group-text">
																		<i class="text-info fas fa-image"></i>
																	</div>
																</div>
																<input type="file" class="form-control" name="sistema_logo_2">
															</div>
															<div id="logo_foto_troca_2"></div>
															<?= form_error('sistema_logo_2', '<small id="emailHelp" class="form-text text-danger">', '</small>'); ?>

														</div>
													<?php endif ?>

													<div class="form-group col-md-12">
														<div id="box-foto-logo_2">
															<figure>
															<input type="hidden" name="logo_foto_troca_2" value="<?= $sistema->sistema_logo_2 ?>">
															<img style="height: 150px; width: 100%; object-fit: contain" src="<?= base_url('uploads/sistema/logo/' . $sistema->sistema_logo_2) ?>" alt="" class=''>
															</figure>
														</div>
													</div>

												</div>
											</fieldset>

											<fieldset class="mb-4 border p-2">
												<legend class="font-md">Ícone</legend>

												<div class="form-group row">
													<?php if ($editar) : ?>
														<div class="form-group col-md-12">
															<label>(PNG | JPG | Tam. max.: 100 KB | 150x150)</label>
															<div class="input-group">
																<div class="input-group-prepend">
																	<div class="input-group-text">
																		<i class="text-info fas fa-image"></i>
																	</div>
																</div>
																<input type="file" class="form-control" name="sistema_icon">
															</div>
															<div id="icon_foto_troca"></div>
															<?= form_error('sistema_icon', '<small id="emailHelp" class="form-text text-danger">', '</small>'); ?>

														</div>
													<?php endif ?>

													<div class="form-group col-md-12">
														<div id="box-foto-icon">
															<input type="hidden" name="icon_foto_troca" value="<?= $sistema->sistema_icon ?>">
															<img src="<?= base_url('uploads/sistema/icone/' . $sistema->sistema_icon) ?>" alt="" style="height: 80px; width: 100%; object-fit: contain">
														</div>
													</div>

												</div>
											</fieldset>

											<fieldset class="mb-4 border p-2">
												<legend class="font-md">Gif animado</legend>

												<div class="form-group row">
													<?php if ($editar) : ?>
														<div class="form-group col-md-12">
															<label>(PNG | GIF | Tam. max.: 2MB | 1950x600)</label>
															<div class="input-group">
																<div class="input-group-prepend">
																	<div class="input-group-text">
																		<i class="text-info fas fa-image"></i>
																	</div>
																</div>
																<input type="file" class="form-control" name="sistema_gif">
															</div>
															<div id="gif_foto_troca"></div>
															<?= form_error('sistema_gif', '<small id="emailHelp" class="form-text text-danger">', '</small>'); ?>

														</div>
													<?php endif ?>

													<div class="form-group col-md-12">
														<div id="box-foto-gif">
															<input type="hidden" name="gif_foto_troca" value="<?= $sistema->sistema_gif ?>">
															<img src="<?= base_url('uploads/sistema/gif/' . $sistema->sistema_gif) ?>" style="height: 150px; width: 100%; object-fit: contain">
														</div>
													</div>

												</div>
											</fieldset>
										</div>

										<div class="tab-pane fade" id="banner-pro" role="tabpanel" aria-labelledby="banner-prog">
											<div class="form-group row">
												<?php foreach($banners as $banner) :?>

													<div class="form-group col-4">
													<div class="card">
														<div class="card-header">
															<h4><?=$banner->banner_titulo?></h4>
															<div class="card-header-action">
															
																<input type="radio"  name="banner" value="<?=$banner->banner_id?>" <?=($banner->banner_status ? 'checked' : '')?>>

															</div>
														</div>
														<div class="card-body">
															<div class="mb-2"><?= $banner->banner_medida . ' | ' . $banner->banner_tamanho . ' | ' . $banner->banner_tipo ?></div>
															<div class="chocolat-parent">
															<a href="<?=base_url('uploads/banners_site/'.$banner->banner_imagem)?>" class="chocolat-image" title="Just an example">
																<div data-crop-image="150">
																<img alt="image" src="<?=base_url('uploads/banners_site/'.$banner->banner_imagem)?>" class="img-fluid" style="height: 150px; width: 100%; object-fit: contain">
																</div>
															</a>
															</div>
														</div>
													</div>
													</div>

												<?php endforeach ?>
											</div>
										</div>

										<div class="tab-pane fade" id="artigos-pro" role="tabpanel" aria-labelledby="artigos-prog">

											<div class="form-group row">
												<?php foreach($artigos as $artigo) :?>
													<div class="form-group col-3">
													<div id="card_<?=$artigo->artigo_id?>" class="card_artigos card <?=($artigo->artigo_destaque ? 'card-warning' : 'card-primary')?>">
														<div class="card-header">
															<h4>
															<input type="radio"  name="artigos" value="<?=$artigo->artigo_id?>" <?=($artigo->artigo_destaque ? 'checked' : '')?>>
															</h4>
															
															<div class="card-header-action">
															<a href="<?=base_url('detalhes/'.$artigo->artigo_url)?>" target="_blank" class="btn <?=($artigo->artigo_destaque ? 'btn-warning' : 'btn-primary')?>">
																Ver artigo
															</a>
															</div>
														</div>
														<div class="card-body">
															<p><?=$artigo->artigo_titulo?></p>
														</div>
													</div>
													</div>
												<?php endforeach ?>
											</div>

										</div>

									</div>

								</div>
								
									<?php if ($editar) : ?>
										<?php $this->load->view('restrita/layout/btn-footer'); ?>
									<?php endif ?>
							</div>

						</div>

					</div>

				</div>

			</section>
			<?php $this->load->view('restrita/layout/sidebar_configuracoes'); ?>
		</div>

		
</form>

<?php $this->load->view('restrita/layout/editor_texto'); ?>