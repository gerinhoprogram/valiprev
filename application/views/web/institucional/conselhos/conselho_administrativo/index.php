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
				<?php $this->load->view('web/institucional/conselhos/tabela_1'); ?>
			</div>

		</div>

		<div class="linha atas">
			<div class="colunas lg-12">
				<h4>Atas do Conselho Administrativo</h4>
			</div>
			<?php $this->load->view('web/institucional/conselhos/tabela_2'); ?>

		</div>


	<?php endif ?>

</section>

