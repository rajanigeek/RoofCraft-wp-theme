<?php /* Template Name: About Us */
get_header();

// Intro image and copy.
$intro_icon    = get_field( 'about_intro_icon' );
$intro_image   = get_field( 'about_intro_image' );
$intro_title   = get_field( 'about_intro_title' );
$intro_content = get_field( 'about_intro_content' );
$intro_icon    = is_string( $intro_icon ) ? $intro_icon : ( ( is_array( $intro_icon ) && ! empty( $intro_icon['url'] ) ) ? $intro_icon['url'] : '' );
$intro_image   = is_string( $intro_image ) ? $intro_image : ( ( is_array( $intro_image ) && ! empty( $intro_image['url'] ) ) ? $intro_image['url'] : '' );
$has_intro     = ! empty( $intro_icon ) || ! empty( $intro_image ) || ! empty( $intro_title ) || ! empty( $intro_content );

// Why trust us cards.
$why_title   = get_field( 'about_why_trust_title' );
$why_content = get_field( 'about_why_trust_content' );
$why_details = get_field( 'about_why_trust_details' );
$why_details = is_array( $why_details ) ? $why_details : array();
$has_why     = ! empty( $why_title ) || ! empty( $why_content ) || ! empty( $why_details );

// Process steps. Odd rows flip the image to the other side.
$process_rows = get_field( 'process' );
$process_rows = is_array( $process_rows ) ? $process_rows : array();
$has_process  = ! empty( $process_rows );
?>
<div id="primary" class="content-area">
	<main id="main" class="site-main">
		<?php get_template_part( 'template-pages/common', 'inner-banner-section' ); ?>

		<?php if ( $has_intro ) : ?>
			<!-- About Intro Start -->
			<section class="service-about about-intro">
				<div class="container container-lg">
					<div class="service-about-grid">
						<?php if ( ! empty( $intro_icon ) || ! empty( $intro_image ) ) : ?>
							<div class="service-about-aside wow left-animation" data-wow-delay="0.2s">
								<?php if ( ! empty( $intro_icon ) ) : ?>
									<span class="sec-btn service-about-btn">
										<img src="<?php echo esc_url( $intro_icon ); ?>" alt="<?php echo esc_attr( $intro_title ); ?>" title="<?php echo esc_attr( $intro_title ); ?>" width="85" height="85">
									</span>
								<?php endif; ?>
								<?php if ( ! empty( $intro_image ) ) : ?>
									<div class="service-about-aside-inner cliping-wp">
										<div class="service-about-aside-img">
											<img src="<?php echo esc_url( $intro_image ); ?>" alt="<?php echo esc_attr( $intro_title ); ?>" title="<?php echo esc_attr( $intro_title ); ?>" width="656" height="472">
										</div>
									</div>
								<?php endif; ?>
							</div>
						<?php endif; ?>
						<?php if ( ! empty( $intro_title ) || ! empty( $intro_content ) ) : ?>
							<div class="service-about-main">
								<div class="service-about-content wow fadeup-animation" data-wow-delay="0.2s">
									<?php if ( ! empty( $intro_title ) ) : ?>
										<h2 class="h2-title mb-0"><?php echo esc_html( $intro_title ); ?></h2>
									<?php endif; ?>
									<?php if ( ! empty( $intro_content ) ) : ?>
										<div class="service-about-copy">
											<?php echo wp_kses_post( $intro_content ); ?>
										</div>
									<?php endif; ?>
								</div>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</section>
			<!-- About Intro End -->
		<?php endif; ?>

		<?php if ( $has_intro && $has_why ) : ?>
			<div class="section-separator bg-white"><span class="section-separator-inner bg-orange-100"></span></div>
		<?php endif; ?>

		<?php if ( $has_why ) : ?>
			<!-- Why Us Start -->
			<section class="why-us bg-orange-100">
				<div class="container">
					<?php if ( ! empty( $why_title ) || ! empty( $why_content ) ) : ?>
						<div class="section-head why-us-head text-center">
							<?php if ( ! empty( $why_title ) ) : ?>
								<div class="section-head-title-group">
									<h2 class="h2-title section-head-title mb-0 wow fadeup-animation" data-wow-delay="0.2s"><?php echo esc_html( $why_title ); ?></h2>
								</div>
							<?php endif; ?>
							<?php if ( ! empty( $why_content ) ) : ?>
								<div class="section-head-desc text-l wow fadeup-animation" data-wow-delay="0.4s">
									<?php echo wp_kses_post( $why_content ); ?>
								</div>
							<?php endif; ?>
						</div>
					<?php endif; ?>
					<?php if ( ! empty( $why_details ) ) : ?>
						<div class="row why-us-cards">
							<?php
							foreach ( $why_details as $item ) :
								$item_icon  = ! empty( $item['icon'] ) ? $item['icon'] : '';
								$item_title = ! empty( $item['title'] ) ? $item['title'] : '';
								$item_text  = ! empty( $item['content'] ) ? $item['content'] : '';
								$item_icon  = is_string( $item_icon ) ? $item_icon : ( ( is_array( $item_icon ) && ! empty( $item_icon['url'] ) ) ? $item_icon['url'] : '' );
								if ( empty( $item_icon ) && empty( $item_title ) && empty( $item_text ) ) {
									continue;
								}
								?>
								<div class="col-sm-6 col-lg-3">
									<div class="why-us-card wow fadeup-animation" data-wow-delay="0.2s">
										<?php if ( ! empty( $item_icon ) ) : ?>
											<div class="why-us-card-icon">
												<img src="<?php echo esc_url( $item_icon ); ?>" alt="<?php echo esc_attr( $item_title ); ?>" title="<?php echo esc_attr( $item_title ); ?>" width="70" height="70">
											</div>
										<?php endif; ?>
										<?php if ( ! empty( $item_title ) || ! empty( $item_text ) ) : ?>
											<div class="why-us-card-content">
												<?php if ( ! empty( $item_title ) ) : ?>
													<h3 class="h5-title mb-0"><?php echo esc_html( $item_title ); ?></h3>
												<?php endif; ?>
												<?php if ( ! empty( $item_text ) ) : ?>
													<div class="why-us-card-text">
														<?php echo wp_kses_post( $item_text ); ?>
													</div>
												<?php endif; ?>
											</div>
										<?php endif; ?>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				</div>
			</section>
			<!-- Why Us End -->
		<?php endif; ?>

		<?php if ( $has_why && $has_process ) : ?>
			<div class="section-separator bg-orange-100"><span class="section-separator-inner bg-dark"></span></div>
		<?php endif; ?>

		<?php if ( $has_process ) : ?>
			<!-- Service Split Start -->
			<section class="service-split bg-dark white-text">
				<div class="container container-lg">
					<div class="service-split-list">
						<?php
						foreach ( $process_rows as $index => $item ) :
							$item_title   = ! empty( $item['about_process_title'] ) ? $item['about_process_title'] : '';
							$item_content = ! empty( $item['about_process_content'] ) ? $item['about_process_content'] : '';
							$item_image   = ! empty( $item['about_process_image'] ) ? $item['about_process_image'] : '';
							$item_image   = is_string( $item_image ) ? $item_image : ( ( is_array( $item_image ) && ! empty( $item_image['url'] ) ) ? $item_image['url'] : '' );
							if ( empty( $item_title ) && empty( $item_content ) && empty( $item_image ) ) {
								continue;
							}
							$is_reverse    = ( 1 === $index % 2 );
							$content_order = $is_reverse ? ' order-lg-2' : '';
							$media_order   = $is_reverse ? ' order-lg-1' : '';
							$media_wow     = $is_reverse ? 'left-animation' : 'right-animation';
							?>
							<div class="row service-split-row">
								<?php if ( ! empty( $item_title ) || ! empty( $item_content ) ) : ?>
									<div class="col-lg-6 align-self-center service-split-content-col<?php echo esc_attr( $content_order ); ?>">
										<div class="service-split-content wow fadeup-animation" data-wow-delay="0.2s">
											<?php if ( ! empty( $item_title ) ) : ?>
												<h2 class="h2-title mb-0"><?php echo esc_html( $item_title ); ?></h2>
											<?php endif; ?>
											<?php if ( ! empty( $item_content ) ) : ?>
												<div class="service-split-body">
													<?php echo wp_kses_post( $item_content ); ?>
												</div>
											<?php endif; ?>
										</div>
									</div>
								<?php endif; ?>
								<?php if ( ! empty( $item_image ) ) : ?>
									<div class="col-lg-6 service-split-media-col<?php echo esc_attr( $media_order ); ?>">
										<div class="service-split-media wow <?php echo esc_attr( $media_wow ); ?>" data-wow-delay="0.2s">
											<img src="<?php echo esc_url( $item_image ); ?>" alt="<?php echo esc_attr( $item_title ); ?>" title="<?php echo esc_attr( $item_title ); ?>" width="656" height="480">
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

		<?php if ( $has_process ) : ?>
			<div class="section-separator reverse bg-orange-100"><span class="section-separator-inner bg-dark"></span></div>
		<?php endif; ?>

		<div class="about-us-faq">
			<?php get_template_part( 'template-pages/common', 'faq-section' ); ?>
		</div>
	</main><!-- #main -->
</div><!-- #primary -->
<?php
get_footer();
?>
