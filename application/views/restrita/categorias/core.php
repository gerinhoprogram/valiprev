<style>
 #box-foto-banner img{
        width: 100%;
        height: 300px;
        object-fit: contain
    }
</style>
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

                                <div class="card-header">
                                    <h4><?php echo $titulo; ?></h4>
                                </div>
                                <div class="card-body">

                                    <div class="form-row">

                                        <div class="form-group col-md-6">
                                            <label>Nome da categoria</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-cube text-info"></i>
                                                    </div>
                                                </div>
                                                <input type="text" required id="categoria_filha" class="form-control" name="categoria_nome" value="<?php echo (isset($categoria) ? $categoria->categoria_nome : set_value('categoria_nome')); ?>">
                                            </div>
                                            <div class="error_nome_categoria"></div>
                                            <?php echo form_error('categoria_nome', '<div class="text-danger">', '</div>'); ?>
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label>Status</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-check-circle text-info"></i>
                                                    </div>
                                                </div>
                                                <select class="custom-select" name="categoria_ativa">

                                                    <?php if (isset($categoria)): ?>

                                                        <option value="0" <?php echo ($categoria->categoria_ativa == 0 ? 'selected' : ''); ?>>Inativo</option>
                                                        <option value="1" <?php echo ($categoria->categoria_ativa == 1 ? 'selected' : ''); ?>>Ativo</option>

                                                    <?php else: ?>

                                                        <option value="1">Ativo</option>
                                                        <option value="0">Inativo</option>

                                                    <?php endif; ?>

                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label>Categoria principal</label>
                                            <div class="input-group">
                                                
                                                <select class="form-control" name="categoria_pai_id">

                                                    <!-- <option value="">Escolha uma categoria pai...</option> -->

                                                    <?php foreach ($masters as $master): ?>

                                                        <?php if (isset($categoria)): ?>

                                                            <option value="<?php echo $master->categoria_pai_id; ?>" <?php echo ($categoria->categoria_pai_id == $master->categoria_pai_id ? 'selected' : ''); ?>><?php echo $master->categoria_pai_nome; ?></option>


                                                        <?php else: ?>

                                                            <option value="<?php echo $master->categoria_pai_id; ?>"><?php echo $master->categoria_pai_nome; ?></option>

                                                        <?php endif; ?>

                                                    <?php endforeach; ?>

                                                </select>
                                            </div>
                                            <?php echo form_error('categoria_pai_id', '<div class="text-danger">', '</div>'); ?>
                                        </div>
                                        </div>

                                        <?php if (isset($categoria)): ?>

                                            <input type="hidden" name="categoria_id" value="<?php echo $categoria->categoria_id; ?>">

                                        <?php endif; ?>
                                    

                                </div>
                                <div class="card-footer">
                                		<span onclick="verificar_subcategoria()">
                                        <a href="javascrip:;" data-toggle="modal" data-target="#salvar_categoria" class="btn btn-success salvar_sub" >Salvar</a>
                                        </span>
                                    <a onclick="loading()" href="<?php echo base_url('restrita/' . $this->router->fetch_class()); ?>" class="btn btn-dark">Voltar</a>
                                    <div class="error_nome_categoria"></div>
                                </div>                       
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php $this->load->view('restrita/layout/sidebar_configuracoes'); ?>

    </div>
	<div class="modal fade" style="z-index: 99999999" id="salvar_categoria" tabindex="1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Deseja salvar?</h5>
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
