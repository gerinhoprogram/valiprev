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

    <!-- ****** -->
    <!-- <meta name="description" content="<?= (isset($artigo) ? $artigo->artigo_titulo : $sistema->sistema_descricao) ?>" />
    <meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1" />
    <link rel="canonical" href="<?= (isset($artigo) ? base_url('detalhes/' . $artigo->artigo_url) : base_url()) ?>" />
    <meta property="og:locale" content="pt_BR" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="<?= (isset($artigo) ? $artigo->artigo_titulo : $sistema->sistema_descricao) ?>" />
    <meta property="og:description" content="<?= (isset($artigo) ? str_replace('" ', "' ", $artigo->artigo_descricao) : $sistema->sistema_descricao) ?>" />
    <meta property="og:url" content="<?= (isset($artigo) ? base_url('detalhes/' . $artigo->artigo_url) : base_url()) ?>" />
    <meta property="og:site_name" content="<?= $sistema->sistema_site_titulo ?>" />
    <meta property="article:author" content="<?= $sistema->sistema_site_titulo ?>" />
    <meta property="article:tag" content="sub-fixed" />
    <meta property="article:section" content="<?= (isset($artigo) ? $artigo->categoria_pai_nome : '') ?>" />
    <meta property="article:published_time" content="<?= (isset($artigo) ? $artigo->artigo_data_criacao : '') ?>" />
    <meta property="article:modified_time" content="<?= (isset($artigo) ? $artigo->artigo_data_alteracao : '') ?>" />
    <meta property="og:updated_time" content="<?= (isset($artigo) ? $artigo->artigo_data_alteracao : '') ?>" />
    <meta property="og:image" content="<?= (isset($artigo) ? base_url('uploads/artigos/' . $foto_principal->foto_nome) : '') ?>" />
    <meta property="og:image:secure_url" content="<?= (isset($artigo) ? base_url('uploads/artigos/' . $foto_principal->foto_nome) : '') ?>" />
    <meta property="og:image:width" content="900" />
    <meta property="og:image:height" content="600" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:description" content="<?= (isset($artigo) ? $artigo->artigo_titulo : $sistema->sistema_descricao) ?>" />
    <meta name="twitter:title" content="<?= (isset($artigo) ? $artigo->artigo_titulo : $sistema->sistema_descricao) ?>" />
    <meta name="twitter:image" content="<?= (isset($artigo) ? base_url('uploads/artigos/' . $foto_principal->foto_nome) : '') ?>" />
    <meta name="twitter:creator" content="<?= $sistema->sistema_site_titulo ?>" /> -->
    <!-- ******* -->

    <title>
        <?= (isset($artigo) ? $artigo->artigo_titulo : $sistema->sistema_site_titulo) ?>
    </title>

    <link rel="shortcut icon" href='<?= base_url('uploads/sistema/icone/') . $sistema->sistema_icon; ?>' />
	<link rel="stylesheet" href="<?= base_url('public/restrita/assets/css/estilo.css'); ?>">

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


</head>

<body>
<div class='acess'>
                <div class='bloco1'>
                    <a onclick="busca()"  accesskey="1" title='Ir Para o Mapa do Site' class='unico' style='cursor:pointer'> <i class="fas fa-arrow-circle-down"></i> Ir Para a Busca [1]</a>
                    <a href='#conteudo' accesskey="2" title='Ir Para Conteúdo' class='unico'> <i class="fas fa-arrow-circle-down"></i> Ir para o Conteúdo [2]</a>
                    <a href='#mapa' accesskey="3" title='Ir Para o Mapa do Site' class='unico'> <i class="fas fa-arrow-circle-down"></i> Ir Para o Mapa do Site [3]</a>
                </div>
                <div class="bloco2">
                    <a href='#' accesskey="4" onclick="modContrast(1)" title='Contraste Escuro'><i class="fas fa-moon" title="Contraste Escuro"></i> [4] </a> 
                    <a href='#' accesskey="5" onclick="modContrast(2)" title='Contraste Claro'><i class="fas fa-sun"  title="Contraste Claro"></i> [5]</a>
                    <a href='#' accesskey="6" onClick="fonte('a');" title='Aumentar Fonte'><i class="fas fa-search-plus"  title="Aumentar Fonte"></i> [6]</a>
                    <a href='#' accesskey="7" onClick="fonte('d');" title='Diminuir Fonte'><i class="fas fa-search-minus"  title="Diminuir Fonte"></i> [7]</a>
                    <a href='#' accesskey="8" onClick="fonte('n');" title='Restaurar Padrão de Fonte'><i class="fas fa-sync-alt"  title="Restaurar Padrão de Fonte"></i> [8]</a>
                    <a href='http://smarapd.daev.org.br:90/esic/#!/login' accesskey="9"  title='Sistema Eletrônico de Informação do DAEV' target="_blank" class='unico'><i class="fas fa-info-circle"></i> Acesso à Informação [9] </a>
                </div>
            </div>
   