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
	<link rel="stylesheet" href="<?= base_url('public/restrita/assets/css/estilo.css'); ?>">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

	<?php if (isset($styles)) : ?>

		<?php foreach ($styles as $estilo) : ?>

			<link rel="stylesheet" href="<?= base_url('public/restrita/' . $estilo); ?>">

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
		
	</style>


</head>

<body style="background: <?=$_SESSION['body']?>; color: <?=$_SESSION['font_color']?>">
	<div class="acessibilidade">
		<div class='linha'>
			<div class='colunas lg-12'>
				<a title='Ir Para o Mapa do Site' href="<?= base_url('mapa') ?>"> <i class="fas fa-arrow-circle-down"></i> Ir Para o Mapa do site [1]</a>
				<a title="Portal da transparência" target="_blank" href="https://transparencia-valiprev.smarapd.com.br/#/"> <i class="fas fa-arrow-circle-down"></i> Portal da Transparência [2]</a>
				<a href='https://www.fourinfosistemas.com.br/servicosonlinefourprev/publico/portaldatransparencia.jsf?id=5883' title='Renumeração dos Servidores Valiprev'> <i class="fas fa-arrow-circle-down"></i> Renumeração dos Servidores Valiprev [3]</a>
				|
				<a href='#' class="escuro" title='Contraste Escuro'><i class="fas fa-moon" title="Contraste Escuro"></i> [4] </a>
				<a href='#' class="claro" title='Contraste Claro'><i class="fas fa-sun" title="Contraste Claro"></i> [5]</a>
				<a href='#' accesskey="6" onClick="fonte('a');" title='Aumentar Fonte'><i class="fas fa-search-plus" title="Aumentar Fonte"></i> [6]</a>
				<a href='#' accesskey="7" onClick="fonte('d');" title='Diminuir Fonte'><i class="fas fa-search-minus" title="Diminuir Fonte"></i> [7]</a>
				<a href='#' accesskey="8" onClick="fonte('n');" title='Restaurar Padrão de Fonte'><i class="fas fa-sync-alt" title="Restaurar Padrão de Fonte"></i> [8]</a>
				<a href='http://smarapd.daev.org.br:90/esic/#!/login' accesskey="9" title='Sistema Eletrônico de Informação do DAEV' target="_blank" class='unico'><i class="fas fa-info-circle"></i> Acesso à Informação [9] </a>
			</div>
		</div>
	</div>
	<!-- 
<script async src="https://cse.google.com/cse.js?cx=a7e2a6246065b4a33">
</script>
<div class="gcse-search"></div> -->
