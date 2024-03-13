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
											<label>* Nome <small class="dis_titulo text-info"></small></label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fas fa-user-tie text-info"></i>
													</div>
												</div>
												<input id="dis_titulo" type="text" class="form-control" name="dis_titulo" value="<?php echo (isset($dispensa) ? $dispensa->dis_titulo : set_value('dis_titulo')); ?>">
											</div>
											<?php echo form_error('dis_titulo', '<div class="text-danger">', '</div>'); ?>

										</div>

										<div class="form-group col-md-3">
                                            <label>* Modalidade</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-check-circle text-info"></i>
                                                    </div>
                                                </div>
                                                <select class="custom-select" name="dis_modalidade">

                                                    <?php if (isset($dispensa)): ?>

                                                        <option value="Dispensa de Licitação" <?php echo ($dispensa->dis_modalidade == 'Dispensa de Licitação' ? 'selected' : ''); ?>>Dispensa de Licitação</option>

                                                    <?php else: ?>

                                                        <option value="Dispensa de Licitação">Dispensa de Licitação</option>

                                                    <?php endif; ?>

                                                </select>
                                            </div>
                                        </div>

										<div class="form-group col-md-3">
                                            <label>* Status</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-check-circle text-info"></i>
                                                    </div>
                                                </div>
                                                <select class="custom-select" name="dis_status">

                                                    <?php if (isset($dispensa)): ?>

                                                        <option value="1" <?php echo ($dispensa->dis_status == 1 ? 'selected' : ''); ?>>Ativo</option>
                                                        <option value="0" <?php echo ($dispensa->dis_status == 0 ? 'selected' : ''); ?>>Inativo</option>

                                                    <?php else: ?>

                                                        <option value="1">Ativo</option>
														<option value="0">inativo</option>

                                                    <?php endif; ?>

                                                </select>
                                            </div>
                                        </div>

										<div class="form-group col-md-6">
											<label>* Processo de Compras/Administrativo <small class="dis_processo text-info"></small></label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fas fa-user-tie text-info"></i>
													</div>
												</div>
												<input id="dis_processo" type="text" class="form-control" name="dis_processo" value="<?php echo (isset($dispensa) ? $dispensa->dis_processo : set_value('dis_processo')); ?>">
											</div>
											<?php echo form_error('dis_processo', '<div class="text-danger">', '</div>'); ?>

										</div>

										<div class="form-group col-md-12">
										<label for="">Objetivo <small class="dis_objetivo text-info"></small></label>
										<textarea name="dis_objetivo" id="dis_objetivo" class="form-control" style='height: 200px !important'><?=(isset($dispensa) ? $dispensa->dis_objetivo : (isset($texto) ? $texto : '') )?></textarea>
										<?php echo form_error('dis_objetivo', '<div class="text-danger">', '</div>'); ?>
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
													<div class="form-row border p-2" id="uploaded_image">

														<?php if (isset($dispensa)) : ?>
															
															<?php foreach ($pdf as $p) : ?>

																<div class="form-group col-md-6">
																<a href="<?=BASE_URL('uploads/paginas/dispensa_de_licitacao').$p->disdoc_arquivo?>" target="_blank"><i style="font-size: 25pt" class="far fa-file-pdf"></i></a>
																<input type="text" class="form-control mt-2" value="<?=$p->disdoc_titulo ?>" name="disdoc_titulo[]">
																<input type="text" class="form-control mt-2" readonly value="<?=$p->disdoc_tamanho ?>" name="disdoc_tamanho[]">
																<input type="hidden" name="disdoc_arquivo[]" value="<?=$p->disdoc_arquivo ?>">
																<button type="button" class="btn btn-danger btn-remove mt-1" style="width: 45px">X</button>
																</div>

															<?php endforeach ?>
														<?php else : ?>
															
														<?php endif ?>

													</div>
												</div>

											</div>
									


								</div>
								<?php if (isset($dispensa)) : ?>
									<input type="hidden" name="dis_id" value="<?php echo $dispensa->dis_id; ?>">
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
