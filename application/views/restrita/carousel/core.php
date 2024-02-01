
<form method="post" name="form_core">
<div class="main-wrapper main-wrapper-1">

    <?php $this->load->view('restrita/layout/navbar'); ?>

    <?php $this->load->view('restrita/layout/sidebar'); ?>

    <!-- Main Content -->
    <div class="main-content">

        <section class="section">
            <div class="section-body">

                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">

                        <div class="card">
                        <?php if ($mensagem = $this->session->flashdata('erro')): ?>

                            <div class="alert alert-danger alert-dismissible show fade">
                                <div class="alert-body" style="color: white !important">
                                    <button class="close" data-dismiss="alert">
                                        <span>&times;</span>
                                    </button>
                                    <?php echo $mensagem; ?>
                                </div>
                            </div>

                            <?php endif; ?>

                                <div class="card-header">
                                    <h4><?php echo $titulo; ?></h4>
                                </div>
                                
                                <div class="card-body">

                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label>Inserir banners (Selecione várias imagens JPG|PNG|GIF) ideal 1950x800</label>
                                            <div id="fileuploader"> </div>
                                            <div id="erro_uploaded" class="text-white"></div>
                                            <div id="carregando"> </div>
                                            <?php echo form_error('banner', '<div class="text-danger">', '</div>'); ?>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                    <div class="form-group col-md-12 mt-5">
                                    <h4>Seus banners cadastrados</h4>
                                    </div>
                                    </div>

                                    <div class="form-row" id="uploaded_image">

                                        <?php foreach ($banners as $foto): ?>

                                            <div class="form-group col-md-6">
                                                <div class="p-2 border">
                                                    <img src="<?php echo base_url('uploads/sistema/carousel/' . $foto->banner); ?>" style="height: 200px; width: 100%; object-fit: contain" class="img-thumbnail">
                                                    <label class="mt-3 mb-0">Link (opcional, Link ao clicar no banner)</label>
                                                    <input class="form-control mt-0 mb-1" type="text" name="link[]" value="<?php echo $foto->link; ?>">
                                                    
                                                    <label class="mt-3 mb-0">Título (opcional, para identificação interna no sistema)</label>
                                                    <input class="form-control mt-0 mb-1" type="text" name="titulo[]" value="<?php echo $foto->titulo; ?>">
                                                    
                                                    <label class="mt-3 mb-0">Texto (opcional, texto aparece sobre o banner no site/blog)</label>
                                                    <input class="form-control mt-0 mb-1" type="text" name="texto[]" value="<?php echo $foto->texto; ?>">
                                                    
                                                    <div class="mt-3 mb-4 custom-control custom-radio"><input type="radio" name="foto_principal" id="<?= $foto->banner ?>" <?= $foto->principal ? 'checked' : '' ?> value="<?= $foto->banner ?>"><label for="<?= $foto->banner ?>" class="mt-3 ml-2">Foto principal</label></div>
                                                    <div class="mt-3 mb-4 custom-control custom-radio"><input type="checkbox" name="ativo[]" id="<?= $foto->banner."2" ?>" <?= $foto->ativo ? 'checked' : '' ?> ><label for="<?= $foto->banner."2" ?>" class="mt-3 ml-2">Ativo</label></div>
                                                    
                                                    <input class="form-control" type="hidden" name="banner[]" value="<?php echo $foto->banner; ?>">
                                                    <input class="form-control" type="hidden" name="carousel_id[]" value="<?php echo $foto->carousel_id; ?>">
                                                    <button class="btn btn-danger btn-remove" style="width: 45px; margin: 10px auto">X</button>
                                                    </div>
                                            </div>

                                        <?php endforeach; ?>

                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                             </div>
                                    </div>


                                </div>

                                <div class="card-footer">
                                    <input class="form-control" type="hidden" name="editando" value="1">
                                    <a href="javascript:;" data-toggle="modal" data-target="#salvar_banner" class="btn btn-success">Salvar Tudo</a>
                                    <a onclick="loading()" href="<?php echo base_url('restrita/' . $this->router->fetch_class()); ?>" class="btn btn-dark">Voltar</a>
                                </div>
                           
                        </div>

                    </div>

                </div>

            </div>
        </section>

        <?php $this->load->view('restrita/layout/sidebar_configuracoes'); ?>

    </div>
	<div class="modal fade" style="z-index: 99999999" id="salvar_banner" tabindex="1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Deseja salvar alterações?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="modal-body">

			  </div>
			  <div class="modal-footer bg-whitesmoke br">
				<button onclick="loading()" type="submit" class="btn btn-success" >Salvar</button>
				<button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
			  </div>
			</div>
		  </div>
		</div>
 </form>
