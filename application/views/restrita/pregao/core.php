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
											<label>* Nome <small class="titulo text-info"></small></label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fas fa-user-tie text-info"></i>
													</div>
												</div>
												<input id="titulo" type="text" class="form-control" name="pre_titulo" value="<?php echo (isset($pregao) ? $pregao->pre_titulo : set_value('pre_titulo')); ?>">
											</div>
											<?php echo form_error('pre_titulo', '<div class="text-danger">', '</div>'); ?>

										</div>

										<div class="form-group col-md-2">
                                            <label>Estado</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-check-circle text-info"></i>
                                                    </div>
                                                </div>
                                                <select class="custom-select" name="pre_estado">

                                                    <?php if (isset($pregao)): ?>

                                                        <option value="0" <?php echo ($pregao->$pre_estado == 0 ? 'selected' : ''); ?>>Inativo</option>
                                                        <option value="1" <?php echo ($pregao->$pre_estado == 1 ? 'selected' : ''); ?>>Aberta</option>

                                                    <?php else: ?>

                                                        <option value="Aberta">Aberta</option>
                                                        <option value="0">Inativo</option>

                                                    <?php endif; ?>

                                                </select>
                                            </div>
                                        </div>

										<div class="form-group col-md-3">
                                            <label>Modalidade</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-check-circle text-info"></i>
                                                    </div>
                                                </div>
                                                <select class="custom-select" name="pre_modalidade">

                                                    <?php if (isset($pregao)): ?>

                                                        <option value="0" <?php echo ($pregao->$pre_estado == 0 ? 'selected' : ''); ?>>Inativo</option>
                                                        <option value="Pregão presencial" <?php echo ($pregao->$pre_estado == 'Pregão presencial' ? 'selected' : ''); ?>>Pregão presencial</option>

                                                    <?php else: ?>

                                                        <option value="Pregão presencial">Pregão presencial</option>

                                                    <?php endif; ?>

                                                </select>
                                            </div>
                                        </div>

										<div class="form-group col-md-7">
											<label>* Processo de Compras/Administrativo <small class="processo text-info"></small></label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fas fa-user-tie text-info"></i>
													</div>
												</div>
												<input id="processo" type="text" class="form-control" name="pre_processo" value="<?php echo (isset($pregao) ? $pregao->pre_processo : set_value('pre_processo')); ?>">
											</div>
											<?php echo form_error('pre_processo', '<div class="text-danger">', '</div>'); ?>

										</div>

										<div class="form-group col-md-12">
										<label for="">Objetivo</label>
										<textarea name="pre_objetivo" id="objetivo" class="form-control">
											<?=(isset($pregao) ? $pregao->pre_objetivo : '' )?>
										</textarea>
										<?php echo form_error('pre_objetivo', '<div class="text-danger">', '</div>'); ?>
										</div>

										<div class="form-group col-md-7">
											<label>* Entrega dos envelopes <small class="entrega text-info"></small></label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fas fa-user-tie text-info"></i>
													</div>
												</div>
												<input id="entrega" type="text" class="form-control" name="pre_entrega" value="<?php echo (isset($pregao) ? $pregao->pre_entrega : set_value('pre_entrega')); ?>">
											</div>
											<?php echo form_error('pre_entrega', '<div class="text-danger">', '</div>'); ?>

										</div>

										<div class="form-group col-md-6">
                                            <label>Tipo</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-check-circle text-info"></i>
                                                    </div>
                                                </div>
                                                <select class="custom-select" name="pre_tipo">

                                                    <?php if (isset($pregao)): ?>

                                                        <option value="0" <?php echo ($pregao->$pre_estado == 0 ? 'selected' : ''); ?>>Inativo</option>
                                                        <option value="Pregão presencial" <?php echo ($pregao->$pre_estado == 'Pregão presencial' ? 'selected' : ''); ?>>Pregão presencial</option>

                                                    <?php else: ?>

                                                        <option value="Menor preço por item">Menor preço por item</option>
														<option value="Menor preço global">Menor preço global</option>

                                                    <?php endif; ?>

                                                </select>
                                            </div>
                                        </div>

										

									</div>

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

														<?php if (isset($pregao)) : ?>
															<?php foreach ($documentos as $p) : ?>

																<div class="form-group col-md-6">
																<a href="<?=BASE_URL('uploads/paginas/pregao').$p->predoc_arquivo?>" target="_blank"><i style="font-size: 25pt" class="far fa-file-pdf"></i></a>
																<input type="text" class="form-control mt-2" value="<?=$p->predoc_titulo ?>" name="predoc_titulo[]">
																<input type="text" class="form-control mt-2" readonly value="<?=$p->predoc_tamanho ?>" name="predoc_tamanho[]">
																<input type="hidden" name="predoc_arquivo[]" value="<?=$p->predoc_arquivo ?>">
																<button type="button" class="btn btn-danger btn-remove mt-1" style="width: 45px">X</button>
																</div>

															<?php endforeach ?>
														<?php else : ?>
															
														<?php endif ?>

													</div>
												</div>

											</div>
									


								</div>
								<?php if (isset($pregao)) : ?>
									<input type="hidden" name="pre_id" value="<?php echo $pregao->pre_id; ?>">
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
