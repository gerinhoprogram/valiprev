<?php $this->load->view('web/layout/navbar'); ?>

<section>

	<?php $this->load->view('web/layout/cabecalho_pagina'); ?>

	<div class="linha">
		<?php foreach($servidores as $serv) : ?>
			<div class="colunas lg-12">
				<h2><?= $serv->serv_nome ?></h2>
			</div>
			<?php foreach($pdfs as $pdf) : ?>
				<?php if($pdf->pdf_pagina_id == $serv->serv_id) :?>
					<div class='colunas lg-6'>
						<p><?= $pdf->pdf_titulo ?></p>
					</div>
				<?php endif ?>
			<?php endforeach ?>
		<?php endforeach ?>
	</div>

</section>
