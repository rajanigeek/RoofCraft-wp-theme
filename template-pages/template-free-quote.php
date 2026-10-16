<?php /* Template Name: Free Quote */
get_header();

$quote_page_id = get_queried_object_id();

// Quote banner and the estimate form.

$quote_banner_title        = get_field( 'quote_banner_title', $quote_page_id );
$quote_banner_sub_title    = get_field( 'quote_banner_sub_title', $quote_page_id );
$quote_banner_description  = get_field( 'quote_banner_description', $quote_page_id );
$quote_banner_video        = get_field( 'quote_banner_video', $quote_page_id );
$quote_banner_form_title   = get_field( 'quote_banner_form_title', $quote_page_id );
$quote_banner_contact_form = get_field( 'quote_banner_contact_form', $quote_page_id );

$quote_form_id    = 0;
$quote_form_title = '';
if ( is_object( $quote_banner_contact_form ) && ! empty( $quote_banner_contact_form->ID ) ) {
	$quote_form_id    = (int) $quote_banner_contact_form->ID;
	$quote_form_title = ! empty( $quote_banner_contact_form->post_title ) ? $quote_banner_contact_form->post_title : '';
} elseif ( is_numeric( $quote_banner_contact_form ) ) {
	$quote_form_id = (int) $quote_banner_contact_form;
}

$has_banner_head = ! empty( $quote_banner_sub_title ) || ! empty( $quote_banner_title ) || ! empty( $quote_banner_description );
$has_banner_form = $quote_form_id > 0;

// Logos under the form, and the button beside them.

$trust_images = get_field( 'quote_trust_images', $quote_page_id );
$trust_images = is_array( $trust_images ) ? $trust_images : array();

$trust_btn_text  = get_field( 'quote_trust_btn_text', $quote_page_id );
$trust_link_type = (int) get_field( 'quote_trust_link_type', $quote_page_id );
$trust_page_link = get_field( 'quote_trust_page_link', $quote_page_id );
$trust_custom    = get_field( 'quote_trust_link', $quote_page_id );
$trust_custom    = is_array( $trust_custom ) ? $trust_custom : array();
$trust_page_link = is_array( $trust_page_link ) ? reset( $trust_page_link ) : $trust_page_link;
$trust_url       = $trust_link_type ? ( $trust_custom['url'] ?? '' ) : ( is_string( $trust_page_link ) ? $trust_page_link : '' );
$trust_target    = $trust_link_type ? ( $trust_custom['target'] ?? '' ) : '';
$has_trust_btn   = ! empty( $trust_btn_text ) && ! empty( $trust_url );

// Why choose us.

$why_title   = get_field( 'quote_why_choose_us_title', $quote_page_id );
$why_content = get_field( 'quote_why_choose_us_content', $quote_page_id );
$why_details = get_field( 'quote_why_choose_us_details', $quote_page_id );
$why_details = is_array( $why_details ) ? $why_details : array();

$why_btn_text  = get_field( 'quote_why_choose_us_btn_text', $quote_page_id );
$why_link_type = (int) get_field( 'quote_why_choose_us_link_type', $quote_page_id );
$why_page_link = get_field( 'quote_why_choose_us_page_link', $quote_page_id );
$why_custom    = get_field( 'quote_why_choose_us_link', $quote_page_id );
$why_custom    = is_array( $why_custom ) ? $why_custom : array();
$why_page_link = is_array( $why_page_link ) ? reset( $why_page_link ) : $why_page_link;
$why_url       = $why_link_type ? ( $why_custom['url'] ?? '' ) : ( is_string( $why_page_link ) ? $why_page_link : '' );
$why_target    = $why_link_type ? ( $why_custom['target'] ?? '' ) : '';
$has_why_btn   = ! empty( $why_btn_text ) && ! empty( $why_url );

$has_why = ! empty( $why_title ) || ! empty( $why_content ) || ! empty( $why_details ) || $has_why_btn;

// Do and don't columns, plus the two buttons.

$rw_sub_title = get_field( 'quote_right_way_sub_title', $quote_page_id );
$rw_title     = get_field( 'quote_right_way_title', $quote_page_id );
$rw_content   = get_field( 'quote_right_way_content', $quote_page_id );

$rw_dont_title   = get_field( 'quote_right_way_dont_title', $quote_page_id );
$rw_dont_details = get_field( 'quote_right_way_dont_details', $quote_page_id );
$rw_dont_details = is_array( $rw_dont_details ) ? $rw_dont_details : array();

$rw_choose_title   = get_field( 'quote_right_way_choose_title', $quote_page_id );
$rw_choose_details = get_field( 'quote_right_way_choose_details', $quote_page_id );
$rw_choose_details = is_array( $rw_choose_details ) ? $rw_choose_details : array();

