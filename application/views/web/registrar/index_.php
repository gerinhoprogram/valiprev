<script>
        function mostrarSenha() {
            var senha = document.getElementById("senha");
            var conf = document.getElementById("confirma_senha");
            var ver = document.getElementById("ver");
            if (senha.type == "password") {
                senha.type = "text";
                conf.type = "text";
                $('#ver').html('<div class="text-dark"><i class="lni lni-close"></i></div>');
            } else {
                senha.type = "password";
                conf.type = "password";
                $('#ver').html('<div class="text-dark"><i class="lni lni-eye"></i></div>');
            }
        }
    </script>
    
<div id="content" class="pt-3" style="background: linear-gradient(0, #120c56, #000000); height: 100vh">

<i class="lni lni-rocket foguete1"></i>
<i class="lni lni-rocket foguete2"></i>
<i class="lni lni-star estrela1"></i>
<i class="lni lni-star estrela2"></i>
<i class="lni lni-star estrela3"></i>
<i class="lni lni-star estrela4"></i>
<i class="lni lni-star estrela5"></i>
<i class="lni lni-star estrela6"></i>
    
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-4 col-lg-4">
			<h2 class="text-white mt-4 text-center"><?php echo $titulo; ?></h2>
            
			</div>
            <div class="col-sm-12 col-md-8 col-lg-8">
                <div class="row page-content">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                
                            <div class="">

                                <div class="login-area" style="box-shadow: none">

                                    <form role="form" class="login-form" method="POST" action="<?php echo base_url('registrar'); ?>">

                                        <?php if ($mensagem = $this->session->flashdata('sucesso')): ?>

                                            <div class="alert alert-success bg-success text-white alert-dismissible show fade">
                                                <div class="alert-body" style="color: white !important">
                                                    <button class="close" data-dismiss="alert">
                                                        <span>&times;</span>
                                                    </button>
                                                    <?php echo $mensagem; ?>
                                                </div>
                                            </div>

                                        <?php endif; ?>


                                        <?php if ($mensagem = $this->session->flashdata('erro')): ?>

                                            <div class="alert alert-danger bg-danger text-white alert-dismissible show fade">
                                                <div class="alert-body" style="color: white !important">
                                                    <button class="close" data-dismiss="alert">
                                                        <span>&times;</span>
                                                    </button>
                                                    <?php echo $mensagem; ?>
                                                </div>
                                            </div>

                                        <?php endif; ?>
										
										
										<div class="panel-group" id="accordion">
											<div class="panel panel-default">
												<div class="panel-heading">
												<h4 class="panel-title">
												<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
												Dados básicos
												</a>
												</h4>
												</div>
											<div id="collapseOne" class="panel-collapse collapse show">
											<div class="panel-body">
												<div class="form-row">

													<div class="form-group col-md-6">
														<div class="input-icon">
															<i class="lni lni-user"></i>
															<input type="text" id="nome" class="form-control" name="first_name" placeholder="Nome" value="<?php echo (isset($usuario) ? $usuario->first_name : set_value('first_name')); ?>">
														</div>
														<div id="erro_nome"></div>
														<?php echo form_error('first_name', '<div class="text-danger">', '</div>'); ?>
													</div>

													 <div class="form-group col-md-6">
														<div class="input-icon">
															<i class="lni lni-envelope"></i>
															<input type="email" class="form-control" name="email" placeholder="E-mail" id="email" value="<?php echo (isset($usuario) ? $usuario->email : set_value('email')); ?>">
														</div>
														 <div id="erro_email"></div>
														<?php echo form_error('email', '<div class="text-danger">', '</div>'); ?>
													</div>


													<div class="form-group col-md-8">
														<label>Foto Tamanho max. 500x500 1M | jpge | png</label>
														<div class="input-icon">
															<i class="lni lni-image"></i>
															<input type="file" class="form-control" name="user_foto_file">
														</div>
														<?php echo form_error('user_foto', '<div class="text-danger">', '</div>'); ?>
														<div id="user_foto"></div>
													</div>

													<div class="form-group col-md-4">
															<div id="box-foto-usuario"></div>
													</div>

												</div>
											</div>
											
											<div class="panel panel-default" onclick="proximo()">
											<div class="panel-heading">
											<h4 class="panel-title">
											<a data-toggle="collapse" class="proximo" data-parent="#accordion" href="#collapseTwo">
											Senha
											</a>
											</h4>
											</div>
											<div id="collapseTwo" class="panel-collapse collapse">
											<div class="panel-body">
											  <div class="form-row">


                                            <div class="form-group col-md-6">
                                                <div class="input-icon">
                                                    <i class="lni lni-unlock"></i>
                                                    <input type="password" placeholder="Senha" class="form-control" id="senha" name="password">
                                                    <div id="ver" onclick="mostrarSenha()">
                                                        <div class="text-dark"><i class="lni lni-eye"></i></div>
                                                    </div>
                                                </div>
												<div id="erro_senha"></div>
                                                <?php echo form_error('password', '<div class="text-danger">', '</div>'); ?>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <div class="input-icon">
                                                    <i class="lni lni-unlock"></i>
                                                    <input type="password" placeholder="Confirma senha" id="confirma_senha" class="form-control" name="confirma_senha">
                                                </div>
												<div id="erro_conf"></div>
                                                <?php echo form_error('confirma_senha', '<div class="text-danger">', '</div>'); ?>
                                            </div>
												  
												   <div class="mb-1" onclick="verificar_senha()">
                                            <button class="btn btn-success salvar_dados log-btn"><i class="lni lni-save"></i> Salvar</button>
                                        </div>


                                        </div>
											</div>
											</div>
											</div>
											</div>


                                           
                                        </div>


                                            </div>


                                        </div>

                                    </form>
                                </div>

                            </div>
                        
                    </div>

                </div>
            </div>
			
        </div>
    </div>
</div>
