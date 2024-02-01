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

        <section class="">
            <div class="section-body">

                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">

                        <div class="card">

                            <form method="post" name="form_core" accept-charset="utf-8" enctype="multipart/form-data">

                                <div class="card-header">
                                    <h4><?php echo $titulo; ?></h4>
                                </div>
                                <div class="card-body">


                                    <?php if (isset($usuario)) : ?>

                                        <?php if($usuario->id == $_SESSION['user_id']) :?>
                                        <div class="form-row">

                                            <div class="form-group col-md-6">
                                                <label>*Senha</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-lock text-info"></i>
                                                        </div>
                                                    </div>
                                                    <input autofocus type="password" placeholder="Mínimo 5 máximo 15 caracteres" max_length="15" min_length="5" class="form-control" name="password">
                                                </div>
                                                <?php echo form_error('password', '<div class="text-danger">', '</div>'); ?>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>*Confirma senha</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-lock text-info"></i>
                                                        </div>
                                                    </div>
                                                    <input type="password" class="form-control" name="confirma_senha">
                                                </div>
                                                <?php echo form_error('confirma_senha', '<div class="text-danger">', '</div>'); ?>
                                            </div>

                                        </div>
                                        <?php endif ?>
                                    <?php endif ?>



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