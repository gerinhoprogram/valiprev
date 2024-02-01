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
                                                <th>Titulo</th>
                                                <th>Usuário vinculados</th>
                                                <?php if($excluir || $editar) :?>
                                                <th class="nosort text-center">Ações</th>
                                                <?php endif ?>
                                            </tr>
                                        </thead>
                                        <tbody>


                                            <?php foreach($setores as $setor): ?>

                                                <tr>
                                                   
                                                    <td><?=$setor->setor_nome; ?></td>
                                                    <td><?php foreach(cont('users', array('users.setor_id' => $setor->setor_id)) as $usuario) : ?>
                                                        <?=$usuario->first_name?><br>
                                                        <?php endforeach ?>
                                                    </td>
                                                    
                                                    <?php if($excluir || $editar) :?>

                                                        <td  class="text-center">
                                                            <?php if($editar) :?>
                                                                <a onclick="loading()" data-toggle="tooltip" data-placement="top" title="Editar" href="<?=base_url('restrita/' . $this->router->fetch_class() . '/core/' . $setor->setor_id); ?>" class="btn btn-warning mr-2"><i class="fas fa-edit"></i></a>
                                                            <?php endif ?>

                                                            <?php if($excluir) : ?>
                                                                <a data-toggle="tooltip" data-placement="top" title="Excluir" href="<?=base_url('restrita/' . $this->router->fetch_class() . '/delete/' . $setor->setor_id); ?>" class="btn btn-danger delete" data-confirm="Tem certeza da exclusão do registro?"><i class="fas fa-trash-alt"></i></a>
                                                            <?php endif ?>

                                                        </td>
                                                    <?php endif ?>
                                                </tr>

                                            <?php endforeach ?>

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

