<div class="main-wrapper main-wrapper-1">

    <?php $this->load->view('restrita/layout/navbar'); ?>

    <?php $this->load->view('restrita/layout/sidebar'); ?>

    <!-- Main Content -->
    <div class="main-content">

        <section>
            <div class="section-body">

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-block">
                                <h4><?php echo $titulo ?></h4>
                                
                            </div>

                            <div class="card-body">

                                <div class="table-responsive">
                                <table class="table table-striped" id="tableExport" style="width:100%;">
                                        <thead>
                                            <tr>
                                                <!-- <th class="text-center">Ação</th> -->
                                                <th>Evento</th> 
                                                <?php if(!isset($usuario)) :?>
                                                    <th>Usuário</th>
                                                <?php endif ?>
                                                   
                                                <th>Data</th>
                                                <th>IP</th>
                                                <th>Rota</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php foreach ($logs as $log) : ?>

                                                <tr>
                                                    <!-- <td class="text-center">
                                                        <?php if ($log->tipo == 1) : ?>
                                                            <span class="text-info"><i class="fas fa-eye"></i><br>Visualizou
                                                        <?php endif ?>
                                                        <?php if ($log->tipo == 2) : ?>
                                                            <span class="text-success"><i class="fas fa-plus"></i><br>Adicionou
                                                        <?php endif ?>
                                                        <?php if ($log->tipo == 3) : ?>
                                                            <span class="text-warning"><i class="fas fa-edit"></i><br>Editou
                                                        <?php endif ?>
                                                        <?php if ($log->tipo == 4) : ?>
                                                            <span class="text-danger"><i class="fas fa-trash"></i><br>Deletou
                                                        <?php endif ?>
                                                        <?php if ($log->tipo == 5) : ?>
                                                            <span class="text-secondary"><i class="far fa-comment"></i><br>Informação
                                                        <?php endif ?>
                                                        <?php if ($log->tipo == 6) : ?>
                                                            <span class="text-dark"><i class="fas fa-exclamation-triangle"></i><br>Erro de acesso
                                                        <?php endif ?>

                                                    </td> -->

                                                    <td>
                                                        

                                                        <?php echo $log->acao ?>


                                                    </td>

                                                    <?php if(!isset($usuario)) :?>
                                                    <td><?php echo $log->login ?></td>
                                                    <?php endif ?>

                                                    <td><?php echo formata_data_banco_com_hora($log->log_data); ?></td>
                                                    <td><?php echo $log->ip ?></td>
                                                    <td><?php echo $log->log_controller .'/'.$log->log_method ?></td>

                                                    

                                                    
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