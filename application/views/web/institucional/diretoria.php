<?php $this->load->view('web/layout/navbar'); ?>

<section class='paginas-diretoria'>

	<?php $this->load->view('web/layout/cabecalho_pagina'); ?>

	<?php if (isset($paginas)) : ?>

		<div class="linha">

			<div class="colunas lg-12">
				<?php foreach ($paginas as $pag) : ?>
					<a href="<?= ($pag->pag_link_externo ? $pag->pag_link : base_url('institucional/diretoria/' . $pag->pag_link)) ?>">
						<p><?= $pag->pag_nome ?></p>
					</a>
				<?php endforeach ?>
			</div>
		</div>

	<?php else : ?>

		<div class="linha">
			<div class="colunas lg-4">
				<img src="<?= base_url('uploads/paginas/diretoria/') . $pagina->cont_foto ?>" alt="">
			</div>
			<div class="colunas lg-8">
				<p><strong><?= $pagina->cont_titulo ?></strong></p>
				<br>
				<p><?= $pagina->cont_subtitulo ?></p>
				<br>
				<p>
					<?= $pagina->cont_texto ?>
				</p>
			</div>
		</div>

	<?php endif ?>

</section>
