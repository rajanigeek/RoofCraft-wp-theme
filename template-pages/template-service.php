<?php
/* Template Name: Service */

get_header();

$placeholder_image = get_field( 'placeholder_image', 'option' );

// Placeholder may come back as an image array, an ID, or a URL.
if ( is_array( $placeholder_image ) ) {
	$placeholder_image = isset( $placeholder_image['url'] ) ? $placeholder_image['url'] : '';
} elseif ( is_numeric( $placeholder_image ) ) {
	$placeholder_image = wp_get_attachment_image_url( $placeholder_image, 'full' );
}
?>
<div id="primary" class="content-area">
	<main id="main" class="site-main">
		<?php get_template_part( 'template-pages/common', 'inner-banner-section' ); ?>

		<?php
		// Intro. Full width drops the side image and the heading.
		$intro_layout      = get_field( 'service_intro_has_full_width' );
		$intro_icon        = get_field( 'service_intro_icon' );
		$intro_title       = get_field( 'service_intro_title' );
		$intro_content     = get_field( 'service_intro_content' );
		$intro_image       = get_field( 'service_intro_image' );
		$intro_aside_image = get_field( 'service_intro_additional_image' );

		$intro_title      = ! empty( $intro_title ) ? $intro_title : '';
		$intro_title_attr = $intro_title ? wp_strip_all_tags( $intro_title ) : get_the_title();
		$intro_is_full    = ( 'Yes' === $intro_layout );

		$intro_icon_url  = ! empty( $intro_icon['url'] ) ? $intro_icon['url'] : '';
		$intro_aside_url = ! empty( $intro_aside_image['url'] ) ? $intro_aside_image['url'] : '';

		$intro_section_class = $intro_is_full ? 'service-about service-about-full' : 'service-about';
		$intro_media_width   = $intro_is_full ? 1392 : 926;
		$intro_media_height  = $intro_is_full ? 526 : 356;
		$intro_media_wow     = $intro_is_full ? 'fadeup-animation' : 'right-animation';
		$intro_has_aside     = ( ! $intro_is_full && ( $intro_icon_url || $intro_aside_url ) );
		$intro_show_title    = ( ! $intro_is_full && $intro_title );

		if ( $intro_title || $intro_content || $intro_image || $intro_icon_url || $intro_aside_url ) :
		?>
		<!-- Service About Start -->
		<div class="<?php echo esc_attr( $intro_section_class ); ?>">
			<div class="container container-lg">
				<div class="service-about-grid">

					<?php if ( $intro_has_aside ) : ?>
					<div class="service-about-aside wow left-animation" data-wow-delay="0.2s">

						<?php if ( $intro_icon_url ) : ?>
						<span class="sec-btn service-about-btn">
							<img src="<?php echo esc_url( $intro_icon_url ); ?>" alt="<?php echo esc_attr( $intro_icon['alt'] ); ?>" title="<?php echo esc_attr( $intro_icon['alt'] ); ?>" width="85" height="85">
						</span>
						<?php endif; ?>

						<?php if ( $intro_aside_url ) : ?>
						<div class="service-about-aside-inner cliping-wp">
							<div class="service-about-aside-img">
								<img src="<?php echo esc_url( $intro_aside_url ); ?>" alt="<?php echo esc_attr( $intro_aside_image['alt'] ); ?>" title="<?php echo esc_attr( $intro_aside_image['alt'] ); ?>" width="<?php echo esc_attr( $intro_aside_image['width'] ); ?>" height="<?php echo esc_attr( $intro_aside_image['height'] ); ?>">
							</div>
						</div>
						<?php endif; ?>

					</div>
					<?php endif; ?>

					<div class="service-about-main">

						<div class="service-about-content wow fadeup-animation" data-wow-delay="0.2s">

							<?php if ( $intro_show_title ) : ?>
							<h2 class="h2-title mb-0"><?php echo $intro_title; ?></h2>
							<?php endif; ?>

							<?php if ( $intro_content ) : ?>
							<div class="service-about-copy">
								<?php echo wp_kses_post( $intro_content ); ?>
							</div>
							<?php endif; ?>

						</div>

						<?php if ( $intro_image ) : ?>
						<div class="service-about-media wow <?php echo esc_attr( $intro_media_wow ); ?>" data-wow-delay="0.2s">
							<img src="<?php echo esc_url( $intro_image ); ?>" alt="<?php echo esc_attr( $intro_title_attr ); ?>" title="<?php echo esc_attr( $intro_title_attr ); ?>" width="<?php echo esc_attr( $intro_media_width ); ?>" height="<?php echo esc_attr( $intro_media_height ); ?>">
						</div>
						<?php endif; ?>

					</div>

				</div>
			</div>
		</div>
		<!-- Service About End -->
		<?php endif; ?>

		<?php
		// Content rows. They swap sides as you go down.
		$service_split_items = get_field( 'services_section' );

		if ( ! empty( $service_split_items ) ) :
		?>
		<div class="section-separator bg-white"><span class="section-separator-inner bg-orange-100"></span></div>

		<!-- Service Split Start -->
		<section class="service-split">
			<div class="container container-lg">
				<div class="service-split-list">
					<?php
					$split_index = 0;

					foreach ( $service_split_items as $split_item ) :

						$item_title   = $split_item['service_title'];
						$item_content = $split_item['service_content'];
						$item_image   = $split_item['service_image'];

						$item_title_attr = $item_title ? wp_strip_all_tags( $item_title ) : get_the_title();

						$is_reverse    = ( 1 === $split_index % 2 );
						$content_order = $is_reverse ? ' order-lg-2' : '';
						$media_order   = $is_reverse ? ' order-lg-1' : '';
						$media_wow     = $is_reverse ? 'left-animation' : 'right-animation';

						$split_index++;
					?>
					<div class="row service-split-row">
						<div class="col-lg-6 align-self-center service-split-content-col<?php echo esc_attr( $content_order ); ?>">
							<div class="service-split-content wow fadeup-animation" data-wow-delay="0.2s">

								<?php if ( $item_title ) : ?>
								<h2 class="h2-title mb-0"><?php echo  $item_title ; ?></h2>
								<?php endif; ?>

								<?php if ( $item_content ) : ?>
								<div class="service-split-body">
									<?php echo wp_kses_post( $item_content ); ?>
								</div>
								<?php endif; ?>

							</div>
						</div>

						<?php if ( $item_image ) : ?>
						<div class="col-lg-6 service-split-media-col<?php echo esc_attr( $media_order ); ?>">
							<div class="service-split-media wow <?php echo esc_attr( $media_wow ); ?>" data-wow-delay="0.2s">
								<img src="<?php echo esc_url( $item_image ); ?>" alt="<?php echo esc_attr( $item_title_attr ); ?>" title="<?php echo esc_attr( $item_title_attr ); ?>" width="656" height="480">
							</div>
						</div>
						<?php endif; ?>

					</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
		<!-- Service Split End -->

		<?php endif; ?>

		<?php
		// Category picked on this page, for the services block below.
		$service_products_term = get_field( 'service_products_details' );
		if ( is_array( $service_products_term ) && isset( $service_products_term[0] ) ) {
			$service_products_term = $service_products_term[0];
		}
		get_template_part( 'template-pages/common', 'service-section', array( 'term' => $service_products_term ) );
		?>

		<?php
		// Warranty slider under the services.
		$warranties_sub_title = get_field( 'warranties_sub_title' );
		$warranties_title     = get_field( 'warranties_title' );
		$warranties_content   = get_field( 'warranties_description' );
		$warranties_items     = get_field( 'warranties' );

		$warranties_has_head   = ( $warranties_sub_title || $warranties_title || $warranties_content );
		$warranties_title_attr = $warranties_title ? wp_strip_all_tags( $warranties_title ) : get_the_title();

		if ( $warranties_has_head || ! empty( $warranties_items ) ) :
		?>
		<div class="section-separator bg-orange-100"><span class="section-separator-inner bg-dark"></span></div>

		<!-- Service Products Start -->
		<section class="service-products bg-dark">
			<div class="container container-lg">
				<div class="row service-products-row">

					<?php if ( $warranties_has_head ) : ?>
					<div class="col-lg-4 align-self-center">
						<div class="section-head service-products-head white-text">

							<?php if ( $warranties_sub_title || $warranties_title ) : ?>
							<div class="section-head-title-group">

								<?php if ( $warranties_sub_title ) : ?>
								<div class="section-head-eyebrow text-xs wow fadeup-animation" data-wow-delay="0.2s">
									<p><?php echo esc_html( $warranties_sub_title ); ?></p>
								</div>
								<?php endif; ?>

								<?php if ( $warranties_title ) : ?>
								<h2 class="h2-title section-head-title mb-0 wow fadeup-animation" data-wow-delay="0.2s"><?php echo wp_kses( $warranties_title, array( 'br' => array() ) ); ?></h2>
								<?php endif; ?>

							</div>
							<?php endif; ?>

							<?php if ( $warranties_content ) : ?>
							<div class="section-head-desc text-l wow fadeup-animation" data-wow-delay="0.2s">
								<?php echo wp_kses_post( $warranties_content ); ?>
							</div>
							<?php endif; ?>

						</div>
					</div>
					<?php endif; ?>

					<?php if ( ! empty( $warranties_items ) ) : ?>
					<div class="col-lg-8">
						<div class="service-products-slider">
							<div class="service-products-swiper">
								<?php
								foreach ( $warranties_items as $warranty ) :

									$warranty_image = $warranty['image'];
									$warranty_text  = $warranty['description'];
									$warranty_type  = $warranty['has_text'];

									if ( is_array( $warranty_type ) ) {
										$warranty_type = isset( $warranty_type['value'] ) ? $warranty_type['value'] : '';
									}

									$is_brand     = ( 'Yes' === $warranty_type );
									$warranty_url = ! empty( $warranty_image['url'] ) ? $warranty_image['url'] : '';

									if ( '' === $warranty_url && ( ! $is_brand || empty( $warranty_text ) ) ) {
										continue;
									}

									$warranty_alt    = ! empty( $warranty_image['alt'] ) ? $warranty_image['alt'] : $warranties_title_attr;
									$warranty_width  = ! empty( $warranty_image['width'] ) ? $warranty_image['width'] : ( $is_brand ? 217 : 443 );
									$warranty_height = ! empty( $warranty_image['height'] ) ? $warranty_image['height'] : ( $is_brand ? 136 : 380 );
								?>
								<div class="service-products-item wow fadeup-animation" data-wow-delay="0.2s">

									<?php if ( $is_brand ) : ?>
									<div class="service-products-brand">

										<?php if ( $warranty_url ) : ?>
										<div class="service-products-brand-logo">
											<img src="<?php echo esc_url( $warranty_url ); ?>" alt="<?php echo esc_attr( $warranty_alt ); ?>" title="<?php echo esc_attr( $warranty_alt ); ?>" width="<?php echo esc_attr( $warranty_width ); ?>" height="<?php echo esc_attr( $warranty_height ); ?>">
										</div>
										<?php endif; ?>

										<?php if ( $warranty_text ) : ?>
										<div class="service-products-brand-text">
											<?php echo wp_kses_post( $warranty_text ); ?>
										</div>
										<?php endif; ?>

									</div>
									<?php else : ?>
									<div class="service-products-media">
										<img src="<?php echo esc_url( $warranty_url ); ?>" alt="<?php echo esc_attr( $warranty_alt ); ?>" title="<?php echo esc_attr( $warranty_alt ); ?>" width="<?php echo esc_attr( $warranty_width ); ?>" height="<?php echo esc_attr( $warranty_height ); ?>">
									</div>
									<?php endif; ?>

								</div>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
					<?php endif; ?>

				</div>
			</div>
		</section>
		<!-- Service Products End -->

		<div class="section-separator reverse bg-white"><span class="section-separator-inner bg-dark"></span></div>
		<?php endif; ?>

		<?php get_template_part( 'template-pages/common', 'portfolio-section' ); ?>
		<div class="section-separator bg-white"><span class="section-separator-inner bg-orange-100"></span></div>
		<?php get_template_part( 'template-pages/common', 'service-area-section' ); ?>
	</main><!-- #main -->
</div><!-- #primary -->
<?php
get_footer();