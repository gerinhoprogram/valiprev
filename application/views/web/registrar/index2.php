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
    .text-danger, .bg-danger, #user_foto{
        color: red !important
    }

    #ver{
        top: 35px
    }

</style>

<div id="content" class="pt-3">


    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <h2 class="text-dark mt-4 text-center"><?php echo $titulo; ?></h2>

            </div>
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="row page-content">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                        <div class="">

                            <div class="">

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
                                                                <label for="">Nome</label>
                                                                
                                                                <input type="text" id="nome" class="form-control" name="first_name" value="<?php echo (isset($usuario) ? $usuario->first_name : set_value('first_name')); ?>">
                                                            </div>
                                                            <div class="text-danger" id="erro_nome"></div>
                                                            <?php echo form_error('first_name', '<div class="text-danger">', '</div>'); ?>
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <div class="input-icon">
                                                                
                                                                <label for="">E-mail</label>
                                                                <input type="email" class="form-control" name="email" id="email" value="<?php echo (isset($usuario) ? $usuario->email : set_value('email')); ?>">
                                                            </div>
                                                            <div class="text-danger" id="erro_email"></div>
                                                            <?php echo form_error('email', '<div class="text-danger">', '</div>'); ?>
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
                                                                        <label for="">Senha</label>
                                                                        <input type="password" maxlength="15" minlength="6" placeholder="Min 6 max 15 caracteres" class="form-control" id="senha" name="password">
                                                                        <div id="ver" onclick="mostrarSenha()">
                                                                            <div class="text-dark"><i class="fas fa-eye"></i></div>
                                                                        </div>
                                                                    </div>
                                                                    <div id="erro_senha"></div>
                                                                    <?php echo form_error('password', '<div class="text-danger">', '</div>'); ?>
                                                                </div>

                                                                <div class="form-group col-md-6">
                                                                    <div class="input-icon">
                                                                        <label for="">Confirma senha</label>
                                                                        <input type="password" maxlength="15" minlength="6" id="confirma_senha" class="form-control" name="confirma_senha">
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