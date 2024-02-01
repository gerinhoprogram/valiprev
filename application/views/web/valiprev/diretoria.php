<?php $this->load->view('web/layout/navbar'); ?>

<section class='paginas-diretoria'>

	<?php $this->load->view('web/layout/cabecalho_pagina'); ?>

	<div class="linha">
		<div class="colunas lg-4">
			<img src="<?= base_url('uploads/paginas/diretoria/').$pagina->cont_foto ?>" alt="">
		</div>
		<div class="colunas lg-8">
			<p><?= $pagina->cont_titulo ?></p>
			<p><?= $pagina->cont_subtitulo ?></p>
			<p>
				<?= $pagina->cont_texto ?>
			</p>
		</div>
	</div>

</section>
