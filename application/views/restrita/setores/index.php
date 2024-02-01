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

                            <?php $this->load->view('restrita/layout/card-header'); ?>
                            <div class="card-body">

                            <?php if ($mensagem = $this->session->flashdata('warning')): ?>

                            <div class="alert alert-danger alert-dismissible show fade">
                                <div class="alert-body" style="color: white !important">
                                    <button class="close" data-dismiss="alert">
                                        <span>&times;</span>
                                    </button>
                                    <?php echo $mensagem; ?>
                                </div>
                            </div>

                            <?php endif; ?>

                                <div class="table-responsive">
                                    <table class="table table-striped table-artigos">
                                        <thead>
                                            <tr>
                                                <th>Grupo</th>
                                                <th>Descrição</th>
                                                <th>Áreas</th>
                                                <?php if($editar || $excluir) :?>
                                                <th class="nosort text-center">Ações</th>
                                                <?php endif ?>
                                            </tr>
                                        </thead>
                                        <tbody>


                                            <?php foreach ($setores as $setor) : ?>

                                                <tr>

                                                    <td><?= $setor->name; ?></td>
                                                    <td><?= character_limiter($setor->description, 30) ?></td>
                                                    <td>
                                                        <?php foreach ($acessos_areas as $acesso) {
                                                            if ($acesso->area_grupo_id == $setor->id) {
                                                                echo $acesso->area_nome . ($acesso->permissao ? ' <i class="fa fa-eye text-secondary"></i>' : '') . ($acesso->excluir ? ' <i class="fas fa-trash-alt text-danger"></i>' : '') . ($acesso->editar ? ' <i class="fas fa-edit text-warning"></i>' : '') . ($acesso->adicionar ? ' <i class="fas fa-plus text-success"></i>' : '') . "<br>";
                                                            }
                                                        }
                                                        ?>
                                                    </td>

                                                    <?php if($editar || $excluir) :?>
                                                    <td class="text-center">

                                                        <div class="dropdown">
                                                            <a href="#" data-toggle="dropdown" class="btn btn-warning dropdown-toggle">Opções</a>
                                                            <div class="dropdown-menu">
                                                                <?php if($editar) :?>
                                                                <a data-toggle="tooltip" data-placement="left" title="Alterar permissões para deletar, editar e cadastrar" onclick="loading()" href="<?php echo base_url('restrita/' . $this->router->fetch_class() . '/editar/' . $setor->id) ?>" class="dropdown-item has-icon text-info"><i class="fas fa-eye"></i> Permissões</a>
                                                                <?php endif ?>

                                                                <?php if($editar) :?>
                                                                <a data-toggle="tooltip" data-placement="left" title="Editar dados básicos do grupo" onclick="loading()" href="<?php echo base_url('restrita/' . $this->router->fetch_class() . '/core/' . $setor->id) ?>" class="dropdown-item has-icon text-warning"><i class="far fa-edit"></i> Editar grupo</a>
                                                                <?php endif ?>

                                                                <div class="dropdown-divider"></div>

                                                                <?php if($excluir) :?>
                                                                <a href="<?php echo base_url('restrita/' . $this->router->fetch_class() . '/delete/' . $setor->id) ?>" data-toggle="tooltip" data-placement="left" title="Deletar grupo" class="dropdown-item has-icon delete text-danger" data-confirm="Tem certeza da exclusão do registro?"><i class="far fa-trash-alt"></i>
                                                                    Deletar</a>
                                                                    <?php endif ?>
                                                            </div>
                                                        </div>

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