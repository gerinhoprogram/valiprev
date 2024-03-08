<?php $this->load->view('web/layout/navbar'); ?>
<?php $this->load->view('web/layout/banner'); ?>

<section class="portal-transparencia cont_pai">
	<div class="cont_filha">
		<div class="linha">
			<div class="colunas lg-6 md-6 pq-12">
				<a href="https://transparencia-valiprev.smarapd.com.br/#/" target="_blank" title="Portal da Transparência">
					<div class="transparencia">
						<h2>Portal da Transparência</h2>
					</div>
				</a>
			</div>
			<div class="colunas lg-6 md-6 pq-12">
				<a href="https://www.fourinfosistemas.com.br/servicosonlinefourprev/publico/portaldatransparencia.jsf?id=5883" target="_blank" title="Renumeração dos Servidores Valiprev">
					<div class="servidores">
						<h2>Protocolo digital (em breve)</h2>
					</div>
				</a>
			</div>
		</div>
	</div>
</section>

<section class="menu-inferior">
	<div class="linha">
		<?php foreach ($menu_home as $home) : ?>

			<div class="colunas lg-2 md-4 pq-12">
				
				<figure>
					<img src="<?= base_url('uploads/home/' . $home->hom_foto) ?>" alt="<?= $home->hom_titulo ?>" title="<?= $home->hom_titulo ?>">
				</figure>
				<?php if ($home->hom_link_externo) : ?>
					<a href="<?= $home->hom_link ?>" target="_blank" rel="noopener noreferrer" title='<?= $home->hom_titulo ?>'>
						<p><?= $home->hom_titulo ?></p>
					</a>
				<?php else : ?>
					<a title='<?= $home->hom_titulo ?>' href="<?= base_url($home->hom_link) ?>">
						<p><?= $home->hom_titulo ?></p>
					</a>
				<?php endif ?>
				+

			</div>

		<?php endforeach ?>
	</div>
</section>

<section class="valiprev">
	<div class="b_direito">
		<div class="linha">
			<div class="colunas lg-12 md-12 pq-12">
				<h3>Apresentação</h3>
				<?= html_entity_decode($info_sistema->sistema_descricao) ?>
			</div>
		</div>
	</div>
	<div class="b_esquerdo" style="background: url(<?= base_url('uploads/home/valiprev.png') ?>) center center no-repeat;  background-size: cover"></div>
</section>


<section class="links-uteis">
	<div class="linha">
		<div class="colunas lg-12">
			<h4>Links Úteis</h4>
		</div>
		<?php foreach ($links_uteis as $link) : ?>

			<div class="colunas lg-2 md-4 pq-6">
				<figure>
					<a href="<?=$link->link_link?>" target="_blank" rel="noopener noreferrer" title="<?= $link->link_nome ?>">
					<img src="<?= base_url('uploads/home/lins-uteis/' . $link->link_foto) ?>" alt="<?= $link->link_nome ?>" title="<?= $link->link_nome ?>">
					</a>
				</figure>
			</div>

		<?php endforeach ?>
	</div>
</section>
