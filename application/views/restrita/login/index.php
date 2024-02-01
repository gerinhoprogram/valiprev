
    <style>
        #ver {
        right: 30px;
        top: 11px;
        cursor: pointer;
        position: absolute;
        width: 15px;
        height: 15px;
        z-index: 999999999
    }
    </style>
    <script>
        function mostrarSenha() {
            
            var senha = document.getElementById("password");
            var ver = document.getElementById("ver");
            if (senha.type == "password") {
                senha.type = "text";
                $('#ver').html('<div class="aberto"><i class="far fa-eye-slash text-dark"></i></div>');
            } else {
                senha.type = "password";
                $('#ver').html('<div class="oculto"><i class="fas fa-eye text-dark"></i></div>');
            }
        }
    </script>
    
<section class="section mt-5 ">
<?php $sistema = info_header_footer();?>
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                <div class="text-center mb-3">
                    <img src="<?=base_url('uploads/sistema/logo/'.$sistema->sistema_logo_2 )?>" width="250" alt="">
                </div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h4 class="text-dark"><?=$titulo?></h4>
                    </div>
                    <div class="card-body text-dark">

                        <form method="POST" action="<?php echo base_url('restrita/' . $this->router->fetch_class() . '/auth'); ?>" class="needs-validation" novalidate="">
                            <div class="form-group" >
                                <label for="email">Email</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-user text-dark"></i>
                                        </div>
                                    </div>
                                    <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="text-dark" for="email">Senha</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-lock text-dark"></i>
                                        </div>
                                    </div>
                                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                                    <div id="ver" onclick="mostrarSenha()">
                                    <i class="fas fa-eye text-dark"></i>
                                    </div>    
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <button style="box-shadow: none" type="submit" class="btn btn-success btn-lg btn-block" tabindex="4">
                                    Entrar
                                </button>
                                <a href="<?=base_url('restrita/login/recupera_login')?>" class="btn btn-info btn-sm btn-block">Recuperar login</a>

                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

