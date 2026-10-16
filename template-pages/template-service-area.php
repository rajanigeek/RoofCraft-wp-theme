<?php /* Template Name: Service Area */
get_header();

$service_area_page_id = get_queried_object_id();

// Intro for this page.
$service_area_title       = get_field( 'service_area_title', $service_area_page_id );
$service_area_description = get_field( 'service_area_description', $service_area_page_id );
$service_area_image       = get_field( 'service_area_image', $service_area_page_id );
$service_area_image       = is_array( $service_area_image ) ? $service_area_image : array();

$has_about_media = ! empty( $service_area_image['url'] );
$has_about_head  = ! empty( $service_area_title ) || ! empty( $service_area_description );

$service_location_title   = get_field( 'service_location_title', $service_area_page_id );
$service_location_content = get_field( 'service_location_content', $service_area_page_id );
$has_location_heading      = ! empty( $service_location_title ) || ! empty( $service_location_content );

// Towns and the map. Both live in options.
$learn_more_title = get_field( 'locations_button_title', 'option' );
$map_iframe_url   = get_field( 'service_location_image', 'option' );
$location_details = get_field( 'service_location_details', 'option' );
$location_details = is_array( $location_details ) ? $location_details : array();

$service_area_items = array();
$map_points         = array();
foreach ( $location_details as $row ) {
	$name = ! empty( $row['location'] ) ? $row['location'] : '';
	$lat  = isset( $row['latitude'] ) ? trim( (string) $row['latitude'] ) : '';
	$lng  = isset( $row['longitude'] ) ? trim( (string) $row['longitude'] ) : '';
	if ( '' === $name && '' === $lat && '' === $lng ) {
		continue;
	}
	$has_point             = is_numeric( $lat ) && is_numeric( $lng );
	$service_area_items[]  = array(
		'name'      => $name,
		'lat'       => $lat,
		'lng'       => $lng,
		'embed'     => $has_point ? 'https://maps.google.com/maps?q=loc:' . $lat . ',' . $lng . '&z=9&output=embed' : '',
		'href'      => $has_point ? 'https://www.google.com/maps?q=' . rawurlencode( $lat . ',' . $lng ) : '',
		'has_point' => $has_point,
	);
	if ( $has_point ) {
		$map_points[] = array(
			'name' => $name,
			'lat'  => (float) $lat,
			'lng'  => (float) $lng,
		);
	}
}

$map_src = '';
foreach ( $service_area_items as $service_area_map_item ) {
	if ( ! empty( $service_area_map_item['embed'] ) ) {
		$map_src = $service_area_map_item['embed'];
		break;
	}
}
if ( empty( $map_src ) && ! empty( $map_iframe_url ) ) {
	$map_src = $map_iframe_url;
}

