<?php $this->load->view('web/layout/navbar'); ?>

<section class='paginas-diretoria'>

	<?php $this->load->view('web/layout/cabecalho_pagina'); ?>

	<div class="linha">
		
		<div class="colunas lg-12">
			<?php foreach($paginas as $pag) :?>
				<a href="<?=($pag->pag_link_externo ? $pag->pag_link : base_url('transparencia/juridico/'.$pag->pag_link))?>"><p><?=$pag->pag_nome?></p></a>
			<?php endforeach ?>
		</div>
	</div>

</section>
