<?php $this->load->view('web/layout/navbar'); ?>

<section class='paginas-diretoria'>

	<?php $this->load->view('web/layout/cabecalho_pagina'); ?>

	<div class="linha">
		<div class="colunas lg-6">
			<img src="<?= base_url('uploads/paginas/censo_previdenciario/') . $pagina->cont_foto ?>" alt="">
		</div>
		<div class="colunas lg-6">
			<h2><?= $pagina->cont_titulo ?></h2>
			<?php foreach ($faq as $f) : ?>

				<h3><?= $f->cep_titulo ?></h3>
				<h4><?= $f->cep_texto ?></h4>
			<?php endforeach ?>
		</div>
	</div>
	<div class="linha">
			<div class="colunas lg-12">
				<?=$pagina->cont_subtitulo?>
			</div>
		<?php foreach($pdfs as $pdf) :?>
		<div class="colunas lg-12">
			<p><?=$pdf->pdf_titulo?></p>
		</div>
		<?php endforeach ?>
	</div>

</section>
