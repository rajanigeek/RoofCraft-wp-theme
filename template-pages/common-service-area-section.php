<?php

// Location heading on this page. Empty pages fall back to the service template.
$loc_title   = get_field( 'service_location_title');
$loc_content = get_field( 'service_location_content');
$loc_btn     = get_field( 'service_location_btn_text');
$loc_custom  = (int) get_field( 'service_location_link_type');
$loc_page    = get_field( 'service_location_page_link');
$loc_link    = get_field( 'service_location_link');

if ( empty( $loc_title ) && empty( $loc_content ) && empty( $loc_btn ) ) {
	$service_pages = get_posts(
		array(
			'post_type'      => 'page',
			'post_status'    => 'publish',
			'posts_per_page' => 1,
			'fields'         => 'ids',
			'meta_key'       => '_wp_page_template',
			'meta_value'     => 'template-pages/template-service.php',
			'no_found_rows'  => true,
		)
	);
	if ( ! empty( $service_pages ) ) {

		$loc_title        = get_field( 'service_location_title');
		$loc_content      = get_field( 'service_location_content');
		$loc_btn          = get_field( 'service_location_btn_text');
		$loc_custom       = (int) get_field( 'service_location_link_type');
		$loc_page         = get_field( 'service_location_page_link');
		$loc_link         = get_field( 'service_location_link');
	}
}

$loc_url    = '';
$loc_target = '';
if ( $loc_custom ) {
	$loc_url    = ( is_array( $loc_link ) && ! empty( $loc_link['url'] ) ) ? $loc_link['url'] : '';
	$loc_target = ( is_array( $loc_link ) && ! empty( $loc_link['target'] ) ) ? $loc_link['target'] : '';
} else {
	$loc_url = is_string( $loc_page ) ? $loc_page : '';
}
$has_loc_btn = ! empty( $loc_btn ) && ! empty( $loc_url );

// Town list and map points, from options.
$learn_more_title = get_field( 'locations_button_title', 'option' );
$map_iframe_url   = get_field( 'service_location_image', 'option' );
$location_details = get_field( 'service_location_details', 'option' );
$location_details = is_array( $location_details ) ? $location_details : array();

