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

										<?php if(isset($pdf)) :?>
											<div class="form-group col-md-12">
											<p>Criado por: <?=$pdf->pdf_user?></p>
											<p>Data da criação: <?=formata_data_banco_com_hora($pdf->pdf_data)?></p>
											<p>Atualizado por: <?=($pdf->pdf_user_update ? $pdf->pdf_user_update : $pdf->pdf_user)?></p>
											<p>Data da atualização: <?=formata_data_banco_com_hora($pdf->pdf_ultima_alteracao)?></p>
											</div>
										<?php endif ?>

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

										<div class="form-group col-md-4">
                                            <label>Status</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-check-circle text-info"></i>
                                                    </div>
                                                </div>
                                                <select class="custom-select" name="pdf_status">

                                                    <?php if (isset($pdf)): ?>

                                                        <option value="0" <?php echo ($pdf->pdf_status == 0 ? 'selected' : ''); ?>>Inativo</option>
                                                        <option value="1" <?php echo ($pdf->pdf_status == 1 ? 'selected' : ''); ?>>Ativo</option>

                                                    <?php else: ?>

                                                        <option value="1">Ativo</option>
                                                        <option value="0">Inativo</option>

                                                    <?php endif; ?>

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
												<?php if(isset($pdf)) :?>
												<input type="hidden" name="logo_foto_troca" value="<?= $pdf->pdf_arquivo ?>">
												<a href="<?= base_url('uploads/paginas/censo_previdenciario/pdf/' . $pdf->pdf_arquivo) ?>"><i style="font-size: 25pt" class='far fa-file-pdf'></i></a>
												<input type="hidden" name="pdf_tamanho" value="<?= $pdf->pdf_tamanho ?>">
												<br>Tamanho: <span class="badge badge-info"><?=$pdf->pdf_tamanho?></span>
												<?php endif ?>
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
