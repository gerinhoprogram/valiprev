<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">

        <?php $sistema = info_header_footer(); 
        (isset($_SESSION['user_id']) ? $usuario = usuarios($_SESSION['user_id']) : '')
         ?>

        <title><?php echo $sistema->sistema_site_titulo ?> | Painel Administrador</title>

        <link rel="stylesheet" href="<?php echo base_url('public/restrita/assets/css/app.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('public/restrita/assets/css/style.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('public/restrita/assets/css/components.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('public/restrita/assets/css/custom.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('public/restrita/assets/bundles/izitoast/css/iziToast.min.css'); ?>">
        <link rel='shortcut icon' type='image/x-icon' href='<?php echo base_url('uploads/sistema/icone/'.$sistema->sistema_icon); ?>' />
        <link rel="stylesheet" href="<?php echo base_url('public/restrita/assets/bundles/chocolat/dist/css/chocolat.css'); ?>">

        <?php if (isset($styles)): ?>

            <?php foreach ($styles as $estilo): ?>

                <link rel="stylesheet" href="<?php echo base_url('public/restrita/' . $estilo); ?>">

            <?php endforeach; ?>

        <?php endif; ?>

        <style>

            .select2-container--default .select2-selection--single {

                border: 1px solid #e4e6fc !important;

            }

        </style>


    </head>

    <body class="<?=(isset($usuario) ? ($usuario->email_ativacao == 1 ? 'light light-sidebar theme-white' : 'dark dark-sidebar theme-black') : '')?>">
        <div class="loader"></div>
        <div id="loading" style="z-index: 99999"></div>
        <div id="app">
        