<div class="main-wrapper main-wrapper-1">

    <?php $this->load->view('restrita/layout/navbar'); ?>

    <?php $this->load->view('restrita/layout/sidebar'); ?>

    <!-- Main Content -->
    <div class="main-content">

        <section class="section">
            <div class="section-body">

                <div class="row">
                    <div class="col-3 mb-3">
                            <select name="ativar" class="ativar form-control <?=$sistema->carousel ? 'text-success' : 'text-danger' ?>">
                                    <option class="text-success" value="1" <?=($sistema->carousel ? 'selected' : '')?>>Ativado</option>
                                    <option class="text-danger" value="0" <?=(!$sistema->carousel ? 'selected' : '')?>>Inativado</option>
                            </select>
                    </div>
                    <div class="col-4 mb-3">
                        <div id="aguarde"></div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-block">
                                <h4><?php echo $titulo; ?></h4>

                                <?php if($adicionar) :?>
                                <a onclick="loading()" data-toggle="tooltip" data-placement="top" title="Cadastrar / Editar / Deletar em lote" href="<?=base_url('restrita/' . $this->router->fetch_class() . '/core/'); ?>" class="btn btn-success mr-2 float-right">Cadastrar / Editar / Deletar em lote</a>
                                <?php endif ?>

                            </div>
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table class="table table-striped table-artigos">
                                        <thead>
                                            <tr>
                                                <th class="text-center nosort">Imagem</th>
                                                <th>Título</th>
                                                <th>Link</th>
                                                <th>Texto</th>
                                                <th class="nosort text-center">Principal</th>
                                                <th class="nosort text-center">Ativo</th>
                                                <?php if($editar || $excluir) :?>
                                                <th class="nosort text-center">Ações</th>
                                                <?php endif ?>
                                            </tr>
                                        </thead>
                                        <tbody>


                                            <?php foreach ($banners as $banner): ?>
                                                <tr>
                                                    <td class="text-center"><img alt="image" src="<?php echo base_url('uploads/sistema/carousel/' . $banner->banner); ?>" width="50"></td>                                                     
                                                    <td><?php echo $banner->titulo; ?></td>
                                                    <td><?php echo $banner->link; ?></td>
                                                    <td><?php echo $banner->texto ?></td>
                                                    <td class="text-center"><?php echo $banner->principal ? '<i class="fas fa-check text-success"></i>' : '' ?></td>
                                                    <td class="text-center"><?php echo $banner->ativo ? '<i class="fas fa-check text-success"></i>' : '<i class="fas fa-times text-danger"></i>' ?></td>
                                                    <?php if($editar || $excluir) :?>
                                                    <td class="text-center">
                                                        <?php if($editar) :?>
                                                        <a onclick="loading()" data-toggle="tooltip" data-placement="top" title="Editar" href="<?php echo base_url('restrita/' . $this->router->fetch_class() . '/editar/' . $banner->carousel_id); ?>" class="btn btn-warning mr-2"><i class="fas fa-edit"></i></a>
                                                        <?php endif ?>
                                                        <?php if($excluir) :?>
                                                        <a data-toggle="tooltip" data-placement="top" title="Excluir" href="<?php echo base_url('restrita/' . $this->router->fetch_class() . '/delete/' . $banner->carousel_id); ?>" class="btn btn-danger delete" data-confirm="Tem certeza da exclusão do registro?"><i class="fas fa-trash-alt"></i></a>
                                                        <?php endif ?>                                                            
                                                    </td>
                                                    <?php endif ?>
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

