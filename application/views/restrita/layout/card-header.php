<div class="card-header d-block">
  <h4><?php echo $titulo ?></h4>

  <?php if($adicionar) :?>
  <a onclick="loading()" href="<?php echo base_url('restrita/'.$this->router->fetch_class().'/core/') ?>" data-toggle="tooltip" data-placement="top" title="Adicionar novo registro" class="btn btn-success float-right"><i class="fas fa-plus"></i>&nbsp;Novo registro</a>
  <?php endif?>
  
</div>