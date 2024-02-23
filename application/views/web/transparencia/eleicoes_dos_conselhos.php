<?php $this->load->view('web/layout/navbar'); ?>
<style>
	h3{
		margin-top: 50px;
	}
	.eleicoes a div{
		padding: 20px;
		text-align: center;
		background-color: #3399ff;
		color: #fff;
		border-radius: 10px;
		margin-top: 30px;
		margin-bottom: 30px;
	}
	.eleicoes a div:hover{
		background-color: #332663;
	}
</style>

<section>

	<?php $this->load->view('web/layout/cabecalho_pagina'); ?>

	<div class="linha eleicoes">
		<div class="colunas lg-12">
			<p>
				<strong>COMUNICADO DE ANULAÇÃO DAS VOTAÇÕES PARA ELEIÇÃO DOS MEMBROS DOS CONSELHOS DE ADMINISTRAÇÃO E FISCAL DO VALIPREV (TRIÊNIO 2024/2026)</strong>
			</p>
			<p>
			O VALIPREV e a Comissão Eleitoral, designada por meio da Portaria nº 753/2023, com a finalidade de organizar e realizar as eleições de servidores efetivos para composição do Conselho de Administração e do Conselho Fiscal do VALIPREV – triênio 2024/2026, COMUNICAM que, quando do encerramento das votações, o responsável pela empresa contratada, devido a um erro operacional no momento de contabilizar os votos apurados, acabou por comprometer a integridade do processo eleitoral, devido a manipulação inadequada de comandos para a geração do resultado. Diante disso, decidiu-se pela ANULAÇÃO das votações ocorridas de 04/12/2023 a 08/12/2023, tendo em vista que o banco de dados não pode ser recuperado de forma íntegra e fidedigna, com convocação de novo período de votação, cujo calendário será oportunamente publicado.
			</p>
		</div>
		<div class="colunas lg-6 md-6 pq-12">
				<a href="https://online.fliphtml5.com/sfwqn/hgom/#p=1" target="_blank" rel="noopener noreferrer">
					<div>Clique e conheças os candidatos</div>
				</a>
		</div>
		<div class="colunas lg-6 md-6 pq-12">
		<a href="https://www.emvoto.com.br/" target="_blank" rel="noopener noreferrer">
		<div>Clique para votar (de 19 a 23/02/2024)</div>
				</a>
		</div>
	</div>
	<div class="linha">
		<div class="colunas lg-12">
			<h3>
			Faça download dos arquivos abaixo para mais detalhes:
			</h3>
			<?php foreach($resolucoes as $re) :?>
				<a href="http://" target="_blank" rel="noopener noreferrer">
				<i class="fas fa-file-pdf"></i>&nbsp;<?=$re->pdf_titulo?>
				</a>
			<?php endforeach ?>

			<h3>
			ATAS DA COMISSÃO ELEITORAL
			</h3>
			<?php foreach($atas as $ata) :?>
				<a href="http://" target="_blank" rel="noopener noreferrer">
				<i class="fas fa-file-pdf"></i>&nbsp;<?=$ata->pdf_titulo?>
				</a>
			<?php endforeach ?>
		</div>
	</div>


</section>
