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

                            <form method="post" name="form_core">

                                <div class="card-header">
                                    <h4><?php echo $titulo; ?></h4>
                                </div>
                                
                                <div class="card-body">

                                    <div class="form-group row">
                                        <div class="form-group col-md-6">
                                            <label>Título (opcional, para identificação interna no sistema)</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                    <i class="text-info far fa-file-image"></i>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control" name="titulo" value="<?=(isset($banner) ? $banner->titulo : set_value('titulo')) ?>">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Link (opcional, Link ao clicar no banner)</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                    <i class="text-info fas fa-external-link-alt"></i>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control" name="link" value="<?=(isset($banner) ? $banner->link : set_value('link')) ?>">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Situação (Inativo não aparece no site/blog)</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-check-circle text-info"></i>
                                                    </div>
                                                </div>
                                                <select class="custom-select" name="ativo">

                                                    <?php if (isset($banner)): ?>

                                                        <option value="0" <?php echo ($banner->ativo == 0 ? 'selected' : ''); ?>>Inativo</option>
                                                        <option value="1" <?php echo ($banner->ativo == 1 ? 'selected' : ''); ?>>Ativo</option>
                                                    
                                                    <?php endif; ?>

                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group col-md-12">
                                            <label>Texto (opcional, texto aparece sobre o banner no site/blog)</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                    <i class="text-info fas fa-external-link-alt"></i>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control" name="texto" value="<?=(isset($banner) ? $banner->texto : set_value('texto')) ?>">
                                            </div>
                                        </div>
                                        
                                    </div>

                                    <fieldset class="mb-4 border p-2">
                                    <legend class="font-md">Banner</legend>

                                    <div class="form-group row">
                                        <div class="form-group col-md-12">
                                            <label>(PNG | JPG | GIF | max.: 5000 MB | ideal 1950x800)</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="text-info fas fa-image"></i>
                                                    </div>
                                                </div>
                                                <input type="file" class="form-control" name="foto_banner">
                                            </div>
                                            <div id="banner_foto_troca"></div>
                                            <?=form_error('foto_banner','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                                            
                                        </div>

                                        <div class="form-group col-md-12">
                                            <div id="box-foto-banner">
                                                <input type="hidden" name="banner_foto_troca" value="<?=$banner->banner ?>">
                                                <img src="<?=base_url('uploads/sistema/carousel/'.$banner->banner) ?>" alt="" style="height: 250px; width: 100%; object-fit: contain" class='img-thumbnail'>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </fieldset>


                                </div>

                                <div class="card-footer">
                                    <a href="javascript:;" data-toggle="modal" data-target="#salvar_banner" class="btn btn-success">Salvar</a>
                                    <a href="<?php echo base_url('restrita/' . $this->router->fetch_class()); ?>" class="btn btn-dark">Voltar</a>
                                </div>


                                <div class="modal fade" style="z-index: 99999999" id="salvar_banner" tabindex="1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Deseja salvar alterações?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                    </div>
                                    <div class="modal-footer bg-whitesmoke br">
                                        <button onclick="loading()" type="submit" class="btn btn-success" >Salvar</button>
                                        <button onclick="loading()"type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                                    </div>
                                    </div>
                                </div>
                                </div>
                              

                            </form>
                        </div>


                    </div>

                </div>

            </div>
        </section>

        <?php $this->load->view('restrita/layout/sidebar_configuracoes'); ?>

    </div>

