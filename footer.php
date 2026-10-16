<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package roofcraft
 */

// Phone, email, and address from the options page.
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

$email_id   = get_field( 'email_id', 'option' );
$email_url  = '';
$email_text = '';
if ( is_array( $email_id ) ) {
	$email_url  = ! empty( $email_id['url'] ) ? $email_id['url'] : '';
	$email_text = ! empty( $email_id['title'] ) ? $email_id['title'] : $email_url;
} elseif ( ! empty( $email_id ) ) {
	$email_text = (string) $email_id;
	$email_url  = 'mailto:' . sanitize_email( $email_text );
}

$address_text       = get_field( 'address_text', 'option' );
$address_url        = get_field( 'address_url', 'option' );
$footer_options     = get_field( 'footer_options', 'option' );
$header_logo        = get_field( 'header_logo', 'option' );
$header_logo        = is_array( $header_logo ) ? $header_logo : array();
$footer_logo        = get_field( 'footer_logo', 'option' );
$footer_logo        = is_array( $footer_logo ) ? $footer_logo : array();
$brand_logo         = ! empty( $footer_logo['url'] ) ? $footer_logo : $header_logo;
$site_name          = get_bloginfo( 'name' );
$marketing          = get_field( 'marketing', 'option' );
$footer_description = get_field( 'footer_description', 'option' );


// Bottom CTA. Link type chooses a custom URL or a page.
$cta_page_id      = get_queried_object_id();
$cta_title        = get_field( 'cta_title', $cta_page_id );
$cta_content      = get_field( 'cta_content', $cta_page_id );
$cta_button_title = get_field( 'cta_button_title', $cta_page_id );
$cta_link_type    = (int) get_field( 'cta_link_type', $cta_page_id );
$cta_page_link    = get_field( 'cta_page_link', $cta_page_id );
$cta_link         = get_field( 'cta_link', $cta_page_id );
$cta_link         = is_array( $cta_link ) ? $cta_link : array();
$cta_page_link    = is_array( $cta_page_link ) ? reset( $cta_page_link ) : $cta_page_link;

if ( $cta_link_type ) {
	$cta_btn_url    = ! empty( $cta_link['url'] ) ? $cta_link['url'] : $phone_url;
	$cta_btn_target = ( ! empty( $cta_link['url'] ) && ! empty( $cta_link['target'] ) ) ? $cta_link['target'] : '';
} else {
	$cta_btn_url    = $cta_page_link;
	$cta_btn_target = '';
}

$has_cta_btn = ! empty( $cta_button_title ) && ! empty( $cta_btn_url );
$has_cta     = ( $cta_title || $cta_content || $has_cta_btn );

?>

<?php if ( $has_cta ) : ?>
<!-- CTA Start -->
<section class="cta white-text">
	<div class="cta-box">
		<div class="cta-bg">
			<img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/common-background.jpg'); ?>" alt="<?php echo esc_attr( $cta_title ? $cta_title : $site_name ); ?>" title="<?php echo esc_attr( $cta_title ? $cta_title : $site_name ); ?>" width="1920" height="1065">
		</div>
		<div class="container">
			<div class="cta-content">
				<?php if ( $cta_title || $cta_content ) : ?>
					<div class="section-head cta-head text-center">
						<?php if ( ! empty( $cta_title ) ) : ?>
							<h2 class="h2-title section-head-title mb-0 wow fadeup-animation" data-wow-delay="0.2s"><?php echo esc_html( $cta_title ); ?></h2>
						<?php endif; ?>
						<?php if ( ! empty( $cta_content ) ) : ?>
							<div class="section-head-desc text-l wow fadeup-animation" data-wow-delay="0.2s">
								<?php echo wp_kses_post( $cta_content ); ?>
							</div>
						<?php endif; ?>
					</div>
				<?php endif; ?>
				<?php if ( $has_cta_btn ) : ?>
					<div class="cta-actions wow fadeup-animation" data-wow-delay="0.2s">
						<a class="sec-btn white-btn" href="<?php echo esc_url( $cta_btn_url ); ?>" title="<?php echo esc_attr( $cta_button_title ); ?>"<?php echo $cta_btn_target ? ' target="' . esc_attr( $cta_btn_target ) . '" rel="noopener noreferrer"' : ''; ?>>
							<span><?php echo esc_html( $cta_button_title ); ?></span>
						</a>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
<!-- CTA End -->
<?php endif; ?>

