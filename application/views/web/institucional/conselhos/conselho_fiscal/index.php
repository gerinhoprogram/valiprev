<?php $this->load->view('web/layout/navbar'); ?>

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
				<h4>O Conselho Fiscal</h4>
				<p>
				O Conselho Fiscal é órgão fiscalizador dos atos de gestão do VALIPREV, para proteção dos interesses dessa entidade, criado pela Lei Nº 4877 de 11 de julho de 2013.
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
				<div class="colunas lg-4 md-2 pq-12" style='height: 500px'>
					<figure>
						<img src="<?= base_url('uploads/paginas/conselhos/conselheiros/' . $pag->con_foto) ?>" alt="">
					</figure>
					<p><?= $pag->con_nome ?></p>
					<p><?= $pag->con_categoria ?></p>
					<p><?= $pag->con_cargo ?></p>

				</div>
			<?php endforeach ?>

		</div>

		<div class="linha regimentos">
			<div class="colunas lg-12">
				<h4>Regimentos Internos do Conselho Administrativo</h4>
			</div>
			<div class="colunas lg-12">
				<div style="background: #ccc">
					<table class="table-web" style="background: #bbb; width: 100%">
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

									<td style="text-align: center; width: 20%">
										<a href="http://" target="_blank" rel="noopener noreferrer">
											baixar
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
				<div style="background: #ccc">
					<table class="table-web" style="background: #bbb; width: 100%">
						<thead>
							<tr>
								<th class="nosort">Título</th>
								<th class="nosort">Ano</th>
								<th class="nosort">Baixar</th>
							</tr>
						</thead>
						<tbody>


							<?php foreach ($atas as $ata) : ?>

								<tr>
									<td style="width: 60%"><?= $ata->ata_nome; ?></td>
									<td style="width: 20%"><?= $ata->ata_ano; ?></td>

									<td style="text-align: center; width: 20%">
										<a href="http://" target="_blank" rel="noopener noreferrer">
											baixar
										</a>
									</td>
								</tr>

							<?php endforeach; ?>

						</tbody>
					</table>
				</div>
			</div>

		</div>


	<?php endif ?>

</section>