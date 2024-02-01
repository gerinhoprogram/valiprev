<header id="header-wrap">

	<nav>
		<ul>
			<?php foreach($menu_principal as $men) :?>
			
				<?php if($men->men_tem_submenu) :?>
					<li>

						<?= $men->men_nome ?>

						<ul>
								<?php foreach (submenu($men->men_id) as $sub) : ?>

									<?php if($sub->pag_submenu) :?>
										<li>
											<?= $sub->pag_nome ?>
											<ul>
												<?php foreach (submenu_2($sub->pag_id) as $pai) : ?>

													<?php if($pai->pag_submenu_2) :?>
														<li>
															<?= $pai->pag_nome ?>
															<ul>
																<?php foreach (submenu_3($pai->pag_id) as $pai_2) : ?>	
																	<li>
																		<a href="<?= base_url('/'.$men->men_url .'/'. $sub->pag_link.'/'.$pai->pag_link.'/'.$pai_2->pag_link) ?>">
																		<?= $pai_2->pag_nome ?>
																	</li>
																<?php endforeach ?>
															</ul>
														</li>
													<?php else :?>
														<li>
															<a href="<?= base_url('/'.$men->men_url .'/'. $sub->pag_link.'/'.$pai->pag_link) ?>">
															<?= $pai->pag_nome ?>0
															</a>
														</li>
													<?php endif ?>

												<?php endforeach ?>
											</ul>
										</li>
									<?php else :?>
										<li>
											<a href="<?= base_url('/'.$men->men_url .'/'. $sub->pag_link) ?>">
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
  
    
</header>
