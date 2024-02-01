<div class="main-wrapper main-wrapper-1">

    <?php $this->load->view('restrita/layout/navbar'); ?>

    <?php $this->load->view('restrita/layout/sidebar'); ?>

    <!-- Main Content -->
    <div class="main-content">

        <section class="section">
            <div class="section-body">

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                        <?php $this->load->view('restrita/layout/card-header'); ?>
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table class="table table-striped table-artigos">
                                        <thead>
                                            <tr>
                                                <th class="text-center nosort">Banner</th>
                                                <th>Título</th>
                                                <th>Propriedades</th>
                                                <?php if($editar || $excluir) :?>
                                                <th class="nosort text-center">Ações</th>
                                                <?php endif ?>
                                            </tr>
                                        </thead>
                                        <tbody>


                                            <?php foreach ($banners as $banner): ?>
                                                <tr>
                                                    <td class="text-center"><img alt="image" src="<?php echo base_url('uploads/banners_site/' . $banner->banner_imagem); ?>" style="height: 80px; width: 100%; object-fit: contain"></td>                                                     
                                                    <td><?php echo $banner->banner_titulo; ?></td>
                                                    <td><?php echo $banner->banner_medida ." | ". $banner->banner_tamanho ?></td>
                                                    
                                                    <?php if($editar || $excluir) :?>
                                                    <td class="text-center">
                                                        <?php if($editar) :?>
                                                        <a onclick="loading()" data-toggle="tooltip" data-placement="top" title="Editar" href="<?php echo base_url('restrita/' . $this->router->fetch_class() . '/core/' . $banner->banner_id); ?>" class="btn btn-warning mr-2"><i class="fas fa-edit"></i></a>
                                                        <?php endif ?>
                                                        <?php if($excluir) :?>
                                                        <a data-toggle="tooltip" data-placement="top" title="Excluir" href="<?php echo base_url('restrita/' . $this->router->fetch_class() . '/delete/' . $banner->banner_id); ?>" class="btn btn-danger delete" data-confirm="Tem certeza da exclusão do registro?"><i class="fas fa-trash-alt"></i></a>
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

