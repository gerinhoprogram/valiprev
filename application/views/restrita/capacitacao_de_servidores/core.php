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

										<div class="form-group col-md-8">
											<label>* Nome <small class="titulo text-info"></small></label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fas fa-user-tie text-info"></i>
													</div>
												</div>
												<input id="titulo" type="text" class="form-control" name="serv_nome" value="<?php echo (isset($servidor) ? $servidor->serv_nome : set_value('serv_nome')); ?>">
											</div>
											<?php echo form_error('serv_nome', '<div class="text-danger">', '</div>'); ?>

										</div>

										<div class="form-group col-md-4">
                                            <label>Status</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-check-circle text-info"></i>
                                                    </div>
                                                </div>
                                                <select class="custom-select" name="serv_status">

                                                    <?php if (isset($servidor)): ?>

                                                        <option value="0" <?php echo ($servidor->serv_status == 0 ? 'selected' : ''); ?>>Inativo</option>
                                                        <option value="1" <?php echo ($servidor->serv_status == 1 ? 'selected' : ''); ?>>Ativo</option>

                                                    <?php else: ?>

                                                        <option value="1">Ativo</option>
                                                        <option value="0">Inativo</option>

                                                    <?php endif; ?>

                                                </select>
                                            </div>
                                        </div>

									</div>

									<div class="form-row">
										<div class="form-group md-12">
										<a data-toggle="tooltip" data-placement="Top" title="Adicionar PDF" href="javascript:;" class="add_faq btn btn-success mt-2 mb-4"><i class="fa fa-plus-circle"></i> Adicionar nova dúvida</a>
											<div class="input_fields_wrap form-row">
												<?php if (isset($servidor)) : ?>
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
								<?php if (isset($servidor)) : ?>
									<input type="hidden" name="serv_id" value="<?php echo $servidor->serv_id; ?>">
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
