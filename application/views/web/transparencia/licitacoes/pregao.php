<?php $this->load->view('web/layout/navbar'); ?>

<section>

	<?php $this->load->view('web/layout/cabecalho_pagina'); ?>

	<div class="linha">
		<?php foreach ($pdfs as $pregao) : ?>
			<div class="colunas lg-12">

				<h3><?=$pregao->pre_titulo?></h3>
				<p>
					<strong>Modalidade:</strong> <?=$pregao->pre_modalidade?>
				</p>
				<p>
					<strong>Processo de Compras/Administrativo:</strong> <?=$pregao->pre_processo?>
				</p>
				<p>
					<strong>Objeto:</strong> <?=$pregao->pre_objetivo?>
				</p>
				<p>
					<strong>Entrega dos envelopes:</strong> <?=$pregao->pre_entrega?>
				</p>
				<p>
					<strong>Tipo:</strong> <?=$pregao->pre_tipo?>
				</p>
				<p>
					<strong>Estado:</strong> <?=$pregao->pre_estado?>
				</p>

				<?php foreach(get_pregao($pregao->pre_id) as $arquivo) :?>

				<a href="<?= base_url('uploads/paginas/pregao/'.$arquivo->predoc_arquivo) ?>"><p><i class="fas fa-file-pdf"></i>&nbsp; <?=$arquivo->predoc_titulo?></p></a>
				<?php endforeach ?>
				<hr>
			</div>

		<?php endforeach ?>
	</div>


</section>
