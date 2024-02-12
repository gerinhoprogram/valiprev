<footer>
	<div class="linhas">
		<div class="colunas lg-4">
			<h5>Fale conosco</h5>
			<p><?= $info_sistema->sistema_telefone_fixo ?></p>
			<p><?= $info_sistema->sistema_telefone_movel ?></p>
			<p>
			<p><?= $info_sistema->sistema_email ?></p>
			</p>
			<h5>Endereço</h5>
			<p><?= $info_sistema->sistema_endereco ?></p>
			<p><?= $info_sistema->sistema_bairro ?> | <?= $info_sistema->sistema_cep ?></p>
			<h5>Endereço</h5>
			<p><?= $info_sistema->sistema_horario_atendimento ?></p>
		</div>
		<div class="colunas lg-4">
			<?php foreach($menu_home as $men_rodape) : ?>
		</div>

	</div>

	<div class="linha">
		<div class="colunas lg-12">
			<div class="direitos-reservados">
				<p>© <?php echo date('Y'); ?> Todos os direitos reservados</p>
			</div>
		</div>

	</div>

</footer>


</body>


</html>


<script>
	const BASE_URL = '<?php echo base_url() ?>';
</script>


<?php if (isset($scripts)) : ?>

	<?php foreach ($scripts as $script) : ?>

		<script defer src="<?= base_url('public/restrita/' . $script); ?>"></script>

	<?php endforeach; ?>

<?php endif; ?>
