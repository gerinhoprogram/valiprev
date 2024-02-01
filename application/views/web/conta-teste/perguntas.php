<?php $this->load->view('web/layout/navbar'); ?>


<div id="content" class="section-padding">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-4 col-lg-3 page-sidebar">

                <?php $this->load->view('web/conta/sidebar'); ?>

            </div>

            <?php if (isset($perguntas)): ?>


                <div class="col-sm-12 col-md-8 col-lg-9">


                    <?php if ($mensagem = $this->session->flashdata('sucesso')): ?>

                        <div class="alert alert-success bg-success text-white alert-dismissible show fade">
                            <div class="alert-body" style="color: white !important">
                                <button class="close" data-dismiss="alert">
                                    <span>&times;</span>
                                </button>
                                <?php echo $mensagem; ?>
                            </div>
                        </div>

                    <?php endif; ?>


                    <?php if ($mensagem = $this->session->flashdata('erro')): ?>

                        <div class="alert alert-danger bg-danger text-white alert-dismissible show fade">
                            <div class="alert-body" style="color: white !important">
                                <button class="close" data-dismiss="alert">
                                    <span>&times;</span>
                                </button>
                                <?php echo $mensagem; ?>
                            </div>
                        </div>

                    <?php endif; ?>



                    <div class="page-content">
                        <div class="inner-box">
                            <div class="dashboard-box">
                                <h2 class="dashbord-title"><?php echo $titulo; ?></h2>
                            </div>
                            <div class="dashboard-wrapper">
                                <table class="table table-responsive dashboardtable table-anuncios">
                                    <thead>
                                        <tr>

                                            <th>Pergunta</th>
                                            <th>Data da pergunta</th>
                                            <th>Respondida</th>
                                            <th class="nosort">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php foreach ($perguntas as $pergunta): ?>

                                            <tr data-category="active">

                                                <td data-title="Title">
                                                    <h3><?php echo word_limiter($pergunta->pergunta, 5); ?></h3>
                                                </td>

                                                <td data-title="Category"><span class="adcategories"><?php echo formata_data_banco_com_hora($pergunta->data_pergunta); ?></span></td>


                                                <td data-title="Ad Status"><?php echo ($pergunta->pergunta_respondida == 1 ? '<span class="adstatus adstatusactive">Sim</span>' : '<span class="adstatus adstatusexpired">Não</span>'); ?></td>

                                                <td data-title="Action">
                                                    <div class="btns-actions">
                                                        
                                                        
                                                        <a class="btn-action <?php echo ($pergunta->pergunta_respondida == 1 ? 'btn-view' : 'btn-edit') ?>" href="<?php echo base_url($this->router->fetch_class() . '/responder/' . $pergunta->pergunta_id); ?>"><i class="<?php echo ($pergunta->pergunta_respondida == 1 ? 'lni-eye' : 'lni-pencil') ?> "></i></a>


                                                        <?php if ($pergunta->pergunta_respondida == 1): ?>
                                                            <a class="btn-action btn-delete delete" href="<?php echo base_url($this->router->fetch_class() . '/remove/' . $pergunta->pergunta_id); ?>" data-confirm="Tem certeza da exclusão do registro?"><i class="lni-trash"></i></a>
                                                        <?php endif; ?>

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


            <?php else: ?>


                <div class="col-md-9">


                    <div class="container text-center">

                        <h4 class="mb-5">Você não tem perguntas para seus anúncios</h4>

                        <img width="300" src="<?php echo base_url('public/web/assets/img/sem_anuncios.svg'); ?>">

                    </div>

                </div>






            <?php endif; ?>






        </div>
    </div>
</div>
