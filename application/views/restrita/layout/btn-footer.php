<div class="card-footer">
    <a href="javascript:;" data-toggle="modal" data-target="#salvar" class="btn btn-success"><i class="fas fa-save"></i>&nbsp;&nbsp;Salvar</a>

    <?php if(!isset($sistema)) :?>
        <a onclick="loading()" href="<?php echo base_url('restrita/' . $this->router->fetch_class()) ?>" class="btn btn-primary"><i class="fas fa-reply"></i>&nbsp;&nbsp;Voltar</a>
    <?php endif ?>
</div>
<div class="modal fade" style="z-index: 99999999" id="salvar" tabindex="1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <button onclick="loading_save()" type="submit" class="btn btn-success"><i class="fas fa-save"></i>&nbsp;&nbsp;Confirmar e salvar</button>
                <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>