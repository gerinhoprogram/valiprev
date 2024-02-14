<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="icon" type="image/png" href="<?php bloginfo('url'); ?>/favicon.ico" />
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MDKNXDP');</script>
<!-- End Google Tag Manager -->

</head>

<body <?php body_class(); ?>>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MDKNXDP"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
	
<div id="page">
	<header>
		<div class="container h-100">
			<div class="row justify-content-between align-items-center h-100">
				<div class="col-12 col-lg-6 col-xl-5 col-xxl-4 logo">
					<figure>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
							<img src="<?php bloginfo('template_url'); ?>/images/polienge-logo.png" alt="<?php bloginfo( 'name' ); ?>">
						</a>
					</figure>		
				</div>
				<div class="col-6 d-none d-lg-block text-end">
					<?php if( have_rows('telefones', 2) ): ?>
					    <ul>
					    	<li><i class="fa-solid fa-phone"></i></li>
					    <?php while( have_rows('telefones', 2) ): the_row(); ?>
					        <li>
					        	<a href="tel:<?php the_sub_field('link_telefone'); ?>">
						        	<?php the_sub_field('telefone'); ?>
						        </a>
				        	</li>
					    <?php endwhile; ?>
					    	<li><i class="fa-brands fa-whatsapp"></i></li>
					    	<li>
					    		<a href="https://api.whatsapp.com/send?phone=<?php the_field('link_whatsapp', 2); ?>" target="_blank">
						    		<?php the_field('whatsapp', 2); ?>
						    	</a>
					    	</li>
					    </ul>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</header>

	<div id="main">
