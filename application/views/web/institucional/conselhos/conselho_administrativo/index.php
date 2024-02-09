<?php $this->load->view('web/layout/navbar'); ?>

<section class='paginas-diretoria'>

	<?php $this->load->view('web/layout/cabecalho_pagina'); ?>

	<?php if (isset($paginas)) : ?>

		<div class="linha">

			<div class="colunas lg-12">
				<?php foreach ($paginas as $pag) : ?>
					<a href="<?= ($pag->pag_link_externo ? $pag->pag_link : base_url('institucional/conselhos/'.$menu->pag_link.'/' . $pag->pag_link)) ?>">
						<p><?= $pag->pag_nome ?></p>
					</a>
				<?php endforeach ?>
			</div>
		</div>

	<?php else : ?>

	
		<div class="linha">

			<div class="colunas lg-12">
			</div>
		</div>
				

	<?php endif ?>

</section>
