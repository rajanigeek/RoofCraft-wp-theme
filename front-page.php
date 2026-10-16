<?php
get_header();

// Call button uses the phone saved in options.
$pr_phone_number = get_field( 'pr_phone_number', 'option' );
$phone_number     = preg_replace( '/[^0-9+]/', '', $pr_phone_number );
$pr_phone_number = $phone_number;
$phone_url       = ! empty( $pr_phone_number['url'] ) ? $pr_phone_number['url'] : '';
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">

		<?php
		// Home banner. Video if we have one, otherwise the image.

		$banner_title    = get_field( 'home_banner_title' );
		$home_banner_sub_title    = get_field( 'home_banner_sub_title' );
		$banner_content  = get_field( 'home_banner_content' );
		$banner_video    = get_field( 'banner_video_link' );
		$banner_btn      = get_field( 'home_banner_btn_text' );
		$banner_sec_btn  = get_field( 'home_banner_secondary_btn_text' );
		$banner_sec_type = (int) get_field( 'home_banner_secondary_link_type' );
		$banner_sec_page = get_field( 'home_banner_secondary_page_link' );
		$banner_sec_link = get_field( 'home_banner_secondary_link' );
		$banner_sec_link = is_array( $banner_sec_link ) ? $banner_sec_link : array();
		$banner_image    = get_field( 'home_banner_image' );
		$banner_image    = is_array( $banner_image ) ? $banner_image : array();
		

		$banner_image_url    = ! empty( $banner_image['url'] ) ? $banner_image['url'] : '';
		$banner_image_alt    = ! empty( $banner_image['alt'] ) ? $banner_image['alt'] : $banner_title;
		$banner_image_title  = ! empty( $banner_image['title'] ) ? $banner_image['title'] : $banner_title;
		$banner_image_width  = ! empty( $banner_image['width'] ) ? $banner_image['width'] : 1920;
		$banner_image_height = ! empty( $banner_image['height'] ) ? $banner_image['height'] : 1080;
		$banner_video_title  = ! empty( $banner_title ) ? $banner_title : 'Banner video';

		$banner_sec_page   = is_array( $banner_sec_page ) ? reset( $banner_sec_page ) : $banner_sec_page;
		$banner_sec_url    = $banner_sec_type ? ( $banner_sec_link['url'] ?? '' ) : $banner_sec_page;
		$banner_sec_target = $banner_sec_type ? ( $banner_sec_link['target'] ?? '' ) : '';

		$has_banner_phone   = ! empty( $banner_btn ) && ! empty( $phone_url );
		$has_banner_sec     = ! empty( $banner_sec_btn ) && ! empty( $banner_sec_url );
		$has_banner_actions = $has_banner_phone || $has_banner_sec;

		$has_banner = ( $banner_title || $banner_content || $banner_video || $banner_image_url || $has_banner_actions );

		if ( $has_banner ) :
			?>
			<section class="main-banner hero white-text">

				<?php if ( ! empty( $banner_video ) ) : ?>
					<div class="banner-video">
						<iframe src="<?php echo esc_url( $banner_video ); ?>" title="<?php echo esc_attr( $banner_video_title ); ?>" width="1920" height="1080" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
					</div>
				<?php elseif ( ! empty( $banner_image_url ) ) : ?>
					<div class="banner-video">
						<img src="<?php echo esc_url( $banner_image_url ); ?>" alt="<?php echo esc_attr( $banner_image_alt ); ?>" title="<?php echo esc_attr( $banner_image_title ); ?>" width="<?php echo esc_attr( $banner_image_width ); ?>" height="<?php echo esc_attr( $banner_image_height ); ?>">
					</div>
				<?php endif; ?>

				<div class="container">
					<div class="hero-content">
						<div class="hero-title-group">
							<?php if ( ! empty( $home_banner_sub_title ) ) : ?>
							<div class="section-head-eyebrow text-xs wow fadeup-animation" data-wow-delay="0.2s">
								<p><?php echo esc_html( $home_banner_sub_title ); ?></p>
							</div>
							<?php endif; ?>
							<?php if ( ! empty( $banner_title ) ) : ?>
								<h1 class="h1-title wow fadeup-animation" data-wow-delay="0.4s"><?php echo esc_html( $banner_title ); ?></h1>
							<?php endif; ?>
						</div>

						<?php if ( ! empty( $banner_content ) ) : ?>
							<div class="hero-desc text-l wow fadeup-animation" data-wow-delay="0.6s">
								<?php echo wp_kses_post( $banner_content ); ?>
							</div>
						<?php endif; ?>
						<?php if ( $has_banner_actions ) : ?>
							<div class="hero-actions wow fadeup-animation" data-wow-delay="0.8s">
								<?php
									$pr_phone_number = get_field( 'pr_phone_number', 'option' );
									$phone_number     = preg_replace( '/[^0-9+]/', '', $pr_phone_number );
									?>

									<?php if ( ! empty( $phone_number ) ) : ?>
										<a class="sec-btn" href="tel:<?php echo esc_attr( $phone_number ); ?>">
											<?php echo esc_html( $banner_btn ); ?>
										</a>
								<?php endif; ?>
								<?php if ( $has_banner_sec ) : ?>
									<a class="sec-btn white-btn" href="<?php echo esc_url( $banner_sec_url ); ?>" title="<?php echo esc_attr( $banner_sec_btn ); ?>"<?php echo ! empty( $banner_sec_target ) ? ' target="' . esc_attr( $banner_sec_target ) . '" rel="noopener noreferrer"' : ''; ?>><?php echo esc_html( $banner_sec_btn ); ?></a>
								<?php endif; ?>
							</div>
						<?php endif; ?>
					</div>
				</div>

				<div class="section-separator"><span class="section-separator-inner bg-white"></span></div>
			</section>
		<?php endif; ?>

		<?php get_template_part( 'template-pages/common', 'service-section' ); ?>

		<div class="section-separator bg-white"><span class="section-separator-inner bg-orange-100"></span></div>

		<?php
		// About us.

		$about_sub     = get_field( 'home_about_us_sub_title' );
		$about_title   = get_field( 'home_about_us_title' );
		$about_content = get_field( 'home_about_us_content' );
		$about_btn     = get_field( 'home_about_us_btn_text' );
		$about_type    = (int) get_field( 'home_about_us_link_type' );
		$about_page    = get_field( 'home_about_us_page_link' );
		$about_link    = get_field( 'home_about_us_link' );
		$about_link    = is_array( $about_link ) ? $about_link : array();
		$about_image   = get_field( 'home_about_us_image' );
		$about_image_2 = get_field( 'home_about_us_additional_image' );
		$home_about_us_sub_content = get_field( 'home_about_us_sub_content' );

		$about_image_url   = is_array( $about_image ) ? ( $about_image['url'] ?? '' ) : (string) $about_image;
		$about_image_2_url = is_array( $about_image_2 ) ? ( $about_image_2['url'] ?? '' ) : (string) $about_image_2;
		$about_image_alt   = ! empty( $about_title ) ? $about_title : '';

		$about_page   = is_array( $about_page ) ? reset( $about_page ) : $about_page;
		$about_url    = $about_type ? ( $about_link['url'] ?? '' ) : $about_page;
		$about_target = $about_type ? ( $about_link['target'] ?? '' ) : '';

		$has_about_btn   = ! empty( $about_btn ) && ! empty( $about_url );
		$has_about_media = ! empty( $about_image_url ) || ! empty( $about_image_2_url );

		$has_about = ( $about_sub || $about_title || $about_content || $has_about_media || $has_about_btn );

		if ( $has_about ) :
			?>
			<section class="about">
				<div class="container container-lg">
					<div class="about-top">
						<div class="about-content">
							<div class="section-head about-head">
								<div class="section-head-title-group">

									<?php if ( ! empty( $about_sub ) ) : ?>
										<div class="section-head-eyebrow text-xs wow fadeup-animation" data-wow-delay="0.2s">
											<p><?php echo esc_html( $about_sub ); ?></p>
										</div>
									<?php endif; ?>
									<?php if ( ! empty( $about_title ) ) : ?>
										<h2 class="h2-title section-head-title mb-0 wow fadeup-animation" data-wow-delay="0.4s"><?php echo esc_html( $about_title ); ?></h2>
									<?php endif; ?>
								</div>
							</div>
							<div class="about-intro text-l wow fadeup-animation" data-wow-delay="0.6s">
							<?php echo $home_about_us_sub_content ?>
							</div>

							<?php if ( $has_about_btn ) : ?>
								<div class="about-actions wow fadeup-animation" data-wow-delay="0.8s">
									<a class="sec-btn dark-outline-btn" href="<?php echo esc_url( $about_url ); ?>" title="<?php echo esc_attr( $about_btn ); ?>"<?php echo ! empty( $about_target ) ? ' target="' . esc_attr( $about_target ) . '" rel="noopener noreferrer"' : ''; ?>><?php echo esc_html( $about_btn ); ?></a>
								</div>
							<?php endif; ?>
						</div>

						<?php if ( ! empty( $about_content ) ) : ?>
							<div class="about-copy wow fadeup-animation" data-wow-delay="0.2s">
								<?php echo wp_kses_post( $about_content ); ?>
							</div>
						<?php endif; ?>
					</div>

					<?php if ( $has_about_media ) : ?>
						<div class="about-media">
							<?php if ( ! empty( $about_image_url ) ) : ?>
								<div class="about-media-main wow left-animation" data-wow-delay="0.2s">
									<img src="<?php echo esc_url( $about_image_url ); ?>" alt="<?php echo esc_attr( $about_image_alt ); ?>" title="<?php echo esc_attr( $about_image_alt ); ?>" width="934" height="536">
								</div>
							<?php endif; ?>
							<?php if ( ! empty( $about_image_2_url ) ) : ?>
								<div class="about-media-secondary wow right-animation" data-wow-delay="0.2s">
									<img src="<?php echo esc_url( $about_image_2_url ); ?>" alt="<?php echo esc_attr( $about_image_alt ); ?>" title="<?php echo esc_attr( $about_image_alt ); ?>" width="434" height="536">
								</div>
							<?php endif; ?>
						</div>
					<?php endif; ?>
				</div>
			</section>
		<?php endif; ?>

		<div class="section-separator bg-orange-100"><span class="section-separator-inner bg-white"></span></div>

		<?php
		// Why choose us cards.

		$why_title   = get_field( 'home_why_choose_us_title' );
		$why_content = get_field( 'home_why_choose_us_content' );
		$why_details = get_field( 'home_why_choose_us_details' );
		$why_details = is_array( $why_details ) ? $why_details : array();

		$has_why = ( $why_title || $why_content || $why_details );

		if ( $has_why ) :
			?>
			<section class="why-us">
				<div class="container">
					<div class="section-head why-us-head text-center">
						<div class="section-head-title-group">
							<?php if ( ! empty( $why_title ) ) : ?>
								<h2 class="h2-title section-head-title mb-0 wow fadeup-animation" data-wow-delay="0.2s"><?php echo esc_html( $why_title ); ?></h2>
							<?php endif; ?>
						</div>

						<?php if ( ! empty( $why_content ) ) : ?>
							<div class="section-head-desc text-l wow fadeup-animation" data-wow-delay="0.4s">
								<?php echo wp_kses_post( $why_content ); ?>
							</div>
						<?php endif; ?>
					</div>

					<?php if ( ! empty( $why_details ) ) : ?>
						<div class="row why-us-cards">
							<?php
							foreach ( $why_details as $why_item ) :

								if ( ! is_array( $why_item ) ) {
									continue;
								}

								$why_icon       = $why_item['icon'] ?? '';
								$why_icon       = is_array( $why_icon ) ? ( $why_icon['url'] ?? '' ) : (string) $why_icon;
								$why_item_title = $why_item['title'] ?? '';
								$why_item_text  = $why_item['content'] ?? '';

								if ( empty( $why_icon ) && empty( $why_item_title ) && empty( $why_item_text ) ) {
									continue;
								}
								?>
								<div class="col-sm-6 col-lg-4">
									<div class="why-us-card wow fadeup-animation" data-wow-delay="0.2s">

										<?php if ( ! empty( $why_icon ) ) : ?>
											<div class="why-us-card-icon">
												<img src="<?php echo esc_url( $why_icon ); ?>" alt="<?php echo esc_attr( $why_item_title ); ?>" title="<?php echo esc_attr( $why_item_title ); ?>" width="70" height="70">
											</div>
										<?php endif; ?>

										<div class="why-us-card-content">
											<?php if ( ! empty( $why_item_title ) ) : ?>
												<h3 class="h5-title mb-0"><?php echo esc_html( $why_item_title ); ?></h3>
											<?php endif; ?>

											<?php if ( ! empty( $why_item_text ) ) : ?>
												<div class="why-us-card-text">
													<?php echo wp_kses_post( $why_item_text ); ?>
												</div>
											<?php endif; ?>
										</div>

									</div>
								</div>
								<?php
							endforeach;
							?>
						</div>
					<?php endif; ?>
				</div>
			</section>
		<?php endif; ?>

		<div class="section-separator bg-white"><span class="section-separator-inner bg-dark"></span></div>

		<?php
		// Warranties. A row is either a photo or a text card.

		$war_sub   = get_field( 'warranties_sub_title' );
		$war_title = get_field( 'warranties_title' );
		$war_desc  = get_field( 'warranties_description' );
		$war_rows  = get_field( 'roofing' );
		$war_rows  = is_array( $war_rows ) ? $war_rows : array();

		$has_war_head = ( $war_sub || $war_title || $war_desc );

		$has_war = ( $has_war_head || $war_rows );

		if ( $has_war ) :
			?>
			<section class="warranties">
				<div class="container container-lg">
					<div class="row warranties-cards">

						<?php if ( $has_war_head ) : ?>
							<div class="col-md-6 col-lg-4 align-self-center">
								<div class="section-head warranties-head white-text">
									<div class="section-head-title-group">

										<?php if ( ! empty( $war_sub ) ) : ?>
											<div class="section-head-eyebrow text-xs wow fadeup-animation" data-wow-delay="0.2s">
												<p><?php echo esc_html( $war_sub ); ?></p>
											</div>
										<?php endif; ?>

										<?php if ( ! empty( $war_title ) ) : ?>
											<h2 class="h2-title section-head-title mb-0 wow fadeup-animation" data-wow-delay="0.4s"><?php echo esc_html( $war_title ); ?></h2>
										<?php endif; ?>

									</div>

									<?php if ( ! empty( $war_desc ) ) : ?>
										<div class="section-head-desc text-l wow fadeup-animation" data-wow-delay="0.6s">
											<?php echo wp_kses_post( $war_desc ); ?>
										</div>
									<?php endif; ?>
								</div>
							</div>
						<?php endif; ?>

						<?php
						foreach ( $war_rows as $war_item ) :

							if ( ! is_array( $war_item ) ) {
								continue;
							}

							$war_flag = $war_item['has_image'] ?? '';
							$war_flag = is_array( $war_flag ) ? ( $war_flag['value'] ?? '' ) : $war_flag;
							$is_media = ( 'Yes' === $war_flag );

							$war_img        = $war_item['warranties_image'] ?? null;
							$war_img        = is_array( $war_img ) ? $war_img : array();
							$war_img_url    = $war_img['url'] ?? '';
							$war_img_alt    = ! empty( $war_img['alt'] ) ? $war_img['alt'] : $war_title;
							$war_img_title  = ! empty( $war_img['title'] ) ? $war_img['title'] : $war_title;
							$war_img_width  = ! empty( $war_img['width'] ) ? $war_img['width'] : 448;
							$war_img_height = ! empty( $war_img['height'] ) ? $war_img['height'] : 380;

							$card_title = $war_item['card_title'] ?? '';
							$card_years = $war_item['card_years'] ?? '';
							$card_desc  = $war_item['card_description'] ?? '';

							$can_render = $is_media ? ! empty( $war_img_url ) : ( $card_title || $card_years || $card_desc );

							if ( ! $can_render ) {
								continue;
							}

							if ( $is_media ) :
								?>
								<div class="col-md-6 col-lg-4 warranties-card-media">
									<div class="warranties-card-image wow fadeup-animation" data-wow-delay="0.2s">
										<img src="<?php echo esc_url( $war_img_url ); ?>" alt="<?php echo esc_attr( $war_img_alt ); ?>" title="<?php echo esc_attr( $war_img_title ); ?>" width="<?php echo esc_attr( $war_img_width ); ?>" height="<?php echo esc_attr( $war_img_height ); ?>">
									</div>
								</div>
							<?php else : ?>
								<div class="col-md-6 col-lg-4">
									<div class="warranties-card wow fadeup-animation" data-wow-delay="0.2s">

										<?php if ( ! empty( $card_title ) ) : ?>
											<div class="warranties-card-title">
												<h3 class="h5-title mb-0"><?php echo $card_title; ?></h3>
											</div>
										<?php endif; ?>

										<div class="warranties-card-info">
											<?php if ( ! empty( $card_years ) ) : ?>
												<div class="warranties-card-stat">
													<h4 class="h1-title mb-0"><?php echo  $card_years; ?></h4>
												</div>
											<?php endif; ?>

											<?php if ( ! empty( $card_desc ) ) : ?>
												<div class="warranties-card-text">
													<?php echo wp_kses_post( $card_desc ); ?>
												</div>
											<?php endif; ?>
										</div>

									</div>
								</div>
								<?php
							endif;
						endforeach;
						?>
					</div>
				</div>
			</section>
		<?php endif; ?>

		<?php get_template_part( 'template-pages/common', 'testimonials-section' ); ?>
		

		<div class="section-separator reverse bg-white for-des"><span class="section-separator-inner bg-dark"></span></div>

		<?php get_template_part( 'template-pages/common', 'portfolio-section' ); ?>

		<div class="section-separator bg-white"><span class="section-separator-inner bg-orange-100"></span></div>

		<?php get_template_part( 'template-pages/common', 'service-area-section' ); ?>

		<?php get_template_part( 'template-pages/common', 'faq-section' ); ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();