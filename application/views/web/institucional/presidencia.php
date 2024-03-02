<?php $this->load->view('web/layout/navbar'); ?>

<style>
	.paginas-diretoria img{
		width: 100%;
		height: 400px;
		object-fit: cover;
	}
</style>

<section class='paginas-diretoria'>

	<?php $this->load->view('web/layout/cabecalho_pagina'); ?>

	<div class="linha">
		<div class="colunas lg-4">
			<img src="<?= base_url('uploads/paginas/presidencia/').$pagina->cont_foto ?>" alt="">
		</div>
		<div class="colunas lg-8">
			<p><strong><?= $pagina->cont_titulo ?></strong></p>
			<p><?= $pagina->cont_subtitulo ?></p>
			<p>
				<?= $pagina->cont_texto ?>
			</p>
		</div>
	</div>

</section>
