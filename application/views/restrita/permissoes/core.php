<form method="post" name="form_core" action="<?php echo base_url('restrita/' . $this->router->fetch_class() . '/permissoes/'); ?>">


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
										<input type="hidden" name="setor_id" value="<?php echo $setor->id ?>">


										<div class="table-responsive">
											<table class="table">
												<thead>
													<tr>
														<th>Área</th>
														<th>Adicionar</th>
														<th>Editar</th>
														<th>Deletar</th>
													</tr>
												</thead>
												<tbody>


													<?php $pos = 0;
													foreach ($acessos_areas as $area) : ?>

														<tr>

															<td><input type="hidden" name="areas[<?= $pos ?>]" value="<?= $area->area_id ?>"><?= $area->area_nome; ?></td>
															<td><input type="checkbox" <?= ($area->adicionar ? 'checked' : '') ?> value="<?= $area->area_id ?>" name="adicionar[<?= $pos ?>]"></td>
															<td><input type="checkbox" <?= ($area->editar ? 'checked' : '') ?> value="<?= $area->area_id ?>" name="editar[<?= $pos ?>]"></td>
															<td><input type="checkbox" <?= ($area->excluir ? 'checked' : '') ?> value="<?= $area->area_id ?>" name="excluir[<?= $pos ?>]"></td>

														</tr>

														<?php $pos++ ?>
													<?php endforeach; ?>

												</tbody>
											</table>
										</div>


									</div>


								</div>
								<?php if (isset($setor)) : ?>
									<input type="hidden" name="id" value="<?php echo $setor->id; ?>">
								<?php endif; ?>
								<div class="error_nome_categoria"></div>
								<?php $this->load->view('restrita/layout/btn-footer') ?>




							</div>
						</div>
					</div>
				</div>
			</section>

			<?php $this->load->view('restrita/layout/sidebar_configuracoes'); ?>

		</div>

		<div class="modal fade" style="z-index: 99999999" id="salvar_categoria" tabindex="1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Deseja salvar?</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">

					</div>
					<div class="modal-footer bg-whitesmoke br">
						<button onclick="loading()" type="submit" class="btn btn-success">Salvar</button>
						<button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
					</div>
				</div>
			</div>
		</div>

</form>