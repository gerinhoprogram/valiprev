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
												<th>Foto</th>
                                                <th>Nome</th>
												<th>Cargo</th>
												<th>Categoria</th>
												<th>Conselho</th>

                                                <th class="nosort text-center">Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                            <?php foreach ($conselheiros as $conselho): ?>

                                                <tr>
													<td>
														<img src="<?= base_url('uploads/paginas/conselhos/conselheiros/'. $conselho->con_foto) ?>" alt="" style='height: 80px; object-fit: contain; width: 100%'>
													</td>
                                                    <td>
														<?= $conselho->con_nome ?>
													</td>
													<td>
														<?= $conselho->con_cargo ?>
													</td>
													<td>
														<?= $conselho->con_categoria ?>
													</td>
													<td>
														<?= $conselho->pag_nome ?>
													</td>
													
													<td class="text-center">
                                                        <div class="dropdown">
                                                            <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Opções</a>
                                                                <div class="dropdown-menu border">

                                                                    
                                                                    <?php if($editar) :?>
																		
                                                                    		<a onclick="loading()" data-toggle="tooltip" data-placement="left" title="Editar informações" href="<?php echo base_url('restrita/' . $this->router->fetch_class() . '/core/' . $conselho->con_id); ?>" class="dropdown-item has-icon text-warning"><i class="fas fa-edit"></i> Editar</a>
                                                                        
                                                                    <?php endif ?>

																	<?php if($excluir) :?>
                                                                    <a data-toggle="tooltip" data-placement="left" title="Excluir permanente" href="<?= base_url('restrita/' . $this->router->fetch_class() . '/delete/' . $conselho->con_id); ?>" class="dropdown-item has-icon delete text-danger" data-confirm="Tem certeza da exclusão do registro?"><i class="fas fa-trash-alt"></i> Excluir</a>
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

