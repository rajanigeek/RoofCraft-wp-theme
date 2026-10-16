<?php
// Inner banner. Page fields first, then the archive title, then the default image.
$source_id = 0;
if ( is_singular() ) {
	$source_id = (int) get_queried_object_id();
} elseif ( is_home() ) {
	$source_id = (int) get_option( 'page_for_posts' );
}

$banner_title   = $source_id ? get_field( 'common_banner_title', $source_id ) : '';
$banner_content = $source_id ? get_field( 'common_banner_content', $source_id ) : '';
$banner_image   = $source_id ? get_field( 'common_banner_image', $source_id ) : '';
$has_buttons    = $source_id ? get_field( 'common_banner_has_buttons', $source_id ) : '';
$banner_image   = is_array( $banner_image ) ? ( $banner_image['url'] ?? '' ) : (string) $banner_image;

if ( empty( $banner_title ) ) {
	if ( $source_id ) {
		$banner_title = get_the_title( $source_id );
	} elseif ( is_search() ) {
		$banner_title = sprintf( 'Search results for “%s”', get_search_query() );
	} elseif ( is_404() ) {
		$banner_title = 'Page not found';
	} elseif ( is_archive() ) {
		$banner_title = wp_strip_all_tags( get_the_archive_title() );
	}
}

if ( empty( $banner_content ) && $source_id && has_excerpt( $source_id ) ) {
	$banner_content = '<p>' . esc_html( get_the_excerpt( $source_id ) ) . '</p>';
} elseif ( empty( $banner_content ) && is_archive() ) {
	$banner_content = get_the_archive_description();
}

if ( empty( $banner_image ) && $source_id && has_post_thumbnail( $source_id ) ) {
	$banner_image = get_the_post_thumbnail_url( $source_id, 'full' );
}
if ( empty( $banner_image ) ) {
	$placeholder  = get_field( 'placeholder_image', 'option' );
	$banner_image = is_array( $placeholder ) ? ( $placeholder['url'] ?? '' ) : (string) $placeholder;
}
if ( empty( $banner_image ) ) {
	$banner_image = get_template_directory_uri() . '/assets/images/common-banner.jpg';
}

$show_buttons = ( 'Yes' === $has_buttons );
$call_title   = '';
$call_url     = '';
$est_title    = '';
$est_url      = '';

if ( $show_buttons ) {
	$call_title = get_field( 'common_banner_button_title', 'option' );
	$est_title  = get_field( 'common_banner_estimate_title', 'option' );
	$est_url    = get_field( 'common_banner_estimate_link', 'option' );
	$est_url    = is_array( $est_url ) ? reset( $est_url ) : $est_url;

	$pr_phone = get_field( 'pr_phone_number', 'option' );
	if ( is_array( $pr_phone ) ) {
		$call_url = ! empty( $pr_phone['url'] ) ? $pr_phone['url'] : '';
	} elseif ( ! empty( $pr_phone ) ) {
		$digits   = preg_replace( '/\D+/', '', (string) $pr_phone );
		$call_url = $digits ? 'tel:' . $digits : '';
	}
}

$has_call     = ( $show_buttons && ! empty( $call_title ) && ! empty( $call_url ) );
$has_estimate = ( $show_buttons && ! empty( $est_title ) && ! empty( $est_url ) );
?>
<!-- Banner Start -->
<section class="main-banner hero inner-banner white-text">
	<div class="inner-banner-bg">
		<img src="<?php echo esc_url( $banner_image ); ?>" alt="<?php echo esc_attr( $banner_title ); ?>" title="<?php echo esc_attr( $banner_title ); ?>" width="1280" height="720">
	</div>
	<div class="container">
		<div class="hero-content">
			<?php if ( ! empty( $banner_title ) ) : ?>
				<div class="hero-title-group">
					<h1 class="h2-title mb-0 wow fadeup-animation" data-wow-delay="0.4s"><?php echo esc_html( $banner_title ); ?></h1>
				</div>
			<?php endif; ?>
			<?php if ( ! empty( $banner_content ) ) : ?>
				<div class="hero-desc text-l wow fadeup-animation" data-wow-delay="0.6s">
					<?php echo wp_kses_post( $banner_content ); ?>
				</div>
			<?php endif; ?>
			<?php if ( $has_call || $has_estimate ) : ?>
				<div class="hero-actions wow fadeup-animation" data-wow-delay="0.8s">
					<?php if ( $has_call ) : ?>
						<a class="sec-btn" href="<?php echo esc_url( $call_url ); ?>" title="<?php echo esc_attr( $call_title ); ?>"><?php echo esc_html( $call_title ); ?></a>
					<?php endif; ?>
					<?php if ( $has_estimate ) : ?>
						<a class="sec-btn white-btn" href="<?php echo esc_url( $est_url ); ?>" title="<?php echo esc_attr( $est_title ); ?>"><?php echo esc_html( $est_title ); ?></a>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
	<div class="section-separator"><span class="section-separator-inner bg-white"></span></div>
</section>
<!-- Banner End -->
