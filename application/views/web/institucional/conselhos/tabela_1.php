<div class='tabela'>
					<table class="table-web" style="width: 100%">
						<thead >
							<tr>
								<th style="text-align: left; border: 1px solid #ccc; padding: 5px; margin-top: 20px;">Título</th>
								<th style="text-align: left; border: 1px solid #ccc; padding: 5px; margin-top: 20px;">Baixar</th>
							</tr>
						</thead>
						<tbody>


							<?php foreach ($regimentos as $reg) : ?>

								<tr>
									<td style="width: 80%"><?= $reg->reg_nome; ?></td>

									<td>
										<a href="http://" target="_blank" rel="noopener noreferrer">
											Download
										</a>
									</td>
								</tr>

							<?php endforeach; ?>

						</tbody>
					</table>
				</div>
