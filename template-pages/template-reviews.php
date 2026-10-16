<?php /* Template Name: Reviews */
get_header();

// Share box above the list.
$share_icon    = get_field( 'review_share_icon' );
$share_title   = get_field( 'review_share_title' );
$share_content = get_field( 'review_share_content' );
$share_btn     = get_field( 'review_share_btn_text' );
$share_type    = (int) get_field( 'review_share_link_type' );
$share_page    = get_field( 'review_share_page_link' );
$share_link    = get_field( 'review_share_link' );
$share_link    = is_array( $share_link ) ? $share_link : array();

$share_icon    = is_array( $share_icon ) ? ( $share_icon['url'] ?? '' ) : (string) $share_icon;
$share_page    = is_array( $share_page ) ? reset( $share_page ) : $share_page;
$share_url     = $share_type ? ( $share_link['url'] ?? '' ) : $share_page;
$share_target  = $share_type ? ( $share_link['target'] ?? '' ) : '';
$has_share_btn = ! empty( $share_btn ) && ! empty( $share_url );
$has_share     = ( $share_icon || $share_title || $share_content || $has_share_btn );

// Review cards. Eight at a time, rest load on the button.
$reviews_title = get_field( 'review_testimonials_title' );
$reviews_query = roofcraft_reviews_query( 1 );
$has_reviews   = ( $reviews_title || $reviews_query->have_posts() );
?>
<div id="primary" class="content-area">
	<main id="main" class="site-main">
		<?php get_template_part( 'template-pages/common', 'inner-banner-section' ); ?>

		<?php if ( $has_share ) : ?>
			<!-- Reviews CTA Start -->
			<section class="reviews-cta">
				<div class="container">
					<div class="reviews-cta-box wow fadeup-animation" data-wow-delay="0.2s">
						<?php if ( ! empty( $share_icon ) ) : ?>
							<span class="sec-btn reviews-cta-btn">
								<img src="<?php echo esc_url( $share_icon ); ?>" alt="<?php echo esc_attr( $share_title ); ?>" title="<?php echo esc_attr( $share_title ); ?>" width="85" height="85">
							</span>
						<?php endif; ?>
						<div class="reviews-cta-inner cliping-wp white-text">
							<div class="row reviews-cta-row">
								<?php if ( ! empty( $share_title ) || ! empty( $share_content ) ) : ?>
									<div class="col-lg-8">
										<div class="section-head reviews-cta-head">
											<?php if ( ! empty( $share_title ) ) : ?>
												<h2 class="h2-title section-head-title mb-0"><?php echo esc_html( $share_title ); ?></h2>
											<?php endif; ?>
											<?php if ( ! empty( $share_content ) ) : ?>
												<div class="section-head-desc text-l">
													<?php echo wp_kses_post( $share_content ); ?>
												</div>
											<?php endif; ?>
										</div>
									</div>
								<?php endif; ?>
								<?php if ( $has_share_btn ) : ?>
									<div class="col-lg-4">
										<div class="reviews-cta-action">
											<a class="sec-btn white-btn" href="<?php echo esc_url( $share_url ); ?>" title="<?php echo esc_attr( $share_btn ); ?>"<?php echo ! empty( $share_target ) ? ' target="' . esc_attr( $share_target ) . '" rel="noopener noreferrer"' : ''; ?>><?php echo esc_html( $share_btn ); ?></a>
										</div>
									</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- Reviews CTA End -->
		<?php endif; ?>

		<?php if ( $has_reviews ) : ?>
			<!-- Reviews Start -->
			<section class="reviews">
				<div class="container">
					<?php if ( ! empty( $reviews_title ) ) : ?>
						<div class="section-head reviews-head text-center wow fadeup-animation" data-wow-delay="0.2s">
							<h2 class="h3-title section-head-title mb-0"><?php echo esc_html( $reviews_title ); ?></h2>
						</div>
					<?php endif; ?>
					<?php if ( $reviews_query->have_posts() ) : ?>
						<div class="reviews-list" data-page="1">
							<?php
							while ( $reviews_query->have_posts() ) :
								$reviews_query->the_post();
								echo roofcraft_reviews_card_html(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							endwhile;
							?>
						</div>
						<?php if ( (int) $reviews_query->max_num_pages > 1 ) : ?>
							<div class="reviews-more wow fadeup-animation" data-wow-delay="0.2s">
								<button type="button" class="sec-btn dark-outline-btn js-reviews-load-more" aria-label="Load More">Load More</button>
							</div>
						<?php endif; ?>
					<?php endif; ?>
				</div>
			</section>
			<!-- Reviews End -->
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>

		<div class="section-separator bg-white"><span class="section-separator-inner bg-orange-100"></span></div>
	</main><!-- #main -->
</div><!-- #primary -->
<?php
get_footer();
?>
