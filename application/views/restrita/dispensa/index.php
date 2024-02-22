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
                                                <th class="nosort text-center">Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>


											<?php $linha = 1; ?>
                                            <?php foreach ($dispensa as $dis): ?>

												<?php 
													if($linha == 1){
														$cor = '#ddd';
														$linha = 0;
													} else{
														$cor = '#fff';
														$linha = 1;
													}
												?>

                                                <tr style="background: <?= $cor ?>">
                                                    <td>
														<p><strong>Título: </strong><?php echo $dis->dis_titulo; ?></p>
														<p><strong>Modalidade: </strong><?php echo $dis->dis_modalidade; ?></p>
														<p><strong>Processo de Compras/Administrativo: </strong><?php echo $dis->dis_processo; ?></p>
														<p><strong>Objetivo: </strong><?php echo $dis->dis_objetivo; ?></p>
														
													</td>
													
													<td class="text-center">
                                                        <div class="dropdown">
                                                            <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Opções</a>
                                                                <div class="dropdown-menu border">

                                                                    
                                                                    <?php if($editar) :?>
																		
                                                                    		<a onclick="loading()" data-toggle="tooltip" data-placement="left" title="Editar informações" href="<?php echo base_url('restrita/' . $this->router->fetch_class() . '/core/' . $dis->dis_id); ?>" class="dropdown-item has-icon text-warning"><i class="fas fa-edit"></i> Editar</a>
                                                                        
                                                                    <?php endif ?>

																	<?php if($excluir) :?>
                                                                    <a data-toggle="tooltip" data-placement="left" title="Excluir permanente" href="<?= base_url('restrita/' . $this->router->fetch_class() . '/delete/' . $dis->dis_id); ?>" class="dropdown-item has-icon delete text-danger" data-confirm="Tem certeza da exclusão do registro?"><i class="fas fa-trash-alt"></i> Excluir</a>
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

