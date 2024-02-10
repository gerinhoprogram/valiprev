<header>
<?php $sistema = info_header_footer() ?>
	<div class="linha">
		<div class="colunas lg-4">
			<figure>
				<img class="logo" src="<?= base_url('uploads/sistema/logo/'.$sistema->sistema_logo) ?>" title="<?=$sistema->sistema_site_titulo?>" alt="<?=$sistema->sistema_site_titulo?>">
			</figure>
			
		</div>
		<div class="colunas lg-8">

			<nav class="nav">
				<ul class="nav__list">
					<li>
						<a href="<?= base_url()?>">Home</a>
					</li>
					<?php foreach ($menu_principal as $men) : ?>

						<?php if ($men->men_tem_submenu) : ?>
							<li>

								<a href="<?= base_url($men->men_url)?>"> <?= $men->men_nome ?></a>

								<ul>

									<?php foreach (submenu($men->men_id) as $sub) : ?>

										<?php if ($sub->pag_submenu) : ?>
											<li class="submenu">
												<a href="<?= base_url($men->men_url.'/'.$sub->pag_link)?>"><?= $sub->pag_nome ?></a>
												<ul>
													<?php foreach (submenu_2($sub->pag_id) as $pai) : ?>

														<?php if ($pai->pag_submenu_2) : ?>
															<li>
																<a href="<?= base_url($men->men_url.'/'.$sub->pag_link.'/'.$pai->pag_link)?>"><?= $pai->pag_nome ?></a>
																<ul>
																	<?php foreach (submenu_3($pai->pag_id) as $pai_2) : ?>
																		<li>
																			<a href="<?= base_url('/' . $men->men_url . '/' . $sub->pag_link . '/' . $pai->pag_link . '/' . $pai_2->pag_link) ?>">
																				<?= $pai_2->pag_nome ?>
																			</a>
																		</li>
																	<?php endforeach ?>
																</ul>
															</li>
														<?php else : ?>
															<li>
																<a href="<?= base_url('/' . $men->men_url . '/' . $sub->pag_link . '/' . $pai->pag_link) ?>">
																	<?= $pai->pag_nome ?>
																</a>
															</li>
														<?php endif ?>

													<?php endforeach ?>
												</ul>
											</li>
										<?php else : ?>
											<li class="submenu">
												<a href="<?= base_url('/' . $men->men_url . '/' . $sub->pag_link) ?>">
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
			</nav>

		</div>
	</div>


</header>
