<?php $this->load->view('web/layout/navbar'); ?>

<section class='paginas-diretoria'>

	<?php $this->load->view('web/layout/cabecalho_pagina'); ?>

	<div class="linha">
		<div class="colunas lg-4">
			<img src="<?= base_url('uploads/paginas/presidencia/').$pagina->cont_foto ?>" alt="">
		</div>
		<div class="colunas lg-8">
			<p><strong><?= $pagina->cont_titulo ?></strong></p><br>
			<p><?= $pagina->cont_subtitulo ?></p><br>
			<p>
				<?= $pagina->cont_texto ?>
			</p>
		</div>
	</div>

</section>
