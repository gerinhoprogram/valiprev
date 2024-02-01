<script>
    function mostrarSenha() {
        var senha = document.getElementById("senha");
        var conf = document.getElementById("confirma_senha");
        var ver = document.getElementById("ver");
        if (senha.type == "password") {
            senha.type = "text";
            conf.type = "text";
            $('#ver').html('<div class="text-dark"><i class="fas fa-eye-slash"></i></div>');
        } else {
            senha.type = "password";
            conf.type = "password";
            $('#ver').html('<div class="text-dark"><i class="fas fa-eye"></i></div>');
        }
    }
</script>

<style>
    .text-danger,
    .bg-danger,
    #user_foto {
        color: red !important
    }
    
    #ver {
        top: 15px
    }

    form label{
        font-size: 10pt;
    }
</style>
<section class="register section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-3 col-md-12 col-xs-12">&nbsp;</div>
            <div class="col-lg-6 col-md-12 col-xs-12">
                <div class="register-form login-area">
                    <h3>
                        <?=$titulo?>
                    </h3>
                    <form role="form" class="login-form" method="POST" action="<?php echo base_url('registrar'); ?>">
                        <?php if ($mensagem = $this->session->flashdata('sucesso')) : ?>
                        <div class="alert alert-success bg-success text-white alert-dismissible show fade">
                            <div class="alert-body">
                                <button class="close" data-dismiss="alert">
                                                    <span>&times;</span>
                                                </button>
                                <?php echo $mensagem; ?>
                            </div>
                        </div>
                        <?php endif; ?>


                        <?php if ($mensagem = $this->session->flashdata('erro')) : ?>
                        <div class="alert alert-danger bg-danger text-white alert-dismissible show fade">
                            <div class="alert-body" style="color: white !important">
                                <button class="close" data-dismiss="alert">
                                                    <span>&times;</span>
                                                </button>
                                <?php echo $mensagem; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <div class="input-icon">
                                <i class="fa fa-user"></i>
                                <input type="text" id="nome" required maxlength="50" class="form-control" name="first_name" placeholder="Nome" value="<?=set_value('first_name')?>">
                            </div>
                            <div class="text-danger" id="erro_nome"></div>
                            <?php echo form_error('first_name', '<div class="text-danger" style="font-size: 10pt">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail será seu login</label>
                            <div class="input-icon">
                                <i class="fa fa-envelope"></i>
                                <input type="email" id="email" required maxlength="100" class="form-control" name="email" placeholder="Email / Login" value="<?=set_value('email')?>">
                            </div>
                            <div class="text-danger" id="erro_email"></div>
                            <?php echo form_error('email', '<div class="text-danger" style="font-size: 10pt">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="senha">Sua senha</label>
                            <div class="input-icon">
                                
                                <i class="fa fa-lock"></i>
                                <input type="password" class="form-control" id="senha" name="password" placeholder="Mínimo 6 máximo 15 caracteres" required maxlength="15" minlength="6">
                                <div id="ver" onclick="mostrarSenha()">
                                    <div class="text-dark"><i class="fas fa-eye"></i></div>
                                </div>
                            </div>
                            <div id="erro_senha"></div>
                            <?php echo form_error('password', '<div class="text-danger" style="font-size: 10pt">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="confirma_senha">Confirma a senha</label>
                            <div class="input-icon">
                                
                                <i class="fa fa-lock"></i>
                                <input type="password" id="confirma_senha" name="confirma_senha" class="form-control" placeholder="Confirma senha" required maxlength="15" minlength="6">
                            </div>
                            <div id="erro_conf"></div>
                            <?php echo form_error('confirma_senha', '<div class="text-danger" style="font-size: 10pt">', '</div>'); ?>
                        </div>

                        <div class="text-center" onclick="verificar_senha()">
                            <button class="btn btn-common log-btn">Registrar</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-3 col-md-12 col-xs-12">&nbsp;</div>
        </div>
    </div>
</section>