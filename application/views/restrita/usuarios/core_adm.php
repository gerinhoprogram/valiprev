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

                                    <div class="form-row">

                                        <div class="form-group col-md-3">
                                            <label>Ativo</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-check-circle text-info"></i>
                                                    </div>
                                                </div>
                                                <select class="custom-select" name="active">

                                                    <option value="0" <?php echo ($usuario->active == 0 ? 'selected' : ''); ?>>Não</option>
                                                    <option value="1" <?php echo ($usuario->active == 1 ? 'selected' : ''); ?>>Sim</option>

                                                </select>
                                            </div>
                                            <?php echo form_error('active', '<div class="text-danger">', '</div>'); ?>
                                        </div>

                                        <div class="form-group col-md-5">
                                            <label>Grupo no painel</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-user-tie text-info"></i>
                                                    </div>
                                                </div>
                                                <select class="custom-select" name="grupo_id">
                                                    <?php foreach ($grupos as $grupo) : ?>

                                                        <option value="<?php echo $grupo->id; ?>" <?php echo ($usuario->grupo_id == $grupo->id ? 'selected' : ''); ?>><?php echo $grupo->name; ?></option>

                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <?php echo form_error('grupo_id', '<div class="text-danger">', '</div>'); ?>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label>Setor da empresa</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-user-tie text-info"></i>
                                                    </div>
                                                </div>
                                                <select class="custom-select" name="setor_id">
                                                    <?php foreach ($setores as $setor) : ?>

                                                        <option value="<?php echo $setor->setor_id; ?>" <?php echo ($usuario->id == $setor->setor_id ? 'selected' : ''); ?>><?php echo $setor->setor_nome; ?></option>

                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <?php echo form_error('setor_id', '<div class="text-danger">', '</div>'); ?>
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