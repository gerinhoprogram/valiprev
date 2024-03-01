<header>

	<div class="wrapper">
		<div class="sidebar isOpen">

			<form class="search-form" method="post" action="<?=base_url('busca')?>">
				<div class="inputwithicon"> 
					<input type="text" id="busca" autofocus required name="busca" title="Digite para pesquisar" class="modal-busca form-control float-left" placeholder="Digite aqui o que deseja pesquisar..."> 
					<input type="submit" value="Buscar" class="form-control float-right btn-success btn-busca"> 
					<div id="#carregar"></div>
				</div>
			</form>

		</div>

		<div class="fechaMenu isClose"></div>
	</div>

	<?php $sistema = info_header_footer() ?>
	<div class="linha">
		<div class="colunas lg-4 md-4 pq-8">
			<figure>
				<img class="logo" src="<?= base_url('uploads/sistema/logo/' . $sistema->sistema_logo) ?>" title="<?= $sistema->sistema_site_titulo ?>" alt="<?= $sistema->sistema_site_titulo ?>">
			</figure>

		</div>
		<div class="colunas lg-8 md-8 pq-4">

			<nav class="nav">

				<ul class="nav__list nav_desk">
					<li>
						<a href="<?= base_url() ?>">Home</a>
					</li>
					<?php foreach ($menu_principal as $men) : ?>

						<?php if ($men->men_tem_submenu) : ?>
							<li>

								<a href="<?= base_url($men->men_url) ?>"> <?= $men->men_nome ?></a>

								<ul>

									<?php foreach (submenu($men->men_id) as $sub) : ?>

										<?php if ($sub->pag_submenu) : ?>
											<li class="submenu">
												<a href="<?= ($sub->pag_link_externo ? $sub->pag_link : base_url($men->men_url . '/' . $sub->pag_link)) ?>"><?= $sub->pag_nome ?> <i class="fas fa-chevron-right" style='float: right'></i></a>
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
																<a href="<?= ($pai->pag_link_externo ? $pai->pag_link : base_url($men->men_url . '/' . $sub->pag_link . '/' . $pai->pag_link)) ?>">
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
					<li>
						<div class="pesquisar button seta-abrir"><i class="fa fa-search"></i></div>

					</li>
				</ul>



				<i class="fas fa-bars btn-mob"></i>
				<ul class='nav_mob'>
					<?php foreach ($menu_principal as $men) : ?>

						<li>
							<a href="<?= base_url($men->men_url) ?>"><?= $men->men_nome ?></a>
						</li>

					<?php endforeach ?>

				</ul>



			</nav>

		</div>
	</div>


</header>
