
<?php if(isset($ano)) :?>
<div class="tab">
	<?php foreach ($pdf_grupo as $grupo) : ?>
		<button class="tablinks" onclick="openCity(event, '<?= $grupo->pdf_ano ?>')"><?= $grupo->pdf_ano ?></button>

	<?php endforeach; ?>
</div>

<?php $cont = 0 ?>
<?php foreach ($pdf_grupo as $pdf_grupo) : ?>

	<div id="<?= $pdf_grupo->pdf_ano ?>" class="tabcontent <?= ($cont != 0 ? 'tabinative' : '') ?>">
		<div class="linha">
			<?php foreach ($pdfs as $pdf) : ?>
				<div class="colunas lg-6" style='float: left'>
					<?php if ($pdf->pdf_ano == $pdf_grupo->pdf_ano) : ?>
						<a href="<?= base_url("uploads/paginas/$pasta/$subpasta/" . $pdf->pdf_arquivo) ?>" target="_blank" rel="noopener noreferrer">
							<p>
								<i class="fas fa-file-pdf"></i>&nbsp;<?= $pdf->pdf_titulo ?>
							</p>
						</a>
					<?php endif ?>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
	<?php $cont++ ?>
<?php endforeach; ?>


<?php else : ?>

	<div class="linha">
			<?php foreach ($pdfs as $pdf) : ?>
				<div class="colunas lg-6" style='float: left'>
					
						<a href="<?= base_url("uploads/paginas/$pasta/$subpasta/" . $pdf->pdf_arquivo) ?>" target="_blank" rel="noopener noreferrer">
							<p>
								<i class="fas fa-file-pdf"></i>&nbsp;<?= $pdf->pdf_titulo ?>
							</p>
						</a>
				</div>
			<?php endforeach; ?>
		</div>

<?php endif ?>



<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>
