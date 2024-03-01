<footer>
	<div class="linha">
		<div class="colunas lg-4 md-4 pq-12">
			<h5>FALE CONOSCO</h5>
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
		<div class="colunas lg-4 md-4 pq-12">
			<h5>Mapa do site</h5>
			<a href="<?= base_url() ?>">
				<p>Home</p>
			</a>
			<a href="<?= base_url($menu_principal[0]->men_url) ?>">
				<p><?= $menu_principal[0]->men_nome ?></p>
			</a>
			<?php foreach (submenu($menu_principal[0]->men_id) as $sub) : ?>
				<a href="<?= base_url($menu_principal[0]->men_url . '/' . $sub->pag_link) ?>">
					<p>&bull; <?= $sub->pag_nome ?></p>
				</a>
			<?php endforeach ?>
		</div>
		<div class="colunas lg-4 md-4 pq-12">
			<a href="<?= base_url($menu_principal[1]->men_url) ?>">
				<p><?= $menu_principal[1]->men_nome ?></p>
			</a>
			<?php foreach (submenu($menu_principal[1]->men_id) as $sub) : ?>
				<a href="<?= base_url($menu_principal[1]->men_url . '/' . $sub->pag_link) ?>">
					<p>&bull; <?= $sub->pag_nome ?></p>
				</a>
			<?php endforeach ?>
			<a href="<?= base_url($menu_principal[2]->men_url) ?>">
				<p><?= $menu_principal[2]->men_nome ?></p>
			</a>
			<a href="<?= base_url($menu_principal[3]->men_url) ?>">
				<p><?= $menu_principal[3]->men_nome ?></p>
			</a>
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

<script src="<?=base_url('public/web/assets/js/jquery-min.js')?>"></script>
<script src="<?=base_url('public/web/assets/autocomplete/jquery-ui.min.js')?>"></script>
<script src="<?=base_url('public/web/assets/autocomplete/pesquisa-ajax.js')?>"></script>


<script>
	document.querySelector('.button').addEventListener('click', () => {
		document.querySelector('.sidebar').classList.toggle('isOpen');
		document.querySelector('.fechaMenu').classList.toggle('isClose');
	});

	document.querySelector('.fechaMenu').addEventListener('click', () => {
		document.querySelector('.sidebar').classList.toggle('isOpen');
		document.querySelector('.fechaMenu').classList.toggle('isClose');
	});
</script>
