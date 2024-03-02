<?php $this->load->view('web/layout/navbar'); ?>

<style>
	form input, textarea, select, form button{
		width: 100%;
		padding: 10px;
		font-family: "Roboto", sans-serif;
		margin-bottom: 15px;

	}

	form{
		margin-bottom: 40px;
	}

	form button{
		background-color: #332663;
		color: #fff;
		border: 1px solid #332663;
		cursor: pointer;
		font-size: 20pt;
		width: 150px;
	}

	form button:hover{
		background-color: #fff;
		color: #332663;
	}

	iframe{
		margin-bottom: 40px;
	}
</style>

<section class='paginas-diretoria'>

	<?php $this->load->view('web/layout/cabecalho_pagina'); ?>

	<div class="linha">
		<div class="colunas lg-12">
			<h3>Ouvidoria Valiprev</h3>
			<p>
			Nós queremos ouvir você!<br>Preencha o formulário abaixo para dúvidas, críticas ou sugestões.
			</p>
			<form action="">
				<label for="nome">*Nome</label>
				<input type="text" name="nome" required>
				<label for="email">*E-mail</label>
				<input type="email" name="email" required>
				<label for="telefone">*Telefone</label>
				<input type="text" name="telefone" required>
				<label for="assunto">*Assunto</label>
				<select name="assunto" id="assunto">
					<option value="Dúvida">Dúvida</option>
					<option value="Reclamação">Reclamação</option>
					<option value="Sugestão">Sugestão</option>
					<option value="Solicitação">Solicitação</option>
				</select>
				<label for="mensagem">Mensagem</label>
				<textarea name="mensagem" id="mensagem"></textarea>
				<button type="submit"><strong>Enviar</strong></button>
			</form>
		</div>
	</div>

	

</section>
