<?php $this->load->view('web/layout/navbar'); ?>

<section>

	<?php $this->load->view('web/layout/cabecalho_pagina'); ?>

	<div class="linha">
		<?php foreach($servidores as $serv) : ?>
			<div class="colunas lg-12">
				<h3><?= $serv->serv_nome ?></h3>
			</div>
			<?php foreach($pdfs as $pdf) : ?>
				<?php if($pdf->pdf_pagina_id == $serv->serv_id) :?>
					
						<div class='colunas lg-2'>
							<div class="cont_pai" style='height: 80px; margin-bottom: 25px'>
								<p class="cont_filha" style="font-size: 12pt; line-height: 12pt">
								<img src="<?=base_url('public/restrita/assets/img/pdf.svg')?>" alt="" width="50">
								</p>
							</div>
							
						</div>
						<div class='colunas lg-8'>
							<div class="cont_pai" style='height: 80px; margin-bottom: 25px'>
								<p class="cont_filha" style="font-size: 12pt; line-height: 12pt">
								<?= $pdf->pdf_titulo ?>
								</p>
							</div>
						</div>
						<div class='colunas lg-2'>
							<div class="cont_pai" style='height: 80px; margin-bottom: 25px'>
								<p class="cont_filha" style="font-size: 12pt; line-height: 12pt">
								<a href="<?=base_url('uploads/paginas/capacitacao-de-servidores/pdf/'.$pdf->pdf_arquivo)?>" target="_blank" rel="noopener noreferrer">Download</a>
								</p>
							</div>
						</div>
				<?php endif ?>
			<?php endforeach ?>
		<?php endforeach ?>
	</div>

</section>
