<?php $this->load->view('web/layout/navbar'); ?>

<section class='paginas-diretoria'>

	<?php $this->load->view('web/layout/cabecalho_pagina'); ?>

	<div class="linha">
		
    <div class="table-responsive">
            <table class="table table-striped table-artigos">
                <thead>
                    <tr>
                        <th>Portarias</th>
                    </tr>
                </thead>
                <tbody>


                    <?php foreach ($pdfs as $pdf): ?>

                        <tr>
                            <td><?=$pdf->post_content?></td>
                            
                            
                        </tr>

                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
		
	</div>

</section>
