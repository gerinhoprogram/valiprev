<?php $this->load->view('web/layout/navbar'); ?>

<style>
	img{
		width: 100%;
		height: 400px;
		object-fit: contain;
	}

	.accordion {
  background-color: #26b0e6;
  color: #fff;
  cursor: pointer;
  padding: 18px;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 15px;
  transition: 0.4s;
  margin-top: 10px;
}

.active, .accordion:hover {
  background-color: #332663; 
}

.panel {
  padding: 10px 18px;
  display: none;
  background-color: white;
  overflow: hidden;
}
</style>

<section>

	<?php $this->load->view('web/layout/cabecalho_pagina'); ?>

	<div class="linha" style="margin-bottom: 40px">
		
		<div class="colunas lg-12">
			<h2><?= $pagina->cont_titulo ?></h2>
			<?php foreach ($faq as $f) : ?>

				<button class="accordion"><?= $f->cep_titulo ?></button>
				<div class="panel">
				<p><?= $f->cep_texto ?></p>
				</div>

			<?php endforeach ?>
		</div>
		
	</div>
	
	<div class="linha">
		<div class="colunas lg-5">
			<img src="<?= base_url('uploads/paginas/censo_previdenciario/') . $pagina->cont_foto ?>" alt="">
		</div>
		<div class="colunas lg-7">
			<h3><?=$pagina->cont_subtitulo?></h3>
			<?php foreach($pdfs as $pdf) :?>
				<a href="<?=base_url('uploads/paginas/cenco_previdenciario/'.$pdf->pdf_arquivo)?>" target="_blank" rel="noopener noreferrer"><p><i class="fas fa-file-pdf"></i>&nbsp;<?=$pdf->pdf_titulo?></p></a>
			
			<?php endforeach ?>
		</div>
		
	</div>

</section>


<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
  });
}
</script>