<footer id="colophon" class="site-footer white-text">
	<div class="footer-box">
		<div class="container">
			<div class="footer-main">
				<div class="row footer-main-row">
					<div class="col-lg-4 footer-brand">
						<?php if ( ! empty( $brand_logo['url'] ) ) : ?>
							<div class="footer-logo">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( ! empty( $brand_logo['alt'] ) ? $brand_logo['alt'] : $site_name ); ?>">
									<img src="<?php echo esc_url( $brand_logo['url'] ); ?>" alt="<?php echo esc_attr( ! empty( $brand_logo['alt'] ) ? $brand_logo['alt'] : $site_name ); ?>" title="<?php echo esc_attr( ! empty( $brand_logo['alt'] ) ? $brand_logo['alt'] : $site_name ); ?>" width="<?php echo esc_attr( ! empty( $brand_logo['width'] ) ? $brand_logo['width'] : 350 ); ?>" height="<?php echo esc_attr( ! empty( $brand_logo['height'] ) ? $brand_logo['height'] : 151 ); ?>">
								</a>
							</div>
						<?php endif; ?>
						<?php if ( $footer_description ) : ?>
							<div class="footer-intro">
								<?php echo wp_kses_post( $footer_description ); ?>
							</div>
						<?php endif; ?>
						<div class="footer-review">
							<a href="<?php echo esc_url('https://www.google.com/search?q=Eclipse+Roofing+Manheim+PA+reviews'); ?>" title="Google Reviews" target="_blank" rel="noopener">
								<img src="<?php echo esc_url(home_url('/wp-content/uploads/2026/08/google-review.svg')); ?>" alt="Google Reviews" title="Google Reviews" width="121" height="54">
							</a>
						</div>
					</div>
					<div class="col-md-8 col-lg-4 footer-menus">
						<div class="row footer-menus-row">
							<div class="col-6">
								<?php if (has_nav_menu('footer-navigation')) : ?>
									<div class="footer-nav">
										<div class="footer-nav-title text-s">
											<p>Navigation</p>
										</div>
										<?php
										wp_nav_menu(
											array(
												'theme_location' => 'footer-navigation',
												'container'      => false,
												'menu_class'     => 'footer-menu',
												'depth'          => 1,
												'fallback_cb'    => false,
											)
										);
										?>
									</div>
								<?php endif; ?>
							</div>
							<div class="col-6">
								<?php if (has_nav_menu('footer-services')) : ?>
									<div class="footer-nav">
										<div class="footer-nav-title text-s">
											<p>Services</p>
										</div>
										<?php
										wp_nav_menu(
											array(
												'theme_location' => 'footer-services',
												'container'      => false,
												'menu_class'     => 'footer-menu',
												'depth'          => 1,
												'fallback_cb'    => false,
											)
										);
										?>
									</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-lg-4 footer-contact">
						<div class="footer-contact-content">
							<?php if ( $phone_url && $phone_title ) : ?>
								<div class="header-phone footer-phone">
									<span class="header-phone-icon">
										<iconify-icon icon="fa7-solid:phone"></iconify-icon>
									</span>
									<a class="h4-title mb-0 footer-phone-number" href="<?php echo esc_url( $phone_url ); ?>" title="<?php echo esc_attr( $phone_title ); ?>"><?php echo esc_html( $phone_title ); ?></a>
								</div>
							<?php endif; ?>
							<?php if ( $email_url || $address_text || $address_url ) : ?>
								<div class="footer-contact-details text-s">
									<?php if ( $email_url && $email_text ) : ?>
										<a href="<?php echo esc_url( $email_url ); ?>" title="<?php echo esc_attr( $email_text ); ?>"><?php echo esc_html( $email_text ); ?></a>
									<?php endif; ?>
									<?php if ( $address_text || $address_url ) : ?>
										<?php if ( $address_url ) : ?>
											<a href="<?php echo esc_url( $address_url ); ?>" title="<?php echo esc_attr( $address_text ? $address_text : $address_url ); ?>" target="_blank" rel="noopener"><?php echo esc_html( $address_text ? $address_text : $address_url ); ?></a>
										<?php else : ?>
											<span><?php echo esc_html( $address_text ); ?></span>
										<?php endif; ?>
									<?php endif; ?>
								</div>
							<?php endif; ?>
							<?php if ( is_string( $footer_options ) && $footer_options !== '' ) : ?>
							<div class="footer-meta text-s">
								<?php echo wp_kses_post( $footer_options ); ?>
							</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
			<div class="footer-bottom">
				<div class="footer-copy text-s">
					<p>&copy; <?php echo esc_html(gmdate('Y')); ?> <?php echo esc_html( $site_name ); ?></p>
				</div>
				<?php if (has_nav_menu('privacy-menu')) : ?>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'privacy-menu',
							'container'      => false,
							'menu_class'     => 'footer-privacy-menu text-s',
							'depth'          => 1,
							'fallback_cb'    => false,
						)
					);
					?>
				<?php endif; ?>
				<?php if ( $marketing ) : ?>
					<div class="footer-credit text-s">
						<?php echo wp_kses_post( $marketing ); ?>
					</div>
				<?php endif; ?>
			</div>
			<?php
                
                // Service links. Home, blog, archives, singles, and the SEO template.
                $should_show_footer_last = is_page_template( 'template-pages/template-seo.php' ) || is_front_page() || is_home() || is_archive() || is_author() || is_category() || is_single() || is_tag();
                	
                $footer_seo_menu = wp_nav_menu(
                	array(
                		'theme_location' => 'seo-menu',
                		'echo'           => false,
                		'fallback_cb'    => '__return_empty_string',
                	)
                );
                
                
                if ( $should_show_footer_last && ! empty( trim( wp_strip_all_tags( $footer_seo_menu ) ) ) ) {
                	?>
                	<div class="footer-last body-text-sm">
                		<div class="container">
                			<span class="text" id="view_all_services" title="View all service">View All Services</span>
                
                			<div class="all-services">
                				<?php echo $footer_seo_menu; ?>
                			</div>
                		</div>
                	</div>
                	<?php
                }
                ?>
		</div>
	</div>
