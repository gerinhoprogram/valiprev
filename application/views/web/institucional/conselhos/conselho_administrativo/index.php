<?php $this->load->view('web/layout/navbar'); ?>

<style>
	.conselheiros .conselho {
		margin-bottom: 20px;
	}

	.conselheiros p {
		text-align: center;
		font-size: 14pt;
		line-height: 16pt;
	}

	table img {
		width: 30px !important;
	}

	
</style>

<section class='paginas-diretoria'>

	<?php $this->load->view('web/layout/cabecalho_pagina'); ?>

	<?php if (isset($paginas)) : ?>

		<div class="linha">

			<div class="colunas lg-12">
				<?php foreach ($paginas as $pag) : ?>
					<a href="<?= ($pag->pag_link_externo ? $pag->pag_link : base_url('institucional/conselhos/' . $menu->pag_link . '/' . $pag->pag_link)) ?>">
						<p><?= $pag->pag_nome ?></p>
					</a>
				<?php endforeach ?>
			</div>
		</div>

	<?php else : ?>

		<div class="linha">
			<div class="colunas lg-12">
				<h4>O Conselho Administrativo</h4>
				<p>
					O Conselho de Administração tem sua regulamentação prevista na Lei Nº 4877 de 11 de julho de 2013, que reorganiza e unifica o Regime Próprio de Previdência Social dos Servidores Municipais de Valinhos e dá outras providências.
				</p>
				<p>
					Decreto nº 10.672 de 04 de janeiro de 2021
				</p>
				<p>
					Triênio: 2021/2023
				</p>
			</div>
		</div>

		<div class="linha conselheiros">
			<div class="colunas lg-12">
				<h4>Conselheiros</h4>
			</div>

			<?php foreach ($pagina as $pag) : ?>
				<div class="colunas lg-4 md-4 pq-12 conselho">
					<figure>
						<img src="<?= base_url('uploads/paginas/conselhos/conselheiros/' . $pag->con_foto) ?>" alt="<?= $pag->con_nome ?>" title='<?= $pag->con_nome ?>'>
					</figure>
					<p><strong><?= $pag->con_nome ?></strong></p>
					<p>Por: <?= $pag->con_categoria ?></p>
					<p><?= $pag->con_cargo ?></p>

				</div>
			<?php endforeach ?>

		</div>

		<div class="linha regimentos">
			<div class="colunas lg-12">
				<h4>Regimentos Internos do Conselho Administrativo</h4>
			</div>
			<div class="colunas lg-12">
				<div class='tabela'>
					<table class="table-web" style="width: 100%">
						<thead>
							<tr>
								<th class="nosort">Título</th>
								<th class="nosort">Baixar</th>
							</tr>
						</thead>
						<tbody>


							<?php foreach ($regimentos as $reg) : ?>

								<tr>
									<td style="width: 80%"><?= $reg->reg_nome; ?></td>

									<td>
										<a href="http://" target="_blank" rel="noopener noreferrer">
											Download
										</a>
									</td>
								</tr>

							<?php endforeach; ?>

						</tbody>
					</table>
				</div>
			</div>

		</div>

		<div class="linha atas">
			<div class="colunas lg-12">
				<h4>Atas do Conselho Administrativo</h4>
			</div>
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
								<div class="colunas lg-6">
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

		</div>


	<?php endif ?>

</section>



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
