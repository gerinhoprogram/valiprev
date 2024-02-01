<?php $this->load->view('web/layout/navbar'); ?>


<div id="content" class="section-padding">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-4 col-lg-3 page-sidebar">

                <?php $this->load->view('web/conta/sidebar'); ?>


            </div>
            <div class="col-sm-12 col-md-8 col-lg-9">
                <div class="row page-content">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="inner-box">
                            <div class="dashboard-box">
                                <h2 class="dashbord-title"><?php echo $titulo; ?></h2>
                            </div>
                            <div class="dashboard-wrapper">


                                <div class="login-form login-area">




                                    <form role="form" class="login-form">


                                        <div class="form-row">


                                            <div class="form-group col-md-12">
                                                <label>Data da pergunta</label>
                                                <div class="input-icon">
                                                    <i class="lni-alarm-clock"></i>
                                                    <input type="text" class="form-control" value="<?php echo formata_data_banco_com_hora($pergunta->data_pergunta); ?>" readonly="">
                                                </div>
                                            </div>

                                            <div class="form-group col-md-12">

                                                <label>O que foi perguntado</label>
                                                <textarea class="form-control" readonly=""><?php echo $pergunta->pergunta; ?></textarea>

                                            </div>


                                        </div>


                                        <div class="form-row">




                                            <div class="form-group col-md-12">
                                                <label>Data da resposta</label>
                                                <div class="input-icon">
                                                    <i class="lni-alarm-clock text-white"></i>
                                                    <input type="text" class="form-control bg-info text-white" value="<?php echo ($pergunta->pergunta_respondida == 1 ? formata_data_banco_com_hora($pergunta->data_resposta) : 'Aguardando resposta'); ?>" readonly="">
                                                </div>
                                            </div>




                                            <div class="form-group col-md-12">

                                                <label><?php echo ($pergunta->pergunta_respondida == 1 ? 'O que foi respondido' : 'Aguardando resposta'); ?></label>


                                                <textarea class="form-control bg-info text-white"><?php echo ($pergunta->pergunta_respondida == 1 ? $pergunta->resposta : 'Aguardando resposta'); ?></textarea>

                                            </div>


                                        </div>


                                    </form>
                                </div>



                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
