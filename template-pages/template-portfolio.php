<?php /* Template Name: Portfolio */

get_header();

$page_id = get_queried_object_id();
if ( ! $page_id ) {
	$page_id = get_the_ID();
}

$terms = taxonomy_exists( 'project-categorie' )
	? get_terms(
		array(
			'taxonomy'   => 'project-categorie',
			'hide_empty' => true,
		)
	)
	: array();
$terms = ( is_array( $terms ) && ! is_wp_error( $terms ) ) ? $terms : array();

$per_page = 12;

// ?term= opens that tab. Otherwise we start on the first category.
$requested_term_id = isset( $_GET['term'] ) ? absint( $_GET['term'] ) : 0;
$active_term_id     = 0;
foreach ( $terms as $term ) {
	if ( $requested_term_id && (int) $term->term_id === $requested_term_id ) {
		$active_term_id = $requested_term_id;
		break;
	}
}
if ( ! $active_term_id && ! empty( $terms ) ) {
	$active_term_id = (int) $terms[0]->term_id;
}

$gallery_page = $active_term_id ? roofcraft_portfolio_gallery_page( $active_term_id, 1, $per_page ) : array( 'html' => '', 'has_more' => false );

// Extra copy under the gallery.
$archive_details = get_field( 'archive_details', $page_id );
$archive_details = is_array( $archive_details ) ? $archive_details : array();

$placeholder_image = get_field( 'placeholder_image', 'option' );
$placeholder_image = is_array( $placeholder_image ) ? ( $placeholder_image['url'] ?? '' ) : (string) $placeholder_image;
?>
<div id="primary" class="content-area">
	<main id="main" class="site-main">
		<?php get_template_part( 'template-pages/common', 'inner-banner-section' ); ?>

		<?php if ( ! empty( $terms ) ) : ?>
		<!-- Portfolio Gallery Start -->
		<div class="portfolio-gallery">
			<div class="container">
				<div class="portfolio-gallery-head wow fadeup-animation" data-wow-delay="0.2s">
					<div class="portfolio-gallery-tabs">
						<?php foreach ( $terms as $term ) : ?>
							<button type="button" class="portfolio-gallery-tab<?php echo ( (int) $term->term_id === $active_term_id ) ? ' is-active' : ''; ?>" data-term="<?php echo esc_attr( $term->term_id ); ?>" aria-label="<?php echo esc_attr( $term->name ); ?>"><?php echo esc_html( $term->name ); ?></button>
						<?php endforeach; ?>
					</div>
				</div>
				<div class="portfolio-gallery-content" data-term="<?php echo esc_attr( $active_term_id ); ?>" data-page="1">
					<div class="row portfolio-gallery-grid">
						<?php echo $gallery_page['html']; ?>
					</div>
					<div class="loader-wp" style="display: none;">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/loader.svg' ); ?>" alt="Loader" title="Loader" width="100" height="100">
					</div>
				</div>
				<div class="portfolio-gallery-more"<?php echo empty( $gallery_page['has_more'] ) ? ' style="display: none;"' : ''; ?>>
					<button type="button" class="sec-btn dark-outline-btn js-portfolio-load-more" aria-label="Load More">Load More</button>
				</div>
			</div>
		</div>
		<!-- Portfolio Gallery End -->
		<?php endif; ?>

		<div class="section-separator bg-white"><span class="section-separator-inner bg-orange-100"></span></div>

		<?php if ( ! empty( $archive_details ) ) : ?>
		<!-- Service Split Start -->
		<section class="service-split portfolio-split-section">
			<div class="container container-lg">
				<div class="service-split-list">
					<?php
					foreach ( $archive_details as $item ) :
						if ( ! is_array( $item ) ) {
							continue;
						}

						$item_title = $item['title'] ?? '';
						$item_copy  = $item['content'] ?? '';
						$item_image = $item['image'] ?? '';
						$item_image = is_array( $item_image ) ? ( $item_image['url'] ?? '' ) : (string) $item_image;
						$position   = $item['image_position'] ?? '';
						$position   = is_array( $position ) ? ( $position['value'] ?? '' ) : $position;
						$is_left    = ( 'Left' === $position );

						if ( '' === $item_title && '' === $item_copy && '' === $item_image ) {
							continue;
						}

						$item_image = $item_image ? $item_image : $placeholder_image;

						$content_order = $is_left ? ' order-lg-2' : '';
						$media_order   = $is_left ? ' order-lg-1' : '';
						$media_wow     = $is_left ? 'left-animation' : 'right-animation';
						?>
					<div class="row service-split-row">
						<div class="col-lg-6 align-self-center service-split-content-col<?php echo esc_attr( $content_order ); ?>">
							<div class="service-split-content wow fadeup-animation" data-wow-delay="0.2s">
								<?php if ( ! empty( $item_title ) ) : ?>
									<h2 class="h2-title mb-0"><?php echo esc_html( $item_title ); ?></h2>
								<?php endif; ?>
								<?php if ( ! empty( $item_copy ) ) : ?>
									<div class="service-split-body">
										<?php echo wp_kses_post( $item_copy ); ?>
									</div>
								<?php endif; ?>
							</div>
						</div>
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

		<div class="section-separator bg-orange-100"><span class="section-separator-inner bg-orange-100"></span></div>
	</main><!-- #main -->
</div><!-- #primary -->
<?php
get_footer();
?>
