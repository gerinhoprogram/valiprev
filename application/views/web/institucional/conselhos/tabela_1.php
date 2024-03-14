


				<div class="tabela">
				<table class="table-web" style=" width: 100%">
					<thead >
						<tr>
							<th class="nosort">Título</th>
						</tr>
					</thead>
					<tbody>


						<?php foreach ($regimentos as $p) : ?>

							<tr>
								<td><a href="<?=base_url("uploads/paginas/conselhos/regimentos_internos/").$p->reg_foto?>" target="_blank" rel="noopener noreferrer">
									<i class="fas fa-file-pdf"></i>&nbsp;<?= $p->reg_nome; ?></a>
								</td>

								
							</tr>

						<?php endforeach; ?>

					</tbody>
				</table>
			</div>

