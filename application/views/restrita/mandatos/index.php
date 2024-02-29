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
						<h4><?php echo $titulo ?></h4>

							<?php if($adicionar) :?>
							<a onclick="loading()" href="<?php echo base_url('restrita/'.$this->router->fetch_class().'/core') ?>" data-toggle="tooltip" data-placement="top" title="Adicionar novo registro" class="btn btn-success float-right"><i class="fas fa-plus"></i>&nbsp;Novo registro</a>
							<?php endif?>
						
						</div>
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table class="table table-striped table-artigos">
                                        <thead>
                                            <tr>
                                                <th>Título</th>
												<th>Decreto</th>
												<th>Conselho</th>

                                                <th class="nosort text-center">Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                            <?php foreach ($mandatos as $mandato): ?>

                                                <tr>
													
                                                    <td>
														<?= $mandato->man_titulo ?>
													</td>
													<td>
														<?= $mandato->man_decreto ?>
													</td>
													<td>
														<?= $mandato->pag_nome ?>
													</td>
													
													<td class="text-center">
                                                        <div class="dropdown">
                                                            <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Opções</a>
                                                                <div class="dropdown-menu border">

                                                                    
                                                                    <?php if($editar) :?>
																		
                                                                    		<a onclick="loading()" data-toggle="tooltip" data-placement="left" title="Editar informações" href="<?php echo base_url('restrita/' . $this->router->fetch_class() . '/core/' . $mandato->man_id); ?>" class="dropdown-item has-icon text-warning"><i class="fas fa-edit"></i> Editar</a>
                                                                        
                                                                    <?php endif ?>

																	<?php if($excluir) :?>
                                                                    <a data-toggle="tooltip" data-placement="left" title="Excluir permanente" href="<?= base_url('restrita/' . $this->router->fetch_class() . '/delete/' . $mandato->man_id); ?>" class="dropdown-item has-icon delete text-danger" data-confirm="Tem certeza da exclusão do registro?"><i class="fas fa-trash-alt"></i> Excluir</a>
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

