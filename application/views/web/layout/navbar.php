<header>
	<div class="wrapper">
		<div class="sidebar isOpen">
			<form class="search-form" method="post" action="<?= base_url('busca') ?>">
				<div class="inputwithicon">
					<div class="row">
						<div class="colunas lg-9 md-9 pq-9">
							<label for="busca">Digite para pesquisar</label>
							<input type="text" id="busca" autofocus required name="busca" title="Digite para pesquisar" placeholder="Digite aqui o que deseja pesquisar...">

						</div>
						<div class="colunas lg-3 md-3 pq-3">
							<label for="enviar">&nbsp;</label>
							<button type="submit" id="enviar" class="btn-busca"><i class="fa fa-search"></i></button>
						</div>
					</div>

					<div id="#carregar"></div>
				</div>
			</form>
		</div>

		<div class="fechaMenu isClose"></div>
	</div>

	<?php $sistema = info_header_footer() ?>
	<div class="linha">
		<div class="colunas lg-4 md-4 pq-12">
			<figure>
				<a href="<?= base_url() ?>" title="<?= $sistema->sistema_site_titulo ?>">
					<img class="logo" src="<?= base_url('uploads/sistema/logo/' . $sistema->sistema_logo) ?>" title="<?= $sistema->sistema_site_titulo ?>" alt="<?= $sistema->sistema_site_titulo ?>">
				</a>
			</figure>

		</div>
		<div class="colunas lg-8 md-8 pq-12">

			<nav class="nav">

				<ul class="nav__list nav_desk">
					<li class="top_menu" style="margin: 0 15px 0 15px;">
						<a href="<?= base_url() ?>" title="Home">Home</a>
					</li>
					<?php foreach ($menu_principal as $men) : ?>

						<?php if ($men->men_tem_submenu) : ?>
							<li class="top_menu" style="margin: 0 15px 0 15px;">

								<a href="<?= base_url($men->men_url) ?>"> <?= $men->men_nome ?></a>

								<ul>

									<?php foreach (submenu($men->men_id) as $sub) : ?>

										<?php if ($sub->pag_submenu) : ?>
											<li class="submenu">
												<a href="<?= ($sub->pag_link_externo ? $sub->pag_link_externo : ($sub->pag_pdf ? base_url($sub->pag_link) : base_url($men->men_url . '/' . $sub->pag_link))) ?>"><?= $sub->pag_nome ?> <i class="fas fa-chevron-right" style='float: right'></i></a>
												<ul>
													<?php foreach (submenu_2($sub->pag_id) as $pai) : ?>

														<?php if ($pai->pag_submenu_2) : ?>
															<li>
																<a href="<?= ($pai->pag_link_externo ? $pai->pag_link : base_url($men->men_url . '/' . $sub->pag_link . '/' . $pai->pag_link)) ?>"><?= $pai->pag_nome ?> <i class="fas fa-chevron-right" style='float: right'></i></a>
																<ul>
																	<?php foreach (submenu_3($pai->pag_id) as $pai_2) : ?>
																		<li>
																			<a href="<?= ($pai_2->pag_link_externo ? $pai_2->pag_link : base_url('/' . $men->men_url . '/' . $sub->pag_link . '/' . $pai->pag_link . '/' . $pai_2->pag_link)) ?>">
																				<?= $pai_2->pag_nome ?>
																			</a>
																		</li>
																	<?php endforeach ?>
																</ul>
															</li>
														<?php else : ?>
															<li>
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

							<li class="top_menu" style="margin: 0 15px 0 15px;">
								<a href="<?= base_url('/' . $men->men_url) ?>">
									<?= $men->men_nome ?>
								</a>
							</li>

						<?php endif ?>


					<?php endforeach ?>
					<li class="top_menu" style="margin: 0 15px 0 15px;"> 
						<div class="pesquisar button seta-abrir">&nbsp;<i class="fa fa-search" style="transform: scaleX(-1); color: #26b0e6"></i>&nbsp;</div>
					</li>
				</ul>

				<i class="fas fa-bars btn-mob" style="font-size: 25pt; float: left"></i>
				<i class="fa fa-search button_mob" style="font-size: 25pt; float: right"></i>

			</nav>

		</div>
	</div>

	<div class="wrapper">
		<div class="sidebar_mob isOpen_mob nav_mob">
			<ul>
				<li><i class="fas fa-times fechaMenu_mob_2"></i></li>
				<a href="<?=base_url()?>"><li>Home</li></a>
				<?php foreach ($menu_principal as $men) : ?>

					<a href="<?= base_url($men->men_url) ?>">
					<li>
						<?= $men->men_nome ?>
					</li>
					</a>

				<?php endforeach ?>

			</ul>
		</div>
		<div class="fechaMenu_mob isClose_mob"></div>
	</div>


</header>
