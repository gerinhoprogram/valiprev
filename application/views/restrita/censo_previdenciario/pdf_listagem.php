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
                                                <th>Arquivo</th>
                                                <th class="nosort text-center">Status</th>
                                                <th class="nosort text-center">Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                            <?php foreach ($pdfs as $pdf): ?>

                                                <tr>
                                                    <td><?php echo $pdf->pdf_titulo; ?></td>
                                                    <td><a href="<?php echo $pdf->pdf_arquivo; ?>">Arquivo</a></td>

                                                    <td class="text-center"><?php echo ($pdf->pdf_status? '<i class="fas fa-check text-success"></i>' : '<i class="fas fa-times text-danger"></i>'); ?></td>

                                                    <td class="text-center">
                                                        <?php if($editar) :?>
                                                            <a onclick="loading()" data-toggle="tooltip" data-placement="top" title="Editar" href="<?php echo base_url('restrita/' . $this->router->fetch_class() . '/editar_pdf/' . $pdf->pdf_id); ?>" class="btn btn-warning mr-2"><i class="fas fa-edit"></i></a>
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

