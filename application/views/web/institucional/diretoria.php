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

	<?php if (isset($paginas)) : ?>

		<div class="linha">

			<div class="colunas lg-12">
				<?php foreach ($paginas as $pag) : ?>
					<a href="<?= ($pag->pag_link_externo ? $pag->pag_link : base_url('institucional/diretoria/' . $pag->pag_link)) ?>">
						<p class="lista-paginas"><i class="fas fa-chevron-right"></i>&nbsp;<?= $pag->pag_nome ?></p>
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
				
				<p><?= $pagina->cont_subtitulo ?></p>
				
				<p>
					<?= $pagina->cont_texto ?>
				</p>
			</div>
		</div>

	<?php endif ?>

</section>
