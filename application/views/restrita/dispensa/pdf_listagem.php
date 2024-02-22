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
							<a onclick="loading()" href="<?php echo base_url('restrita/'.$this->router->fetch_class().'/pdf_adicionar/'.$pagina->pag_id) ?>" data-toggle="tooltip" data-placement="top" title="Adicionar novo registro" class="btn btn-success float-right"><i class="fas fa-plus"></i>&nbsp;Novo registro</a>
							<?php endif?>
						
						</div>
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table class="table table-striped table-artigos">
                                        <thead>
                                            <tr>
                                                <th>Título</th>
												<th>Tamanho</th>
												<th>Criação</th>
                                                <th class="nosort text-center">Status</th>
                                                <th class="nosort text-center">Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                            <?php foreach ($pdfs as $pdf): ?>

                                                <tr>
                                                    <td><?php echo $pdf->pdf_titulo; ?></td>
													<td><?php echo $pdf->pdf_tamanho; ?></td>
													<td><?php echo formata_data_banco_com_hora($pdf->pdf_data) ?></td>
                                                    <td class="text-center"><?php echo ($pdf->pdf_status? '<i class="fas fa-check text-success"></i>' : '<i class="fas fa-times text-danger"></i>'); ?></td>

													<td class="text-center">
                                                        <div class="dropdown">
                                                            <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Opções</a>
                                                                <div class="dropdown-menu border">

                                                                    
                                                                    <?php if($editar) :?>
                                                                    		<a onclick="loading()" data-toggle="tooltip" data-placement="left" title="Editar informações" href="<?php echo base_url('restrita/' . $this->router->fetch_class() . '/pdf_editar/'. $pagina->pag_id .'/' . $pdf->pdf_id); ?>" class="dropdown-item has-icon text-warning"><i class="fas fa-edit"></i> Editar</a>
                                                                        
                                                                    		<a onclick="loading()" data-toggle="tooltip" data-placement="left" title="Ver arquivo" href="<?php echo base_url('uploads/paginas/censo_previdenciario/pdf/'). $pdf->pdf_arquivo; ?>" class="dropdown-item has-icon text-info"><i class="fas fa-edit"></i> Ver arquivo</a>
                                                                    <?php endif ?>

																	<?php if($excluir) :?>
                                                                    <a data-toggle="tooltip" data-placement="left" title="Excluir permanente" href="<?= base_url('restrita/' . $this->router->fetch_class() . '/delete/' . $pdf->pdf_id); ?>" class="dropdown-item has-icon delete text-danger" data-confirm="Tem certeza da exclusão do registro?"><i class="fas fa-trash-alt"></i> Excluir</a>
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