$rw_columns = array(
	array(
		'modifier' => 'is-dont',
		'icon'     => 'lucide:slash',
		'mark'     => 'fluent-emoji-high-contrast:cross-mark',
		'title'    => $rw_dont_title,
		'items'    => $rw_dont_details,
	),
	array(
		'modifier' => 'is-do',
		'icon'     => 'lucide:check',
		'mark'     => 'fluent-emoji-high-contrast:check-mark',
		'title'    => $rw_choose_title,
		'items'    => $rw_choose_details,
	),
);

$rw_btn_text  = get_field( 'quote_right_way_btn_text', $quote_page_id );
$rw_link_type = (int) get_field( 'quote_right_way_link_type', $quote_page_id );
$rw_page_link = get_field( 'quote_right_way_page_link', $quote_page_id );
$rw_custom    = get_field( 'quote_right_way_link', $quote_page_id );
$rw_custom    = is_array( $rw_custom ) ? $rw_custom : array();
$rw_page_link = is_array( $rw_page_link ) ? reset( $rw_page_link ) : $rw_page_link;
$rw_url       = $rw_link_type ? ( $rw_custom['url'] ?? '' ) : ( is_string( $rw_page_link ) ? $rw_page_link : '' );
$rw_target    = $rw_link_type ? ( $rw_custom['target'] ?? '' ) : '';
$has_rw_btn   = ! empty( $rw_btn_text ) && ! empty( $rw_url );

$rw_sec_btn_text  = get_field( 'quote_right_way_secondary_btn_text', $quote_page_id );
$rw_sec_link_type = (int) get_field( 'quote_right_way_secondary_link_type', $quote_page_id );
$rw_sec_page_link = get_field( 'quote_right_way_secondary_page_link', $quote_page_id );
$rw_sec_custom    = get_field( 'quote_right_way_secondary_link', $quote_page_id );
$rw_sec_custom    = is_array( $rw_sec_custom ) ? $rw_sec_custom : array();
$rw_sec_page_link = is_array( $rw_sec_page_link ) ? reset( $rw_sec_page_link ) : $rw_sec_page_link;
$rw_sec_url       = $rw_sec_link_type ? ( $rw_sec_custom['url'] ?? '' ) : ( is_string( $rw_sec_page_link ) ? $rw_sec_page_link : '' );
$rw_sec_target    = $rw_sec_link_type ? ( $rw_sec_custom['target'] ?? '' ) : '';
$has_rw_sec_btn   = ! empty( $rw_sec_btn_text ) && ! empty( $rw_sec_url );

