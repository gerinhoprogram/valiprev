<div class="main-wrapper main-wrapper-1">

<?php $this->load->view('restrita/layout/navbar'); ?>

<?php $this->load->view('restrita/layout/sidebar'); ?>

<div class="main-content">

<section class="section">
    <div class="section-body">

        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">

                <div class="card">

                    <form method="post" name="form_core">

                        <div class="card-header">
                            <h4><?php echo $titulo; ?></h4>
                        </div>
                        
                        <div class="card-body">
                <form method="POST" name="form_edit">

                    <fieldset class="mb-4 border p-2">
                        <legend class="font-medium">Menu lateral</legend>
                        <div class="form-group row mb-5">
                            <div class="col-md-4">
                                <label for="con_sidebar_cor" class="form-label">Cor de fundo</label>
                                <input type="color" class="form-control" name="con_sidebar_cor" style="height: 100px; cursor: pointer" value="<?php echo $sistema->con_sidebar_cor ?>">
                                <?php echo form_error('con_sidebar_cor','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                       
                            <div class="col-md-4">
                                <label for="con_sidebar_cor_fonte" class="form-label">Cor de fonte</label>
                                <input type="color" class="form-control" name="con_sidebar_cor_fonte" style="height: 100px; cursor: pointer" value="<?php echo $sistema->con_sidebar_cor_fonte ?>">
                                <?php echo form_error('con_sidebar_cor_fonte','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>

                            <div class="col-md-4">
                                <label for="con_sidebar_cor_hover" class="form-label">Mouse hover</label>
                                <input type="color" class="form-control" name="con_sidebar_cor_hover" style="height: 100px; cursor: pointer" value="<?php echo $sistema->con_sidebar_cor_hover ?>">
                                <?php echo form_error('con_sidebar_cor_hover','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row mb-5">
                    
                            <div class="col-md-6 text-center">
                                <label for="con_sidebar_padrão" class="form-label"><?php echo ($sistema->con_sidebar_padrao ? 'Menu padrão está selecionado' : 'Voltar para padrão' ) ?></label>
                                <input type="checkbox" class="form-control" name="con_sidebar_padrão" <?php echo ($sistema->con_sidebar_padrao ? 'checked' : '' ) ?>>
                                <label for="con_sidebar_padrão" class="form-label"><?php echo ($sistema->con_sidebar_padrao ? 'Para personalizar, desative esta função!' : '' ) ?></label>

                            </div>
                       
                        </div>
                    </fieldset>

                    <input type="hidden" name="con_id" value="<?php echo $sistema->con_id ?>">

                    <a title="Voltar" class="btn btn-info btn-md" href="javascript(void)" data-toggle="modal" data-target="#cancelar-alteracao"><i class="fas fa-arrow-left"></i>&nbsp;Cancelar</a>
                    <button type="submit" class="btn btn-success btn-md"><i class="fas fa-save"></i>&nbsp;&nbsp;Salvar</button>

                    

                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
