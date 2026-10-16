<?php
// Shared services block. Heading is from this page, cards are global.
$page_id = get_queried_object_id();
if ( ! $page_id ) {
	$page_id = get_the_ID();
}


$services_sub_title = get_field( 'home_services_sub_title', $page_id );
$services_title     = get_field( 'home_services_title', $page_id );
$services_content   = get_field( 'home_services_content', $page_id );
$placeholder_image  = get_field( 'placeholder_image', 'option' );
$placeholder_image  = is_array( $placeholder_image ) ? ( $placeholder_image['url'] ?? '' ) : (string) $placeholder_image;

$global_items = get_field( 'services_details', 'option' );
if ( ! is_array( $global_items ) || empty( $global_items ) ) {
	$global_items = get_field( 'services_details', 'global-setting' );
}
$global_items = is_array( $global_items ) ? $global_items : array();

$services_items = array();
foreach ( $global_items as $service ) {
	if ( ! is_array( $service ) ) {
		continue;
	}

	$title = $service['title'] ?? '';
	$text  = $service['content'] ?? '';
	$image = $service['image'] ?? '';
	$image = is_array( $image ) ? ( $image['url'] ?? '' ) : (string) $image;
	if ( '' === $title && '' === $text && '' === $image ) {
		continue;
	}

	$is_custom = ! empty( $service['link_type'] );
	$custom    = is_array( $service['link'] ?? null ) ? $service['link'] : array();
	$url       = $is_custom ? ( $custom['url'] ?? '' ) : ( $service['page_link'] ?? '' );
	$url       = is_array( $url ) ? reset( $url ) : $url;

	$services_items[] = array(
		'title'  => $title,
		'text'   => $text,
		'image'  => $image ? $image : $placeholder_image,
		'url'    => is_string( $url ) ? $url : '',
		'target' => $is_custom ? ( $custom['target'] ?? '' ) : '',
	);
}

if ( !empty($services_sub_title) || !empty($services_title) || !empty($services_content) ) :

	?>

<?php if ( is_page( 11 ) ) : ?>
	<div class="section-separator bg-orange-100">
		<span class="section-separator-inner bg-white"></span>
	</div>
<?php endif; ?>
<!-- Services Section Start -->
<section class="services">
	<div class="container">
		<div class="section-head services-head text-center">
			<div class="section-head-title-group">
				<?php if ( ! empty( $services_sub_title ) ) : ?>
					<div class="section-head-eyebrow text-xs wow fadeup-animation" data-wow-delay="0.2s">
						<p><?php echo esc_html( $services_sub_title ); ?></p>
					</div>
				<?php endif; ?>
				<?php if ( ! empty( $services_title ) ) : ?>
					<h2 class="h2-title section-head-title mb-0 wow fadeup-animation" data-wow-delay="0.4s"><?php echo esc_html( $services_title ); ?></h2>
				<?php endif; ?>
			</div>
			<?php if ( ! empty( $services_content ) ) : ?>
				<div class="section-head-desc text-l wow fadeup-animation" data-wow-delay="0.6s">
					<?php echo wp_kses_post( $services_content ); ?>
				</div>
			<?php endif; ?>
		</div>
		<?php if ( $services_sub_title || $services_title || $services_content ) : ?>
			<div class="row services-cards">
				<?php
				foreach ( $services_items as $service ) :
					$service_url   = ! empty( $service['url'] ) ? $service['url'] : '#';
					$service_title = $service['title'];
					$service_image = $service['image'];
					$service_target = $service['target'];
					?>
					<div class="col-lg-6">
						<a class="services-card wow fadeup-animation" href="<?php echo esc_url( $service_url ); ?>" title="<?php echo esc_attr( $service_title ); ?>" aria-label="<?php echo esc_attr( $service_title ); ?>"<?php echo $service_target ? ' target="' . esc_attr( $service_target ) . '" rel="noopener"' : ''; ?> data-wow-delay="0.2s">
							<span class="sec-btn services-card-btn">
								<iconify-icon icon="iconamoon:arrow-top-right-1"></iconify-icon>
							</span>
							<div class="services-card-inner">
								<div class="services-card-content">
									<?php if ( ! empty( $service_title ) ) : ?>
										<h3 class="h4-title mb-0"><?php echo esc_html( $service_title ); ?></h3>
									<?php endif; ?>
									<?php if ( ! empty( $service['text'] ) ) : ?>
										<div class="services-card-text">
											<?php echo wp_kses_post( $service['text'] ); ?>
										</div>
									<?php endif; ?>
								</div>
								<?php if ( ! empty( $service_image ) ) : ?>
									<div class="services-card-media">
										<img src="<?php echo esc_url( $service_image ); ?>" alt="<?php echo esc_attr( $service_title ); ?>" title="<?php echo esc_attr( $service_title ); ?>" width="384" height="256">
									</div>
								<?php endif; ?>
							</div>
						</a>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>
<!-- Services Section End -->
	<?php
endif;
