<div class="main-wrapper main-wrapper-1">

	<?php $this->load->view('restrita/layout/navbar'); ?>

	<?php $this->load->view('restrita/layout/sidebar'); ?>

	<!-- Main Content -->
	<div class="main-content">

		<section>
			<div class="section-body">

				<div class="row">
					<div class="col-12">
						<div class="card">
							<div class="card-header d-block">
								<h4><?php echo $titulo; ?></h4>
							</div>
							<div class="card-body">

								<div class="table-responsive">
									<table class="table table-striped table-artigos">
										<thead>
											<tr>
												<th class="nosort">Avatar</th>
												<th>Nome</th>
												<th>E-mail</th>
												<th>Grupo</th>
												<th>Setor</th>
												<th class="nosort text-center">Ativo</th>
												<?php if ($excluir || $editar) : ?>
													<th class="nosort text-center">Ações</th>
												<?php endif ?>
											</tr>
										</thead>
										<tbody>

											<?php foreach ($usuarios as $usuario) : ?>

												<tr>
													<td><img alt="image" src="<?php echo base_url('uploads/usuarios/' . $usuario->user_foto); ?>" width="35" onerror="this.src='<?= base_url('public/restrita/assets/img/usuario.png') ?>'"></td>
													<td><?php echo $usuario->first_name ?></td>
													<td><?php echo $usuario->email; ?></td>
													<td><?php echo $usuario->setor ?></td>
													<td><?php echo $usuario->setor_nome ?></td>

													<td class="text-center">
														<?php if ($usuario->active) : ?>
															<label for="" onclick="ativar('<?= $usuario->id ?>')"><i class="fas fa-check text-success"></i></label>
														<?php else : ?>
															<label for="" onclick="ativar('<?= $usuario->id ?>')"><i class="fas fa-times text-danger"></i></label>
														<?php endif ?>
													</td>

													<td class="text-center">

														<div class="dropdown">
															<a href="#" data-toggle="dropdown" class="btn btn-warning dropdown-toggle">Opções</a>
															<div class="dropdown-menu">

																<?php if ($editar) : ?>
																	<a data-toggle="tooltip" data-placement="left" title="Editar dados básicos do usuário" onclick="loading()" href="<?php echo base_url('restrita/' . $this->router->fetch_class() . '/core_adm/' . $usuario->id) ?>" class="dropdown-item has-icon"><i class="far fa-edit"></i> Editar</a>
																<?php endif ?>
																<a data-toggle="tooltip" data-placement="left" title="Artigos do <?=$usuario->first_name?>" onclick="loading()" href="<?php echo base_url('restrita/' . $this->router->fetch_class() . '/logs/' . $usuario->id) ?>" class="dropdown-item has-icon"><i class="far fa-edit"></i> Logs</a>

																<a data-toggle="tooltip" data-placement="left" title="Logs do <?=$usuario->first_name?>" onclick="loading()" href="<?php echo base_url('restrita/' . $this->router->fetch_class() . '/artigos/' . $usuario->id) ?>" class="dropdown-item has-icon"><i class="far fa-edit"></i> Artigos</a>

																<div class="dropdown-divider"></div>

																<?php if ($excluir) : ?>
																<a href="<?php echo base_url('restrita/' . $this->router->fetch_class() . '/delete/' . $usuario->id) ?>" data-toggle="tooltip" data-placement="left" title="Deletar" class="dropdown-item has-icon delete" data-confirm="Tem certeza da exclusão do registro?"><i class="far fa-trash-alt"></i>
																	Deletar</a>
																	<?php endif ?>
															</div>
														</div>

													</td>
												</tr>

											<?php endforeach; ?>

										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>




			</div>
		</section>


		<?php $this->load->view('restrita/layout/sidebar_configuracoes'); ?>


	</div>