</footer><!-- #colophon -->

<!-- Scroll To Top Start -->
<button type="button" id="scroll-to-top" class="scrolltop" name="Back To Top">
	<iconify-icon icon="eva:arrow-up-fill"></iconify-icon>
</button>
<!-- Scroll To Top End -->

<!-- Declare the reusable filter anywhere in your HTML -->
<svg xmlns="http://www.w3.org/2000/svg" style="visibility: hidden; position: absolute; width: 0; height: 0; " aria-hidden="true">
	<defs>
		<filter id="round-xl" x="-50%" y="-50%" width="200%" height="200%" color-interpolation-filters="sRGB">
			<feGaussianBlur in="SourceGraphic" stdDeviation="16.67" result="blur"></feGaussianBlur>
			<feComponentTransfer in="blur" result="goo">
				<feFuncA type="table" tableValues="0 0 0 0 0 0 0 0 0 1 1 1 1 1 1 1 1 1 1"></feFuncA>
			</feComponentTransfer>
			<feComposite in="SourceGraphic" in2="goo" operator="atop"></feComposite>
		</filter>

		<filter id="round-lg" x="-50%" y="-50%" width="200%" height="200%" color-interpolation-filters="sRGB">
			<feGaussianBlur in="SourceGraphic" stdDeviation="13.33" result="blur"></feGaussianBlur>
			<feComponentTransfer in="blur" result="goo">
				<feFuncA type="table" tableValues="0 0 0 0 0 0 0 0 0 1 1 1 1 1 1 1 1 1 1"></feFuncA>
			</feComponentTransfer>
			<feComposite in="SourceGraphic" in2="goo" operator="atop"></feComposite>
		</filter>

		<filter id="round-md" x="-50%" y="-50%" width="200%" height="200%" color-interpolation-filters="sRGB">
			<feGaussianBlur in="SourceGraphic" stdDeviation="11.67" result="blur"></feGaussianBlur>
			<feComponentTransfer in="blur" result="goo">
				<feFuncA type="table" tableValues="0 0 0 0 0 0 0 0 0 1 1 1 1 1 1 1 1 1 1"></feFuncA>
			</feComponentTransfer>
			<feComposite in="SourceGraphic" in2="goo" operator="atop"></feComposite>
		</filter>
		
		<filter id="round-sm" x="-50%" y="-50%" width="200%" height="200%" color-interpolation-filters="sRGB">
			<feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur"></feGaussianBlur>
			<feComponentTransfer in="blur" result="goo">
				<feFuncA type="table" tableValues="0 0 0 0 0 0 0 0 0 1 1 1 1 1 1 1 1 1 1"></feFuncA>
			</feComponentTransfer>
			<feComposite in="SourceGraphic" in2="goo" operator="atop"></feComposite>
		</filter>
	</defs>
</svg>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>