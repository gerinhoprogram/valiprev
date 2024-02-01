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

									<?php if ($adicionar) : ?>
										<?php if($menu_qtd <= 7) :?>
											<a onclick="loading()" href="<?php echo base_url('restrita/' . $this->router->fetch_class() . '/core/') ?>" data-toggle="tooltip" data-placement="top" title="Adicionar novo registro" class="btn btn-success float-right"><i class="fas fa-plus"></i>&nbsp;Novo registro</a>
										<?php else :?>

											<a  href="#javascript" data-toggle="tooltip" data-placement="top" title="já atingiu o número máximo permito de menu principal" class="btn btn-warning float-right">Número máximo atingido</a>

										<?php endif ?>
									<?php endif ?>

								</div>
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table class="table table-striped table-artigos">
                                        <thead>
                                            <tr>
                                                <th>Nome</th>
												<th>Criador</th>
                                                <th class="nosort text-center">Status</th>
												<th class="text-center">Ordenação</th>
                                                <?php if($excluir || $editar) :?>
                                                <th class="nosort text-center">Ações</th>
                                                <?php endif ?>
                                            </tr>
                                        </thead>
                                        <tbody>


                                            <?php foreach ($menus as $men): ?>

                                                <tr>
                                                    <td>
                                                    <?=$men->men_nome?>
                                                    </td>
													<td>
                                                    <?=$men->men_criador?>
                                                    </td>
                                                    
                                                    <td class="text-center"><?=($men->men_status == 1 ? '<i class="fas fa-check text-success"></i>' : '<i class="fas fa-times text-danger"></i>'); ?></td>
                                                    <td class="text-center"><span class="badge badge-info"><?=$men->men_ordem?></td>

                                                    <?php if($excluir || $editar) :?>
                                                    <td  class="text-center">
                                                        <?php if($editar) :?>
                                                        <a onclick="loading()" data-toggle="tooltip" data-placement="top" title="Editar" href="<?=base_url('restrita/' . $this->router->fetch_class() . '/core/' . $men->men_id); ?>" class="btn btn-warning mr-2"><i class="fas fa-edit"></i></a>
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

