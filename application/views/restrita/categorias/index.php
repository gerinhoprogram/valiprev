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
                                                <th>Título</th>
                                                <th>Categoria principal</th>
                                                <th class="nosort text-center">Status</th>
                                                <th class="nosort text-center">Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                            <?php foreach ($categorias as $categoria): ?>

                                                <tr>
                                                    <td><?php echo $categoria->categoria_nome; ?></td>
                                                    <td><?php echo $categoria->categoria_pai_nome; ?></td>

                                                    <td class="text-center"><?php echo ($categoria->categoria_ativa == 1 ? '<i class="fas fa-check text-success"></i>' : '<i class="fas fa-times text-danger"></i>'); ?></td>

                                                    <td class="text-center">
                                                        <?php if($editar) :?>
                                                            <a onclick="loading()" data-toggle="tooltip" data-placement="top" title="Editar" href="<?php echo base_url('restrita/' . $this->router->fetch_class() . '/core/' . $categoria->categoria_id); ?>" class="btn btn-warning mr-2"><i class="fas fa-edit"></i></a>
                                                        <?php endif ?>
                                                        <?php if($excluir) :?>
                                                        <a data-toggle="tooltip" data-placement="top" title="Excluir" href="<?php echo base_url('restrita/' . $this->router->fetch_class() . '/delete/' . $categoria->categoria_id); ?>" class="btn btn-danger delete" data-confirm="Tem certeza da exclusão do registro?"><i class="fas fa-trash-alt"></i></a>
                                                        <?php endif ?>
                                                    </td>
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

