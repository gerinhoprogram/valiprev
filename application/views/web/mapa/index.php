<?php $this->load->view('web/layout/navbar'); ?>

<style>
	.mapa .submenu, .mapa .submenu_2, .submenu_3{
		margin-left: 50px;
	}
	.mapa ul{
		list-style: none;
	}
	.mapa li{
		border-left: 1px solid #ccc;
		padding: 5px;
	}
</style>

<section class="mapa">

	<?php $this->load->view('web/layout/cabecalho_pagina'); ?>

		<div class="linha">

			<div class="colunas lg-12">

				<ul class="nivel_pai">
					<li>
						<a href="<?= base_url() ?>" title="Home">Home</a>
					</li>
					<?php foreach ($menu_principal as $men) : ?>

						<?php if ($men->men_tem_submenu) : ?>
							<li>

								<a href="<?= base_url($men->men_url) ?>"> <?= $men->men_nome ?></a>

								<ul class="nivel_2">

									<?php foreach (submenu($men->men_id) as $sub) : ?>

										<?php if ($sub->pag_submenu) : ?>
											<li class="submenu">
												<a href="<?= ($sub->pag_link_externo ? $sub->pag_link_externo : ($sub->pag_pdf ? base_url($sub->pag_link) : base_url($men->men_url . '/' . $sub->pag_link))) ?>"><?= $sub->pag_nome ?></a>
												<ul>
													<?php foreach (submenu_2($sub->pag_id) as $pai) : ?>

														<?php if ($pai->pag_submenu_2) : ?>
															<li class="submenu_2">
																<a href="<?= ($pai->pag_link_externo ? $pai->pag_link : base_url($men->men_url . '/' . $sub->pag_link . '/' . $pai->pag_link)) ?>"><?= $pai->pag_nome ?> </a>
																<ul>
																	<?php foreach (submenu_3($pai->pag_id) as $pai_2) : ?>
																		<li class="submenu_3">
																			<a href="<?= ($pai_2->pag_link_externo ? $pai_2->pag_link : base_url('/' . $men->men_url . '/' . $sub->pag_link . '/' . $pai->pag_link . '/' . $pai_2->pag_link)) ?>">
																				<?= $pai_2->pag_nome ?>
																			</a>
																		</li>
																	<?php endforeach ?>
																</ul>
															</li>
														<?php else : ?>
															<li class="submenu_2">
																<a href="<?= ($pai->pag_link_externo ? $pai->pag_link : ($pai->pag_pdf ? base_url($pai->pag_link) : base_url($men->men_url . '/' . $sub->pag_link . '/' . $pai->pag_link))) ?>">
																	<?= $pai->pag_nome ?>
																</a>
															</li>
														<?php endif ?>

													<?php endforeach ?>
												</ul>
											</li>
										<?php else : ?>
											<li class="submenu">
												<a href="<?= ($sub->pag_link_externo ? $sub->pag_link : ($sub->pag_pdf ? base_url($sub->pag_link) : base_url($men->men_url . '/' . $sub->pag_link))) ?>">
													<?= $sub->pag_nome ?>
												</a>
											</li>
										<?php endif ?>
									<?php endforeach ?>

								</ul>
							</li>

						<?php else : ?>

							<li>
								<a href="<?= base_url('/' . $men->men_url) ?>">
									<?= $men->men_nome ?>
								</a>
							</li>

						<?php endif ?>


					<?php endforeach ?>
					
				</ul>

			</div>
			
		</div>

</section>
