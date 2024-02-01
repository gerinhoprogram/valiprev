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

                                    <?php
                                    if (isset($anuncio)) {

                                        $anuncio_id = $anuncio->anuncio_id;
                                    } else {

                                        $anuncio_id = '';
                                    }
                                    ?>


                                    <form role="form" class="login-form" action="<?php echo base_url('conta/core/' . $anuncio_id); ?>" method="POST">


                                        <?php if (isset($anuncio)): ?>


                                            <?php if ($anuncio->anuncio_publicado == 0): ?>

                                                <div class="alert alert-info alert-dismissible fade show" role="alert">
                                                    <strong>Importante!</strong> Seu anúncio não está publicado no momento, pois está em análise com a equipe responsável. 
                                                    Assim que ele for publicado você receberá um e-mail informativo. Não se preocupe, isso é rapidinho ;)
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>


                                            <?php endif; ?>




                                        <?php endif; ?>




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


                                        <div class="form-row">


                                            <div class="form-group col-md-3">
                                                <label>Código do anúncio</label>
                                                <div class="input-icon">
                                                    <i class="lni lni-code"></i>
                                                    <input type="text" class="form-control" name="anuncio_codigo" value="<?php echo (isset($anuncio) ? $anuncio->anuncio_codigo : $codigo_gerado); ?>" readonly="">
                                                </div>
                                                <?php echo form_error('anuncio_codigo', '<div class="text-danger">', '</div>'); ?>
                                            </div>


                                            <div class="form-group col-md-9">
                                                <label>Título do anúncio</label>
                                                <div class="input-icon">
                                                    <i class="lni lni-pencil-alt"></i>
                                                    <input type="text" class="form-control" name="anuncio_titulo" value="<?php echo (isset($anuncio) ? $anuncio->anuncio_titulo : set_value('anuncio_titulo')); ?>">
                                                </div>
                                                <?php echo form_error('anuncio_titulo', '<div class="text-danger">', '</div>'); ?>
                                            </div>

                                        </div>


                                        <div class="form-row">


                                            <div class="form-group col-md-6">
                                                <label class="mr-3">Categoria principal</label>

                                                <?php if (isset($anuncio)): ?>
                                                    <span class="text-info small">Atual: <?php echo $anuncio->categoria_pai_nome; ?></span>
                                                <?php endif; ?>

                                                <select id="master" class="form-control js-example-basic-single" name="anuncio_categoria_pai_id">

                                                    <option value="">Escolha uma categoria principal...</option>

                                                    <?php foreach ($categorias_pai as $cat_pai): ?>

                                                        <option value="<?php echo $cat_pai->categoria_pai_id; ?>"><?php echo $cat_pai->categoria_pai_nome; ?></option>

                                                    <?php endforeach; ?>


                                                </select>
                                                <?php echo form_error('anuncio_categoria_pai_id', '<div class="text-danger">', '</div>'); ?>
                                            </div>



                                            <div class="form-group col-md-6">

                                                <label class="mr-3">Categoria secundária</label>

                                                <?php if (isset($anuncio)): ?>
                                                    <span class="text-info small">Atual: <?php echo $anuncio->categoria_nome; ?></span>
                                                <?php endif; ?>




                                                <select id="anuncio_categoria" class="form-control js-example-basic-single" name="anuncio_categoria_id">


                                                    <option value="">Escolha uma categoria principal...</option>


                                                </select>
                                                <?php echo form_error('anuncio_categoria_id', '<div class="text-danger">', '</div>'); ?>
                                            </div>

                                        </div>


                                        <div class="form-row">


                                            <div class="form-group col-md-4">
                                                <label>Preço do anúncio</label>
                                                <div class="input-icon">
                                                    <i class="lni-wallet"></i>
                                                    <input type="text" class="form-control money2" name="anuncio_preco" value="<?php echo (isset($anuncio) ? $anuncio->anuncio_preco : set_value('anuncio_preco')); ?>">
                                                </div>
                                                <?php echo form_error('anuncio_preco', '<div class="text-danger">', '</div>'); ?>
                                            </div>



                                            <div class="form-group col-md-4">

                                                <label>Situação do item</label>


                                                <select class="form-control" name="anuncio_situacao" style="height: calc(2.25rem + 7px);">

                                                    <?php if (isset($anuncio)): ?>


                                                        <option value="1" <?php echo ($anuncio->anuncio_situacao == 1 ? 'selected' : ''); ?>>Novo</option>
                                                        <option value="0" <?php echo ($anuncio->anuncio_situacao == 0 ? 'selected' : ''); ?>>Usado</option>

                                                    <?php else: ?>

                                                        <option value="1">Novo</option>
                                                        <option value="0">Usado</option>


                                                    <?php endif; ?>



                                                </select>
                                                <?php echo form_error('anuncio_situacao', '<div class="text-danger">', '</div>'); ?>
                                            </div>



                                            <div class="form-group col-md-4">
                                                <label>Localização do anúncio</label>
                                                <div class="input-icon">
                                                    <i class="lni lni-map-marker"></i>
                                                    <input type="text" class="form-control cep" name="anuncio_localizacao_cep" value="<?php echo (isset($anuncio) ? $anuncio->anuncio_localizacao_cep : set_value('anuncio_localizacao_cep')); ?>">
                                                </div>
                                                <?php echo form_error('anuncio_localizacao_cep', '<div class="text-danger">', '</div>'); ?>
                                                <div id="anuncio_localizacao_cep"></div>
                                            </div>



                                        </div>



                                        <div class="form-row">



                                            <div class="form-group col-md-12">
                                                <label>Descrição do anúncio</label>
                                                <textarea class="form-control" name="anuncio_descricao" style="min-height: 200px"><?php echo (isset($anuncio) ? $anuncio->anuncio_descricao : set_value('anuncio_descricao')); ?></textarea>
                                                <?php echo form_error('anuncio_descricao', '<div class="text-danger">', '</div>'); ?>
                                            </div>



                                        </div>


                                        <div class="form-row">


                                            <div class="form-group col-md-8">

                                                <label>Imagens do anúncio</label>

                                                <div id="fileuploader">

                                                </div>

                                                <div id="erro_uploaded" class="text-danger">

                                                </div>

                                                <?php echo form_error('fotos_produtos', '<div class="text-danger">', '</div>'); ?>

                                            </div>


                                        </div>


                                        <div class="form-row">




                                            <div class="form-group col-md-12">

                                                <?php if (isset($anuncio)): ?>


                                                    <div id="uploaded_image">


                                                        <?php foreach ($fotos_anuncio as $foto): ?>


                                                            <ul style="list-style: none; display:  inline-block;">

                                                                <li class="text-center">

                                                                    <img src="<?php echo base_url('uploads/anuncios/small/' . $foto->foto_nome); ?>" width="80" class="img-thumbnail mr-1 mb-2">
                                                                    <input type="hidden" name="fotos_produtos[]" value="<?php echo $foto->foto_nome; ?>"><br>
                                                                    <button class="btn btn-danger btn-remove">X</button>

                                                                </li>

                                                            </ul>



                                                        <?php endforeach; ?>



                                                    </div>

                                                <?php else: ?>


                                                    <div id="uploaded_image">
                                                        
                                                        

                                                    </div>



                                                <?php endif; ?>

                                            </div>




                                        </div>


                                        <div class="mb-1">
                                            <button type="submit" class="btn btn-common log-btn">Salvar</button>
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