$locations  = array();
$map_points = array();
foreach ( $location_details as $row ) {
	$name     = ! empty( $row['location'] ) ? $row['location'] : '';
	$lat      = isset( $row['latitude'] ) ? trim( (string) $row['latitude'] ) : '';
	$lng      = isset( $row['longitude'] ) ? trim( (string) $row['longitude'] ) : '';
	$page     = ! empty( $row['location_page'] ) ? $row['location_page'] : '';
	$page_url = is_numeric( $page ) ? (string) get_permalink( (int) $page ) : ( is_string( $page ) ? $page : '' );
	if ( '' === $name && '' === $lat && '' === $lng && '' === $page_url ) {
		continue;
	}
	$has_point = is_numeric( $lat ) && is_numeric( $lng );
	$embed     = $has_point ? 'https://maps.google.com/maps?q=loc:' . $lat . ',' . $lng . '&z=9&output=embed' : '';
	$locations[] = array(
		'name'      => $name,
		'lat'       => $lat,
		'lng'       => $lng,
		'embed'     => $embed,
		'href'      => $page_url,
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

$map_src   = '';
$map_title = ! empty( $loc_title ) ? $loc_title : '';
foreach ( $locations as $location_item ) {
	if ( empty( $location_item['embed'] ) ) {
		continue;
	}
	$map_src   = $location_item['embed'];
	$map_title = ! empty( $location_item['name'] ) ? $location_item['name'] : $map_title;
	break;
}
if ( empty( $map_src ) && ! empty( $map_iframe_url ) ) {
	$map_src = $map_iframe_url;
}

$has_list    = ! empty( $locations );
$has_map     = ! empty( $map_src ) || ! empty( $map_points );

if (  ! empty( $loc_title ) &&  ! empty( $loc_content )) : ?>
	<!-- Service Area Section Start -->
	<section class="service-area">
		<?php if (! empty( $loc_title ) &&  ! empty( $loc_content )) : ?>
		<div class="container">
				<div class="service-area-heading">
					<?php if ( ! empty( $loc_title ) || ! empty( $loc_content ) ) : ?>
						<div class="service-area-heading-content">
							<?php if ( ! empty( $loc_title ) ) : ?>
								<h2 class="h3-title mb-0 wow fadeup-animation" data-wow-delay="0.2s"><?php echo esc_html( $loc_title ); ?></h2>
							<?php endif; ?>
							<?php if ( ! empty( $loc_content ) ) : ?>
								<div class="service-area-heading-desc wow fadeup-animation" data-wow-delay="0.2s">
									<?php echo wp_kses_post( $loc_content ); ?>
								</div>
							<?php endif; ?>
						</div>
					<?php endif; ?>
					<?php if ( $has_loc_btn ) : ?>
						<div class="service-area-heading-cta-desktop">
							<a class="sec-btn dark-outline-btn wow fadeup-animation" href="<?php echo esc_url( $loc_url ); ?>" title="<?php echo esc_attr( $loc_btn ); ?>" data-wow-delay="0.2s"<?php echo ! empty( $loc_target ) ? ' target="' . esc_attr( $loc_target ) . '" rel="noopener noreferrer"' : ''; ?>><?php echo esc_html( $loc_btn ); ?></a>
						</div>
					<?php endif; ?>
				</div>
			
			<?php if ( $has_list || $has_map ) : ?>
				<div class="service-area-columns">
					<?php if ( $has_list ) : ?>
						<div class="service-area-content wow left-animation" data-wow-delay="0.2s">
							<div class="service-area-list-wp">
								<div class="service-area-list" data-simplebar>
									<div class="service-area-list-inner">
										<?php
										$service_area_index = 0;
										$map_index          = 0;
										foreach ( $locations as $service_area_item ) :
											$is_active = ( 0 === $service_area_index ) ? ' is-active' : '';
											$service_area_index++;
											?>
											<div class="service-area-item<?php echo esc_attr( $is_active ); ?>"<?php echo $service_area_item['has_point'] ? ' data-map-index="' . esc_attr( (string) $map_index ) . '"' : ''; ?><?php echo $service_area_item['has_point'] ? ' data-lat="' . esc_attr( $service_area_item['lat'] ) . '" data-lng="' . esc_attr( $service_area_item['lng'] ) . '" data-map-src="' . esc_url( $service_area_item['embed'] ) . '"' : ''; ?>>
												<?php if ( ! empty( $service_area_item['name'] ) ) : ?>
													<div class="service-area-title">
														<iconify-icon icon="fa7-solid:location-dot"></iconify-icon>
														<h3 class="h6-title mb-0"><?php echo esc_html( $service_area_item['name'] ); ?></h3>
													</div>
												<?php endif; ?>
												<?php if ( ! empty( $service_area_item['href'] ) ) : ?>
													<a class="service-area-link" href="<?php echo esc_url( $service_area_item['href'] ); ?>" title="<?php echo esc_attr( ! empty( $learn_more_title ) ? $learn_more_title : $service_area_item['name'] ); ?>">
														<iconify-icon icon="akar-icons:chevron-right"></iconify-icon>
														<?php if ( ! empty( $learn_more_title ) ) : ?>
															<span><?php echo esc_html( $learn_more_title ); ?></span>
														<?php endif; ?>
													</a>
												<?php endif; ?>
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
						</div>
					<?php endif; ?>
					<?php if ( $has_map ) : ?>
						<div class="service-area-map-wp wow right-animation" data-wow-delay="0.2s">
							<div class="service-area-map"<?php echo ! empty( $map_points ) ? ' data-map-locations="' . esc_attr( wp_json_encode( $map_points ) ) . '"' : ''; ?>>
								<?php if ( ! empty( $map_src ) ) : ?>
									<iframe src="<?php echo esc_url( $map_src ); ?>" title="<?php echo esc_attr( $map_title ); ?>" width="792" height="723" loading="lazy" allowfullscreen referrerpolicy="no-referrer-when-downgrade"></iframe>
								<?php endif; ?>
							</div>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>
			<?php if ( $has_loc_btn ) : ?>
				<div class="service-area-heading-cta-mobile wow fadeup-animation" data-wow-delay="0.2s">
					<a class="sec-btn dark-outline-btn" href="<?php echo esc_url( $loc_url ); ?>" title="<?php echo esc_attr( $loc_btn ); ?>"<?php echo ! empty( $loc_target ) ? ' target="' . esc_attr( $loc_target ) . '" rel="noopener noreferrer"' : ''; ?>><?php echo esc_html( $loc_btn ); ?></a>
				</div>
			<?php endif; ?>
			
		</div>
		<?php endif; ?>
	</section>
	<!-- Service Area Section End -->

<?php
endif;
?>
