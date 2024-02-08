<?php $this->load->view('web/layout/navbar'); ?>

<section>

	<?php $this->load->view('web/layout/cabecalho_pagina'); ?>

	<div class="linha">
		<?php foreach($pdfs as $pdf) : ?>
					<div class='colunas lg-6'>
						<p><?= $pdf->pdf_titulo ?></p>
					</div>
		<?php endforeach ?>
	</div>

</section>
