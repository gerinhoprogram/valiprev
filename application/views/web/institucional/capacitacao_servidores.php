<?php $this->load->view('web/layout/navbar'); ?>

<style>
	.capacitacao-servidores .cont_pai {
		height: 80px;
		margin-bottom: 25px
	}

	.capacitacao-servidores p {
		font-size: 12pt;
		line-height: 12pt
	}
</style>

<section>

	<?php $this->load->view('web/layout/cabecalho_pagina'); ?>

	<div class="linha capacitacao-servidores">
		<?php foreach ($servidores as $serv) : ?>
			<div class="colunas lg-12">
				<h3><?= $serv->serv_nome ?></h3>
			</div>
			<?php foreach ($pdfs as $pdf) : ?>
				<?php if ($pdf->pdf_pagina_id == $serv->serv_id) : ?>

					<div class='colunas lg-1'>
						<div class="cont_pai">
							<p class="cont_filha">
							<a href="<?= base_url('uploads/paginas/capacitacao-de-servidores/pdf/' . $pdf->pdf_arquivo) ?>" target="_blank" rel="noopener noreferrer">
								<img src="<?= base_url('public/restrita/assets/img/pdf.svg') ?>" alt="" width="50">
				</a>
							</p>
						</div>
					</div>

					<div class='colunas lg-11'>
						<div class="cont_pai">
							<p class="cont_filha">
								<?= $pdf->pdf_titulo ?>
							</p>
						</div>
					</div>

				<?php endif ?>
			<?php endforeach ?>
		<?php endforeach ?>
	</div>

</section>
