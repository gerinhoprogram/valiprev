<style>
	#box-foto-usuario {
		height: 100px;
	}

	#box-foto-usuario img {
		width: 100%;
		height: 100px;
		object-fit: contain
	}
</style>

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

							<form method="post" name="form_core" accept-charset="utf-8" enctype="multipart/form-data">

								<div class="card-header">
									<h4><?php echo $titulo; ?></h4>
								</div>
								<div class="card-body">

									<div class="form-row">

										<div class="form-group col-md-6">
											<label>*Seu nome <small class="nome text-info"></small></label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fas fa-user text-info"></i>
													</div>
												</div>
												<input type="text" class="form-control" name="first_name" value="<?php echo (isset($usuario) ? $usuario->first_name : set_value('first_name')); ?>">
											</div>
											<?php echo form_error('first_name', '<div class="text-danger">', '</div>'); ?>
										</div>


										<div class="form-group col-md-6">
											<label>*Seu e-mail <small class="email text-info"></small></label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fas fa-envelope text-info"></i>
													</div>
												</div>
												<input type="email" class="form-control" name="email" value="<?php echo (isset($usuario) ? $usuario->email : set_value('email')); ?>">
											</div>
											<?php echo form_error('email', '<div class="text-danger">', '</div>'); ?>
										</div>
									</div>

									<div class="form-row">

										<div class="form-group col-md-12">
											<label>Foto (Não é obrigatório)<br><small class="text-info">Dimensões máximas: 1500x1500<br>Tamanho máximo: 2000MB<br>Extensões: PNG | JPG | JPEG</small> </label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fas fa-image text-info"></i>
													</div>
												</div>
												<input type="file" class="form-control" name="user_foto_file">
											</div>
											<div id="user_foto"></div>
										</div>


										<div class="form-group col-md-12">

											<?php if (isset($usuario)) : ?>

												<div id="box-foto-usuario">
													<input type="hidden" name="user_foto" value="<?php echo $usuario->user_foto; ?>">
													<img alt="Usuário image" src="<?php echo base_url('uploads/usuarios/' . $usuario->user_foto); ?>" class='img-thumbnail' onerror="this.src='<?= base_url('public/restrita/assets/img/usuario.png') ?>'">
												</div>
											<?php else : ?>
												<div id="box-foto-usuario"></div>
											<?php endif; ?>

											<?php if (isset($usuario)) : ?>
												<input type="hidden" name="usuario_id" value="<?php echo $usuario->id; ?>">
											<?php endif; ?>
											<!-- <?php if (!$this->ion_auth->is_admin()) : ?>
                                                <input type="hidden" readonly name="active" value="<?php echo $usuario->active; ?>">
                                                <input type="hidden" readonly name="perfil" value="<?php echo $perfil->id; ?>">
                                            <?php endif ?> -->

										</div>

									</div>


								</div>
								<?php $this->load->view('restrita/layout/btn-footer'); ?>

							</form>
						</div>


					</div>

				</div>

			</div>
		</section>
		<?php $this->load->view('restrita/layout/sidebar_configuracoes'); ?>
	</div>