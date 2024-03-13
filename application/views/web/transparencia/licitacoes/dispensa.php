<?php $this->load->view('web/layout/navbar'); ?>

<section>

	<?php $this->load->view('web/layout/cabecalho_pagina'); ?>

	<div class="linha">
		<?php foreach ($dispensas as $dispensa) : ?>

			<div class="colunas lg-12">
				<h3><?= $dispensa->dis_titulo ?></h3>
				<p>
					<strong>Modalidade:</strong> <?= $dispensa->dis_modalidade ?>
				</p>
				<p>
					<strong>Processo de Compras/Administrativo:</strong> <?= $dispensa->dis_processo ?>
				</p>
				<p>
					<strong>Objeto:</strong> <?= $dispensa->dis_objetivo ?>
				</p>

				<?php foreach(get_pdf($dispensa->dis_id) as $pdf) :?>

				<p><a href="<?= base_url('uploads/paginas/licitacoes/dispensa/').$pdf->disdoc_arquivo ?>"><i class="fas fa-file-pdf"></i>&nbsp; <?=$pdf->disdoc_titulo?></a>
				
				<?php endforeach ?>
				<hr>
			</div>

		<?php endforeach ?>

	</div>


</section>
