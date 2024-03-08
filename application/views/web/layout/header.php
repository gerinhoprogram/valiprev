<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br">

<?php $sistema = info_header_footer() ?>

<head>

	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5.0">
	<meta charset="utf-8">
	<meta property="" content="" />
	<meta name="copyright" content="MogiComp Soluções Web">
	<meta name="revisit-after" content="1 day">
	<meta name="keywords" content="<?= $sistema->sistema_palavras_seo ?>">

	<title>
		<?= (isset($artigo) ? $artigo->artigo_titulo : $sistema->sistema_site_titulo) ?>
	</title>

	<link rel="shortcut icon" href='<?= base_url('uploads/sistema/icone/') . $sistema->sistema_icon; ?>' />
	<link rel="stylesheet" href="<?= base_url('public/web/assets/css/estilo.css'); ?>">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

	<?php if (isset($styles)) : ?>

		<?php foreach ($styles as $estilo) : ?>

			<link rel="stylesheet" href="<?= base_url('public/web/' . $estilo); ?>">

		<?php endforeach; ?>

	<?php endif; ?>

	<div vw class="enabled">
		<div vw-access-button class="active"></div>
		<div vw-plugin-wrapper>
			<div class="vw-plugin-top-wrapper"></div>
		</div>
	</div>
	<script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
	<script>
		new window.VLibras.Widget('https://vlibras.gov.br/app');
	</script>
	<script src="https://kit.fontawesome.com/650f618ca2.js" crossorigin="anonymous"></script>
	<!-- https://fontawesome.com/v5/search?q=bar&o=r -->

	<style>

		a{
			text-decoration: none;
			color: <?=$_SESSION['font_color']?>
		}

		.b_direito{
			background-color: <?=$_SESSION['b_direito']?>;
		}

		.acessibilidade {
			background-color: <?=$_SESSION['b_direito']?>;
		}
		body{
			<?=$_SESSION['preto_e_branco']?>;
			
		}
		.inputwithicon label {
			text-align: left !important;
			font-size: 18pt;
			color: #fff;
			font-weight: bold;
			margin-bottom: 10px;
		}

		.inputwithicon input {
			border: #fff;
		}

		.inputwithicon #enviar {
			background-color: #332663;
			border: #332663 1px solid;
			cursor: pointer;
			color: #fff;
		}

		.sidebar_mob {
			position: absolute;
			width: 300px;
			padding: 10px;
			background: #26b0e6;
			height: 100vh;
			z-index: 9999999999999999999999999999999
		}

		.sidebar_mob li{
			padding: 5px;
			border-bottom: 1px solid #fff;
			color: #fff;
		}

		.sidebar_mob.isOpen_mob {
			transform: translateX(-300px)
		}

		.fechaMenu_mob {
			width: 100%;
			height: 100%;
			background-color: rgba(0, 0, 0, .7);
			position: fixed;
			top: 0;
			left: 0;
			z-index: 1
		}

		.fechaMenu_mob_2{
			float: right
		}

		.isClose_mob {
			display: none
		}
		.top_menu{
			border: 1px solid black !important"
		}
		
	</style>


</head>

<body style="background: <?=(isset($_SESSION['body']) ? $_SESSION['body'] : '')?>; color: <?=(isset($_SESSION['font_color']) ? $_SESSION['font_color'] : '')?>">
	<div class="acessibilidade">
		<div class='linha'>
			<div class='colunas lg-12'>
				<a title='Ir Para o Mapa do Site' href="<?= base_url('mapa') ?>"> <i class="fas fa-arrow-circle-down"></i> Ir Para o Mapa do site [1]</a>
				<a title="Portal da transparência" target="_blank" href="https://transparencia-valiprev.smarapd.com.br/#/"> <i class="fas fa-arrow-circle-down"></i> Portal da Transparência [2]</a>
				|
				<a href='javascript:;' class="escuro" title='Contraste Escuro'><i class="fas fa-moon" title="Contraste Escuro"></i> [3] </a>
				<a href='javascript:;' class="claro" title='Contraste Claro'><i class="fas fa-sun" title="Contraste Claro"></i> [4]</a>
				<a href='javascript:;' class="preto_e_branco" title='Preto e branco'>Preto e branco [5]</a>
				<a href='javascript:;' accesskey="6" onClick="fonte('a');" title='Aumentar Fonte'><i class="fas fa-search-plus" title="Aumentar Fonte"></i> [6]</a>
				<a href='javascript:;' accesskey="7" onClick="fonte('d');" title='Diminuir Fonte'><i class="fas fa-search-minus" title="Diminuir Fonte"></i> [7]</a>
				<a href='javascript:;' accesskey="8" onClick="fonte('n');" title='Restaurar Padrão de Fonte'><i class="fas fa-sync-alt" title="Restaurar Padrão de Fonte"></i> [8]</a>
			</div>
		</div>
	</div>
	<!-- 
<script async src="https://cse.google.com/cse.js?cx=a7e2a6246065b4a33">
</script>
<div class="gcse-search"></div> -->