$has_rw_head    = ! empty( $rw_sub_title ) || ! empty( $rw_title ) || ! empty( $rw_content );
$has_rw_columns = ! empty( $rw_dont_title ) || ! empty( $rw_dont_details ) || ! empty( $rw_choose_title ) || ! empty( $rw_choose_details );
$has_rw_actions = $has_rw_btn || $has_rw_sec_btn;
$has_right_way  = $has_rw_head || $has_rw_columns || $has_rw_actions;
?>
<div id="primary" class="content-area">
	<main id="main" class="site-main">
        <!-- Hero Section Start -->
		<section class="main-banner hero white-text quote-hero">
			<div class="banner-video">
				<iframe src="<?php echo esc_url( ! empty( $quote_banner_video ) ? $quote_banner_video : 'https://player.vimeo.com/video/1219800827?background=1&amp;autoplay=1&amp;muted=1&amp;loop=1&amp;autopause=0&amp;playsinline=1' ); ?>" title="<?php echo esc_attr( ! empty( $quote_banner_title ) ? $quote_banner_title : 'Get Your Free Estimate Today' ); ?>" width="1920" height="1080" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
			</div>
			<div class="container">
				<div class="hero-content">
					<?php if ( $has_banner_head ) : ?>
					<div class="hero-title-group">
						<?php if ( ! empty( $quote_banner_sub_title ) ) : ?>
						<div class="section-head-eyebrow text-xs wow fadeup-animation" data-wow-delay="0.2s">
							<p><?php echo esc_html( $quote_banner_sub_title ); ?></p>
						</div>
						<?php endif; ?>
						<?php if ( ! empty( $quote_banner_title ) ) : ?>
						<h1 class="h1-title mb-0 wow fadeup-animation" data-wow-delay="0.2s"><?php echo esc_html( $quote_banner_title ); ?></h1>
						<?php endif; ?>
						<?php if ( ! empty( $quote_banner_description ) ) : ?>
						<div class="hero-desc text-l mb-0 wow fadeup-animation" data-wow-delay="0.2s">
							<?php echo wp_kses_post( $quote_banner_description ); ?>
						</div>
						<?php endif; ?>
					</div>
					<?php endif; ?>
					<?php if ( $has_banner_form ) : ?>
					<div class="form-wp wow fadeup-animation" data-wow-delay="0.2s">
						<?php if ( ! empty( $quote_banner_form_title ) ) : ?>
						<h2 class="h4-title mb-0"><?php echo esc_html( $quote_banner_form_title ); ?></h2>
						<?php endif; ?>
						<?php echo do_shortcode( '[contact-form-7 id="' . esc_attr( $quote_form_id ) . '"' . ( $quote_form_title ? ' title="' . esc_attr( $quote_form_title ) . '"' : '' ) . ']' ); ?>
					</div>
					<?php endif; ?>
				</div>
			</div>
			<div class="section-separator"><span class="section-separator-inner bg-white"></span></div>
		</section>
		<!-- Hero Section End -->

		<!-- Quote Reviews Start -->
		<section class="quote-reviews">
			<div class="container">
				<div class="quote-reviews-bar wow fadeup-animation" data-wow-delay="0.2s">
					<h2 class="h4-title mb-0 quote-reviews-name">Eclipse Roofing LLC</h2>
					<div class="quote-reviews-rating">
						<div class="quote-reviews-stars" aria-hidden="true">
							<iconify-icon icon="mdi:star"></iconify-icon>
							<iconify-icon icon="mdi:star"></iconify-icon>
							<iconify-icon icon="mdi:star"></iconify-icon>
							<iconify-icon icon="mdi:star"></iconify-icon>
							<iconify-icon icon="mdi:star"></iconify-icon>
						</div>
						<div class="quote-reviews-label">
							<p>5 Star reviews</p>
						</div>
					</div>
					<?php if ( ! empty( $trust_images ) ) : ?>
					<div class="quote-reviews-seal">
						<?php
						foreach ( $trust_images as $trust_image_url ) :
							if ( empty( $trust_image_url ) ) {
								continue;
							}
							?>
						<img src="<?php echo esc_url( $trust_image_url ); ?>" alt="BBB Accredited Business" title="BBB Accredited Business" width="180" height="63">
						<?php endforeach; ?>
					</div>
					<?php endif; ?>
				</div>
				<?php if ( $has_trust_btn ) : ?>
				<div class="quote-reviews-actions wow fadeup-animation" data-wow-delay="0.2s">
					<a class="sec-btn" href="<?php echo esc_url( $trust_url ); ?>" title="<?php echo esc_attr( $trust_btn_text ); ?>"<?php echo ! empty( $trust_target ) ? ' target="' . esc_attr( $trust_target ) . '" rel="noopener noreferrer"' : ''; ?>><?php echo esc_html( $trust_btn_text ); ?></a>
				</div>
				<?php endif; ?>
			</div>
		</section>
		<!-- Quote Reviews End -->

		<div class="section-separator bg-white"><span class="section-separator-inner bg-orange-100"></span></div>

		<?php if ( $has_why ) : ?>
        <!-- Why Us Start -->
		<section class="why-us bg-orange-100 quote-why-us">
			<div class="container">
				<?php if ( ! empty( $why_title ) || ! empty( $why_content ) ) : ?>
				<div class="section-head why-us-head text-center">
					<?php if ( ! empty( $why_title ) ) : ?>
					<div class="section-head-title-group">
						<h2 class="h2-title section-head-title mb-0 wow fadeup-animation" data-wow-delay="0.2s"><?php echo esc_html( $why_title ); ?></h2>
					</div>
					<?php endif; ?>
					<?php if ( ! empty( $why_content ) ) : ?>
					<div class="section-head-desc text-l wow fadeup-animation" data-wow-delay="0.2s">
						<?php echo wp_kses_post( $why_content ); ?>
					</div>
					<?php endif; ?>
				</div>
				<?php endif; ?>
				<?php if ( ! empty( $why_details ) ) : ?>
				<div class="row why-us-cards">
					<?php
					foreach ( $why_details as $why_item ) :
						if ( ! is_array( $why_item ) ) {
							continue;
						}

						$why_icon       = $why_item['icon'] ?? '';
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
								<img src="<?php echo esc_url( $why_icon ); ?>" alt="<?php echo esc_attr( $why_item_title ); ?>" title="<?php echo esc_attr( $why_item_title ); ?>" width="40" height="40">
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
					<?php endforeach; ?>
				</div>
				<?php endif; ?>
				<?php if ( $has_why_btn ) : ?>
				<div class="quote-why-us-actions wow fadeup-animation" data-wow-delay="0.2s">
					<a class="sec-btn" href="<?php echo esc_url( $why_url ); ?>" title="<?php echo esc_attr( $why_btn_text ); ?>"<?php echo ! empty( $why_target ) ? ' target="' . esc_attr( $why_target ) . '" rel="noopener noreferrer"' : ''; ?>><?php echo esc_html( $why_btn_text ); ?></a>
				</div>
				<?php endif; ?>
			</div>
		</section>
		<!-- Why Us End -->

		<div class="section-separator bg-orange-100"><span class="section-separator-inner bg-alternate-white"></span></div>
		<?php endif; ?>

		<?php if ( $has_right_way ) : ?>
		<!-- Quote Approach Start -->
		<section class="quote-approach bg-alternate-white">
			<div class="container">
				<?php if ( $has_rw_head ) : ?>
				<div class="section-head quote-approach-head text-center">
					<div class="section-head-title-group">
						<?php if ( ! empty( $rw_sub_title ) ) : ?>
						<div class="section-head-eyebrow text-xs wow fadeup-animation" data-wow-delay="0.2s">
							<p><?php echo esc_html( $rw_sub_title ); ?></p>
						</div>
						<?php endif; ?>
						<?php if ( ! empty( $rw_title ) ) : ?>
						<h2 class="h2-title section-head-title mb-0 wow fadeup-animation" data-wow-delay="0.2s"><?php echo esc_html( $rw_title ); ?></h2>
						<?php endif; ?>
					</div>
					<?php if ( ! empty( $rw_content ) ) : ?>
					<div class="section-head-desc text-l wow fadeup-animation" data-wow-delay="0.2s">
						<?php echo wp_kses_post( $rw_content ); ?>
					</div>
					<?php endif; ?>
				</div>
				<?php endif; ?>
				<?php if ( $has_rw_columns ) : ?>
				<div class="row quote-approach-cols">
					<?php
					foreach ( $rw_columns as $column ) :
						if ( empty( $column['title'] ) && empty( $column['items'] ) ) {
							continue;
						}
						?>
					<div class="col-lg-6">
						<div class="quote-approach-card <?php echo esc_attr( $column['modifier'] ); ?> wow fadeup-animation" data-wow-delay="0.2s">
							<div class="quote-approach-card-head">
								<span class="quote-approach-card-icon">
									<iconify-icon icon="<?php echo esc_attr( $column['icon'] ); ?>"></iconify-icon>
								</span>
								<?php if ( ! empty( $column['title'] ) ) : ?>
								<h3 class="h4-title mb-0"><?php echo esc_html( $column['title'] ); ?></h3>
								<?php endif; ?>
							</div>
							<?php if ( ! empty( $column['items'] ) ) : ?>
							<ul class="quote-approach-list">
								<?php
								foreach ( $column['items'] as $row ) :
									$row_title = is_array( $row ) ? ( $row['title'] ?? '' ) : '';
									if ( empty( $row_title ) ) {
										continue;
									}
									?>
								<li>
									<span class="quote-approach-list-icon">
										<iconify-icon icon="<?php echo esc_attr( $column['mark'] ); ?>"></iconify-icon>
									</span>
									<?php echo esc_html( $row_title ); ?>
								</li>
								<?php endforeach; ?>
							</ul>
							<?php endif; ?>
						</div>
					</div>
					<?php endforeach; ?>
				</div>
				<?php endif; ?>
				<?php if ( $has_rw_actions ) : ?>
				<div class="quote-approach-actions wow fadeup-animation" data-wow-delay="0.2s">
					<?php if ( $has_rw_btn ) : ?>
					<a class="sec-btn" href="<?php echo esc_url( $rw_url ); ?>" title="<?php echo esc_attr( $rw_btn_text ); ?>"<?php echo ! empty( $rw_target ) ? ' target="' . esc_attr( $rw_target ) . '" rel="noopener noreferrer"' : ''; ?>><?php echo esc_html( $rw_btn_text ); ?></a>
					<?php endif; ?>
					<?php if ( $has_rw_sec_btn ) : ?>
					<a class="sec-btn dark-outline-btn" href="<?php echo esc_url( $rw_sec_url ); ?>" title="<?php echo esc_attr( $rw_sec_btn_text ); ?>"<?php echo ! empty( $rw_sec_target ) ? ' target="' . esc_attr( $rw_sec_target ) . '" rel="noopener noreferrer"' : ''; ?>><?php echo esc_html( $rw_sec_btn_text ); ?></a>
					<?php endif; ?>
				</div>
				<?php endif; ?>
			</div>
		</section>
		<!-- Quote Approach End -->
		<?php endif; ?>

        <div class="get-quote-testimonials">
            <?php get_template_part( 'template-pages/common', 'testimonials-section' ); ?>
        </div>
		<div class="section-separator reverse bg-white for-des"><span class="section-separator-inner bg-dark"></span></div>
        
        <?php get_template_part('template-pages/common','portfolio-section'); ?>
		<div class="section-separator bg-white"><span class="section-separator-inner bg-orange-100"></span></div>
	</main><!-- #main -->
</div><!-- #primary -->
<?php
get_footer();
?>
