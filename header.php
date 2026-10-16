<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package roofcraft
 */

// Phone can be a link field or a plain number.
$pr_phone_number = get_field( 'pr_phone_number', 'option' );
$phone_url       = '';
$phone_title     = '';
if ( is_array( $pr_phone_number ) ) {
	$phone_url   = ! empty( $pr_phone_number['url'] ) ? $pr_phone_number['url'] : '';
	$phone_title = ! empty( $pr_phone_number['title'] ) ? $pr_phone_number['title'] : $phone_url;
} elseif ( ! empty( $pr_phone_number ) ) {
	$phone_title = (string) $pr_phone_number;
	$digits      = preg_replace( '/\D+/', '', $phone_title );
	$phone_url   = $digits ? 'tel:' . $digits : '';
}

$header_logo = get_field( 'header_logo', 'option' );
$header_logo = is_array( $header_logo ) ? $header_logo : array();
$site_name   = get_bloginfo( 'name' );
$header_button_text = get_field('header_button_text','option');

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<!-- Preload Fonts -->
	<link rel="preload" href="<?php echo get_template_directory_uri(); ?>/assets/fonts/PlusJakartaSans-ExtraBold.woff2" as="font" type="font/woff2" crossorigin>
	<link rel="preload" href="<?php echo get_template_directory_uri(); ?>/assets/fonts/PlusJakartaSans-ExtraLight.woff2" as="font" type="font/woff2" crossorigin>
	<link rel="preload" href="<?php echo get_template_directory_uri(); ?>/assets/fonts/PlusJakartaSans-Light.woff2" as="font" type="font/woff2" crossorigin>
	<link rel="preload" href="<?php echo get_template_directory_uri(); ?>/assets/fonts/PlusJakartaSans-Medium.woff2" as="font" type="font/woff2" crossorigin>
	<link rel="preload" href="<?php echo get_template_directory_uri(); ?>/assets/fonts/PlusJakartaSans-Regular.woff2" as="font" type="font/woff2" crossorigin>
	<link rel="preload" href="<?php echo get_template_directory_uri(); ?>/assets/fonts/PlusJakartaSans-SemiBold.woff2" as="font" type="font/woff2" crossorigin>
	<link rel="preload" href="<?php echo get_template_directory_uri(); ?>/assets/fonts/PlusJakartaSans-Bold.woff2" as="font" type="font/woff2" crossorigin>




	<?php wp_head(); ?>
	
	
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-NRWV48B');</script>
<!-- End Google Tag Manager -->	

</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NRWV48B"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->	
	
	
	
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'roofcraft'); ?></a>

		<header id="masthead" class="site-header">
			<div class="main-header">
				<div class="container">
					<div class="header-bar">
						<div class="row">
							<div class="col-lg-3">
								<div class="site-branding">
									<?php if ( ! empty( $header_logo['url'] ) ) : ?>
										<a class="custom-logo-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" title="<?php echo esc_attr( ! empty( $header_logo['alt'] ) ? $header_logo['alt'] : $site_name ); ?>">
											<img class="custom-logo" src="<?php echo esc_url( $header_logo['url'] ); ?>" alt="<?php echo esc_attr( ! empty( $header_logo['alt'] ) ? $header_logo['alt'] : $site_name ); ?>" title="<?php echo esc_attr( ! empty( $header_logo['alt'] ) ? $header_logo['alt'] : $site_name ); ?>" width="<?php echo esc_attr( ! empty( $header_logo['width'] ) ? $header_logo['width'] : '' ); ?>" height="<?php echo esc_attr( ! empty( $header_logo['height'] ) ? $header_logo['height'] : '' ); ?>">
										</a>
									<?php elseif ( has_custom_logo() ) : ?>
										<?php the_custom_logo(); ?>
									<?php else : ?>
										<a class="custom-logo-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" title="<?php echo esc_attr( $site_name ); ?>">
											<?php echo esc_html( $site_name ); ?>
										</a>
									<?php endif; ?>
								</div>
							</div>
							<div class="col-lg-9">
								<div class="header-menu">
									<nav id="site-navigation" class="main-navigation">
										<button class="menu-toggle" type="button" name="Hamburger Menu" aria-controls="primary-menu" aria-expanded="false" aria-label="<?php esc_attr_e('Open menu', 'roofcraft'); ?>">
											<span></span>
										</button>
										<div class="header-menu-box">
											<?php
                                            wp_nav_menu(
												array(
													'theme_location' => 'primary',
													'menu_id'        => 'primary-menu',
												)
											);
											?>
											<?php if ( $phone_url && $phone_title ) : ?>
												<div class="header-cta">
													<div class="header-phone">
														<span class="header-phone-icon" aria-hidden="true">
															<iconify-icon icon="fa7-solid:phone"></iconify-icon>
														</span>
														<a class="header-phone-number" href="<?php echo esc_url( $phone_url ); ?>" title="<?php echo esc_attr( $phone_title ); ?>"><?php echo esc_html( $phone_title ); ?></a>
													</div>
													<a class="sec-btn header-cta-btn" href="<?php echo esc_url( $phone_url ); ?>" title="<?php echo esc_attr($header_button_text); ?>"><?php echo $header_button_text ?></a>
												</div>
											<?php endif; ?>
										</div>
									</nav>
									<div class="header-mob-bg"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>
