<div class="colunas lg-12">

					
					<div class="tab">
						<?php foreach ($atas_grupo as $grupo) : ?>
							<button class="tablinks" onclick="openCity(event, '<?= $grupo->ata_ano ?>')" ><?= $grupo->ata_ano ?></button>
							
						<?php endforeach; ?>
					</div>

					<?php $cont = 0 ?>
					<?php foreach ($atas_grupo as $ata_grupo) : ?>

						<div id="<?= $ata_grupo->ata_ano ?>" class="tabcontent <?=($cont != 0 ? 'tabinative' : '')?>">
							<div class="linha">
							<?php foreach ($atas as $ata) : ?>
								<div class="colunas lg-6" style='float: left'>
								<?php if($ata->ata_ano == $ata_grupo->ata_ano) :?>
								<a href="<?= base_url('uploads/paginas/conselhos/atas/'.$ata->ata_foto) ?>" target="_blank" rel="noopener noreferrer">
									<p>
									<i class="fas fa-file-pdf"></i>&nbsp;<?= $ata->ata_nome ?>
									</p>
								</a>
								<?php endif ?>
								</div>
							<?php endforeach; ?>
							</div>
						</div>
						<?php $cont++ ?>
					<?php endforeach; ?>

			</div>

			

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

