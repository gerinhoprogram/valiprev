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
		<div class="colunas lg-6">
			<h3>Entre em contato com a Valiprev</h3>
			<p>Preencha o formulário abaixo e envie sua mensagem.
			</p>
			<form action="">
				<label for="nome">*Nome</label>
				<input type="text" name="nome" required>
				<label for="email">*E-mail</label>
				<input type="email" name="email" required>
				<label for="telefone">*Telefone</label>
				<input type="text" name="telefone" required>
				<label for="mensagem">Mensagem</label>
				<textarea name="mensagem" id="mensagem"></textarea>
				<button type="submit"><strong>Enviar</strong></button>
			</form>
		</div>
		<div class="colunas lg-6">
			<h3>Fale conosco</h3>
			<p><?= $info_sistema->sistema_telefone_fixo ?></p>
			<p><?= $info_sistema->sistema_telefone_movel ?></p>
			<p>
			<p><?= $info_sistema->sistema_email ?></p>
			</p>
			<h5>ENDEREÇO</h5>
			<p><?= $info_sistema->sistema_endereco ?></p>
			<p><?= $info_sistema->sistema_bairro ?> | <?= $info_sistema->sistema_cep ?></p>
			<h5>HORÁRIO DE ATENDIMENTO</h5>
			<p><?= $info_sistema->sistema_horario_atendimento ?></p>
		</div>
		<div class="colunas lg-12">
		<h3>Localização</h3>
		<iframe style="border: 0;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1836.5743991552022!2d-47.004483057944086!3d-22.981555181299793!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94c8cd9cbc1a6615%3A0x25b03d43b7c5182c!2sValiprev!5e0!3m2!1spt-BR!2sbr!4v1556849540824!5m2!1spt-BR!2sbr" width="100%" height="500" frameborder="0" allowfullscreen="allowfullscreen"></iframe>
		</div>
	</div>

	

</section>
