<?php $this->load->view('web/layout/navbar'); ?>

<style>
	.busca p{
		padding: 10px;
		border: 1px solid #ccc
	}
	
</style>

<section>

	<?php $this->load->view('web/layout/cabecalho_pagina'); ?>

	<div class="linha">

		<?php foreach ($paginas as $res) : ?>
			<div class="colunas lg-6 md-6 pq-12 busca" style="float: left">
				
					<?php if ($res->pag_pai) : ?>

						<?php $link = get_link($res->pag_pai) ?>
						<a href="<?= base_url($res->men_url . "/" . $link->pag_link  . "/" . $res->pag_link) ?>">
							<p><?= $link->pag_nome ?> / <?= $res->pag_nome ?></p>
						</a>

					<?php elseif ($res->pag_pai_2) : ?>

						<?php $link_2 = get_link($res->pag_pai_2) ?>
						<?php $link_1 = get_link($link_2->pag_pai) ?>
						<a href="<?= base_url($res->men_url . "/" . $link_1->pag_link . "/" . $link_2->pag_link  . "/" . $res->pag_link) ?>">
							<p><?= $link_1->pag_nome ?> / <?= $link_2->pag_nome ?> / <?= $res->pag_nome ?></p>
						</a>
					<?php else : ?>

						<a href="<?= base_url($res->men_url . "/" . $res->pag_link) ?>">
							<p><?= $res->pag_nome ?></p>
						</a>
					<?php endif ?>
				
			</div>
		<?php endforeach ?>

	</div>

</section>
