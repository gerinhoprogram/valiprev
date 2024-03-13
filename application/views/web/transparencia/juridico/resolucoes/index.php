<?php $this->load->view('web/layout/navbar'); ?>

<section class='paginas-diretoria'>

	<?php $this->load->view('web/layout/cabecalho_pagina'); ?>

	<div class="linha">

			<?php if(isset($paginas)) :?>

					<?php foreach($paginas as $pag) :?>
						<div class="colunas lg-12">
						<a href="<?=base_url('transparencia/juridico/'.$menu->pag_link.'/'.$pag->pag_link)?>"><p><?=$pag->pag_nome?></p></a>
						</div>
					<?php endforeach ?>

			<?php else :?>
			
				<?php foreach($pdfs as $pdf) :?>
					<div class="colunas lg-12">
					<a href="<?= base_url("uploads/paginas/$pasta/pdf/").$pdf->pdf_arquivo?>" target="_blank" rel="noopener noreferrer"><p style="padding: 10px; border: 1px solid #ccc"><i class="fas fa-file-pdf"></i>&nbsp;<?=$pdf->pdf_titulo?></p></a>
					</div>
				<?php endforeach ?>

			<?php endif ?>
		
	</div>

</section>
