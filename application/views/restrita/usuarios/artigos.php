

<div class="main-wrapper main-wrapper-1">

    <?php $this->load->view('restrita/layout/navbar'); ?>

    <?php $this->load->view('restrita/layout/sidebar'); ?>

    <!-- Main Content -->
    <div class="main-content">

        <section class="">
            <div class="section-body">

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                        <div class="card-header d-block">
                                <h4><?php echo $titulo ?></h4>
                                
                                </div>
                            <div class="card-body">
                                
                                <div class="table-responsive">
                                    <table class="table table-striped table-artigos">
                                        <thead>
                                            <tr>
                                                <th>Título</th>
                                                <th>Categoria Principal</th>
                                                <th>Subcategoria</th>
                                                <th class="nosort">Leitura</th>
                                                
                                                <th>Situação</th>
                                                <th class="nosort text-center">Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                            <?php foreach ($artigos as $artigo): ?>

                                                <tr>
                                                    <td><?= $artigo->artigo_titulo; ?></td>
                                                    <td><i class="<?=$artigo->categoria_pai_classe_icone?>" style="color:<?=$artigo->categoria_pai_cor?>"></i>&nbsp;<?= $artigo->categoria_pai_nome; ?></td>
                                                    <td>
                                                        <?php 
                                                            foreach($subcategorias as $sub){
                                                                echo ($sub->ca_id_artigo == $artigo->artigo_id ? $sub->categoria_nome."<br>" : '');
                                                            }
                                                        ?>
                                                    </td>
                                                    <td><div class="badge badge-secundary badge-shadow"><?=$artigo->artigo_tempo_leitura?></div></td>

                                                    
                                                    <td class="text-center"><?= ($artigo->artigo_publicado == 1 ? '<div class="badge badge-success badge-shadow">Publicado</div>' : ($artigo->artigo_publicado == 0 ? '<div class="badge badge-danger badge-shadow">Inativo</div>' : '<div data-toggle="tooltip" data-placement="left" title="'.formata_data_banco_com_hora($artigo->agenda_data_hora).'" class="badge badge-warning badge-shadow">Agendado</div>')); ?></td>
                                                    
                                                    <td class="text-center">
                                                        <div class="dropdown">
                                                            <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Opções</a>
                                                                <div class="dropdown-menu border">

                                                                    
                                                                    <?php if($editar) :?>
                                                                        <?php if($artigo->artigo_publicado) :?>
                                                                            <a data-toggle="tooltip" data-placement="left" title="Inativar" href="<?= base_url('restrita/' . $this->router->fetch_class() . '/situacao/' . $artigo->artigo_id.'/'.$usuario->id); ?>" class="dropdown-item has-icon situacao text-warning" data-confirm="Deseja inativar o artigo?"><i class="fas fa-trash-alt"></i> Inativar</a>

                                                                        <?php else :?>
                                                                            <a data-toggle="tooltip" data-placement="left" title="Ativar" href="<?= base_url('restrita/' . $this->router->fetch_class() . '/situacao/' . $artigo->artigo_id.'/'.$usuario->id); ?>" class="dropdown-item has-icon situacao text-warning" data-confirm="Deseja ativar o artigo?"><i class="fas fa-trash-alt"></i> Ativar</a>

                                                                            <?php endif ?>
                                                                    <?php endif ?>

                                                                    <?php if($excluir) :?>
                                                                    <a data-toggle="tooltip" data-placement="left" title="Excluir permanente" href="<?= base_url('restrita/' . $this->router->fetch_class() . '/delete_artigo/' . $artigo->artigo_id.'/'.$usuario->id); ?>" class="dropdown-item has-icon delete text-danger" data-confirm="Tem certeza da exclusão do registro?"><i class="fas fa-trash-alt"></i> Excluir</a>
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