$has_area_list = ! empty( $service_area_items );
$has_area_map  = ! empty( $map_src ) || ! empty( $map_points );
$map_title     = ! empty( $service_area_title ) ? $service_area_title : 'Eclipse Roofing service area map';
?>
<div id="primary" class="content-area">
	<main id="main" class="site-main">
        <?php get_template_part('template-pages/common','inner-banner-section'); ?>

		<?php if ( $has_about_media || $has_about_head ) : ?>
		<!-- About Section Start -->
		<section class="about about-service-area">
			<div class="container container-lg">
				<div class="about-top">
					<?php if ( $has_about_media ) : ?>
					<div class="about-media wow left-animation" data-wow-delay="0.2s">
						<div class="about-media-main">
							<img src="<?php echo esc_url( $service_area_image['url'] ); ?>" alt="<?php echo esc_attr( ! empty( $service_area_image['alt'] ) ? $service_area_image['alt'] : $service_area_title ); ?>" title="<?php echo esc_attr( ! empty( $service_area_image['title'] ) ? $service_area_image['title'] : $service_area_title ); ?>" width="<?php echo esc_attr( ! empty( $service_area_image['width'] ) ? $service_area_image['width'] : 656 ); ?>" height="<?php echo esc_attr( ! empty( $service_area_image['height'] ) ? $service_area_image['height'] : 383 ); ?>">
						</div>
					</div>
					<?php endif; ?>
					<?php if ( $has_about_head ) : ?>
					<div class="about-content">
						<?php if ( ! empty( $service_area_title ) ) : ?>
						<div class="section-head about-head">
							<h2 class="h2-title section-head-title mb-0 wow fadeup-animation" data-wow-delay="0.2s"><?php echo esc_html( $service_area_title ); ?></h2>
						</div>
						<?php endif; ?>
						<?php if ( ! empty( $service_area_description ) ) : ?>
						<div class="about-intro wow fadeup-animation" data-wow-delay="0.2s">
							<?php echo wp_kses_post( $service_area_description ); ?>
						</div>
						<?php endif; ?>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</section>
		<!-- About Section End -->

		<div class="section-separator bg-white"><span class="section-separator-inner bg-orange-100"></span></div>
		<?php endif; ?>

		<!-- Service Area Communities Section Start -->
		<section class="service-area service-area-page">
			<div class="container">
				<?php if ( $has_location_heading ) : ?>
				<div class="service-area-heading">
					<div class="service-area-heading-content">
						<?php if ( ! empty( $service_location_title ) ) : ?>
						<h2 class="h2-title mb-0 wow fadeup-animation" data-wow-delay="0.2s"><?php echo esc_html( $service_location_title ); ?></h2>
						<?php endif; ?>
						<?php if ( ! empty( $service_location_content ) ) : ?>
						<div class="service-area-heading-desc wow fadeup-animation" data-wow-delay="0.2s">
							<?php echo wp_kses_post( $service_location_content ); ?>
						</div>
						<?php endif; ?>
					</div>
				</div>
				<?php endif; ?>
				<?php if ( $has_area_list || $has_area_map ) : ?>
				<div class="service-area-columns">
					<?php if ( $has_area_list ) : ?>
					<div class="service-area-content wow fadeup-animation" data-wow-delay="0.2s">
						<div class="service-area-chips">
							<div class="service-area-list-inner">
								<?php
								$service_area_index = 0;
								$map_index          = 0;
								foreach ( $service_area_items as $service_area_item ) :
									$is_active = ( 0 === $service_area_index ) ? ' is-active' : '';
									$service_area_index++;
									?>
								<div class="service-area-item<?php echo esc_attr( $is_active ); ?>"<?php echo $service_area_item['has_point'] ? ' data-map-index="' . esc_attr( (string) $map_index ) . '" data-lat="' . esc_attr( $service_area_item['lat'] ) . '" data-lng="' . esc_attr( $service_area_item['lng'] ) . '" data-map-src="' . esc_url( $service_area_item['embed'] ) . '"' : ''; ?>>
									<a class="service-area-link" href="<?php echo esc_url( $service_area_item['href'] ); ?>" data-latitude="<?php echo esc_attr( $service_area_item['lat'] ); ?>" data-longitude="<?php echo esc_attr( $service_area_item['lng'] ); ?>" title="<?php echo esc_attr( $service_area_item['name'] ); ?>">
										<iconify-icon icon="fa7-solid:location-dot"></iconify-icon>
										<span class="h6-title mb-0"><?php echo esc_html( $service_area_item['name'] ); ?></span>
									</a>
								</div>
								<?php
								if ( $service_area_item['has_point'] ) {
									$map_index++;
								}
								endforeach;
								?>
							</div>
						</div>
					</div>
					<?php endif; ?>
					<?php if ( $has_area_map ) : ?>
					<div class="service-area-map-wp wow fadeup-animation" data-wow-delay="0.2s">
						<div class="service-area-map"<?php echo ! empty( $map_points ) ? ' data-map-locations="' . esc_attr( wp_json_encode( $map_points ) ) . '"' : ''; ?>>
							<?php if ( ! empty( $map_src ) ) : ?>
							<iframe src="<?php echo esc_url( $map_src ); ?>" title="<?php echo esc_attr( $map_title ); ?>" width="1360" height="723" loading="lazy" allowfullscreen referrerpolicy="no-referrer-when-downgrade"></iframe>
							<?php endif; ?>
						</div>
					</div>
					<?php endif; ?>
				</div>
				<?php endif; ?>
			</div>
		</section>
		<!-- Service Area Communities Section End -->

        <div class="section-separator bg-orange-100"><span class="section-separator-inner bg-orange-100"></span></div>
    </main><!-- #main -->
</div><!-- #primary -->
<?php
get_footer();
?>
