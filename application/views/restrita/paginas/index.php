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
                        <div class="card-header d-block">
									<h4><?php echo $titulo?></h4>
								</div>
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table class="table table-striped table-artigos">
                                        <thead>
                                            <tr>
                                                <th>Nome</th>
                                                <th class="nosort text-center">Status</th>
                                                <?php if($excluir || $editar) :?>
                                                <th class="nosort text-center">Ações</th>
                                                <?php endif ?>
                                            </tr>
                                        </thead>
                                        <tbody>


                                            <?php foreach ($paginas as $pag): ?>

												<?php $funcao = str_replace("-", "_", $pag->pag_link); ?>

                                                <tr>
                                                    <td>
                                                    <?=$pag->pag_nome?>
                                                    </td>
                                                    
                                                    <td class="text-center"><?=($pag->pag_status == 1 ? '<i class="fas fa-check text-success"></i>' : '<i class="fas fa-times text-danger"></i>'); ?></td>
                                                   
													<td class="text-center">
                                                        <div class="dropdown">
                                                            <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Opções</a>
                                                                <div class="dropdown-menu border">

                                                                    
                                                                    <?php if($editar) :?>
                                                                    <a onclick="loading()" data-toggle="tooltip" data-placement="left" title="Editar informações" href="<?=base_url('restrita/' . $funcao); ?>" class="dropdown-item has-icon text-warning"><i class="fas fa-edit"></i> Editar</a>
                                                                        <?php if($pag->pag_status) :?>
                                                                            <a data-toggle="tooltip" data-placement="left" title="Inativar" href="<?= base_url('restrita/'.$this->router->fetch_class().'/situacao/' . $pag->pag_id); ?>" class="dropdown-item has-icon situacao text-info" data-confirm="Deseja inativar a página?"><i class="fas fa-redo"></i> Inativar</a>

                                                                        <?php else :?>
                                                                            <a data-toggle="tooltip" data-placement="left" title="Ativar" href="<?= base_url('restrita/'.$this->router->fetch_class().'/situacao/' . $pag->pag_id); ?>" class="dropdown-item has-icon situacao text-info" data-confirm="Deseja ativar a página?"><i class="fas fa-redo"></i> Ativar</a>

                                                                            <?php endif ?>
                                                                    <?php endif ?>

                                                                    
                                                                </div>
                                                                   
                                                        </div>
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

