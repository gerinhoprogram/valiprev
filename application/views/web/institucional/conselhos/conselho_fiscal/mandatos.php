<?php $this->load->view('web/layout/navbar'); ?>

<style>
	ul{
		margin-bottom: 40px;
	}
</style>

<section class='paginas-diretoria'>

	<?php $this->load->view('web/layout/cabecalho_pagina'); ?>

	<div class="linha">
		<?php foreach ($mandatos as $mandato) : ?>
			<div class="colunas lg-12">
				<h3><?= $mandato->man_titulo ?></h3>
				<p><?= $mandato->man_decreto ?></p>
				<p><?= $mandato->man_posse ?></p>

				<h5>Membros indicados livremente pelo Prefeito Municipal:</h5>

				<div class="colunas lg-6 md-6 pq-12">
					<p><strong>Titulares</strong></p>
					<ul style="padding: 10px 10px 10px 40px;">
						<?php foreach (membros_titulares_prefeito($mandato->man_id) as $membros) : ?>
							<li><?= $membros->membros_nome ?></li>
						<?php endforeach ?>
					</ul>
				</div>
				<div class="colunas lg-6 md-6 pq-12">
					<p><strong>Suplentes</strong></p>
					<ul style="padding: 10px 10px 10px 40px;">
						<?php foreach (membros_suplentes_prefeito($mandato->man_id) as $membros) : ?>
							<li><?= $membros->membros_nome ?></li>
						<?php endforeach ?>
					</ul>
				</div>

				<h5>Membros eleitos pelos servidores municipais efetivos ativos e inativos:</h5>

				<div class="colunas lg-6 md-6 pq-12">
					<p><strong>Titulares</strong></p>
					<ul style="padding: 10px 10px 10px 40px;">
						<?php foreach (membros_titulares_servidores($mandato->man_id) as $membros) : ?>
							<li><?= $membros->membros_nome ?></li>
						<?php endforeach ?>
					</ul>
				</div>
				<div class="colunas lg-6 md-6 pq-12">
					<p><strong>Suplentes</strong></p>
					<ul style="padding: 10px 10px 10px 40px;">
						<?php foreach (membros_suplentes_servidores($mandato->man_id) as $membros) : ?>
							<li><?= $membros->membros_nome ?></li>
						<?php endforeach ?>
					</ul>
				</div>
			</div>
			<div class="colunas lg-12"><hr></div>




		<?php endforeach ?>
	</div>


</section>
