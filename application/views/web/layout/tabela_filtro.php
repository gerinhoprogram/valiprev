<div class="tabela">
				<table class="table-web" style=" width: 100%">
					<thead>
						<tr>
							<th class="nosort">Título</th>
							<th class="nosort">Ano</th>
							<th class="nosort">Baixar</th>
						</tr>
					</thead>
					<tbody>


						<?php foreach ($pdf as $p) : ?>

							<tr>
								<td style="width: 60%"><?= $p->pdf_titulo; ?></td>
								<td style="width: 20%"><?= $p->pdf_ano; ?></td>

								<td style="text-align: center; width: 20%">
									<a href="http://" target="_blank" rel="noopener noreferrer">
										Download
									</a>
								</td>
							</tr>

						<?php endforeach; ?>

					</tbody>
				</table>
			</div>
