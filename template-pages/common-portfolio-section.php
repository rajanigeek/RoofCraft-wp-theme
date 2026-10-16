<?php
// Project photos. A selected category limits which projects show.
$page_id = get_queried_object_id();
if ( ! $page_id ) {
	$page_id = get_the_ID();
}

$projects_sub_title = get_field( 'home_projects_sub_title', $page_id );
$projects_title     = get_field( 'home_projects_title', $page_id );
$projects_content   = get_field( 'home_projects_content', $page_id );

$products_page = get_field( 'service_products_page', $page_id );
$products_page = is_array( $products_page ) ? reset( $products_page ) : $products_page;
$products_page = is_string( $products_page ) ? $products_page : '';

$product_term = get_field( 'service_products_details', $page_id );
if ( is_array( $product_term ) && isset( $product_term[0] ) ) {
	$product_term = $product_term[0];
}

$term_id   = 0;
$term_slug = '';
if ( $product_term instanceof WP_Term ) {
	$term_id   = (int) $product_term->term_id;
	$term_slug = $product_term->slug;
} elseif ( is_object( $product_term ) && ! empty( $product_term->term_id ) ) {
	$term_id   = (int) $product_term->term_id;
	$term_slug = ! empty( $product_term->slug ) ? $product_term->slug : '';
} elseif ( is_array( $product_term ) && ! empty( $product_term['term_id'] ) ) {
	$term_id   = (int) $product_term['term_id'];
	$term_slug = $product_term['slug'] ?? '';
} elseif ( is_numeric( $product_term ) ) {
	$term_id = (int) $product_term;
} elseif ( is_string( $product_term ) && '' !== $product_term ) {
	$term_slug = $product_term;
}

$project_type = post_type_exists( 'project' ) ? 'project' : 'projects';
$query_args   = array(
	'post_type'      => $project_type,
	'post_status'    => 'publish',
	'posts_per_page' => -1,
	'orderby'        => 'date',
	'order'          => 'DESC',
	'fields'         => 'ids',
	'no_found_rows'  => true,
);

if ( $term_id || '' !== $term_slug ) {
	$query_args['tax_query'] = array(
		array(
			'taxonomy' => 'project-categorie',
			'field'    => $term_id ? 'term_id' : 'slug',
			'terms'    => $term_id ? $term_id : $term_slug,
		),
	);
}

$projects_q = new WP_Query( $query_args );

$max_images = 6;
$cards      = array();
foreach ( $projects_q->posts as $project_id ) {
	if ( count( $cards ) >= $max_images ) {
		break;
	}

	$gallery = function_exists( 'get_field' ) ? get_field( 'images_gallery', $project_id ) : array();
	if ( ! is_array( $gallery ) || empty( $gallery ) ) {
		continue;
	}

	$portfolio_title = get_the_title( $project_id );

	$card_page_link = get_field( 'page_link', $project_id );
	$card_page_link = is_array( $card_page_link ) ? reset( $card_page_link ) : $card_page_link;
	$card_page_link = is_string( $card_page_link ) ? $card_page_link : '';

	$portfolio_url = $card_page_link ? $card_page_link : ( $products_page ? $products_page : roofcraft_get_portfolio_page_url() );

	$card_terms   = wp_get_post_terms( $project_id, 'project-categorie', array( 'fields' => 'ids' ) );
	$card_term_id = ( ! is_wp_error( $card_terms ) && ! empty( $card_terms ) ) ? (int) $card_terms[0] : 0;
	if ( $portfolio_url && $card_term_id ) {
		$portfolio_url = add_query_arg( 'term', $card_term_id, $portfolio_url );
	}

	foreach ( $gallery as $image ) {
		if ( count( $cards ) >= $max_images ) {
			break;
		}

		$item = roofcraft_portfolio_normalize_image( $image, $portfolio_title );
		if ( ! $item ) {
			continue;
		}

		$cards[] = array(
			'url'   => $portfolio_url,
			'title' => $item['title'],
			'alt'   => $item['alt'],
			'image' => $item['url'],
		);
	}
}

if ( $projects_sub_title || $projects_title || $projects_content ) :
	?>
<!-- Portfolio Section Start -->
<section class="portfolio">
	<div class="container">
		<div class="section-head portfolio-head text-center">
			<div class="section-head-title-group">
				<?php if ( ! empty( $projects_sub_title ) ) : ?>
					<div class="section-head-eyebrow text-xs wow fadeup-animation" data-wow-delay="0.2s">
						<p><?php echo esc_html( $projects_sub_title ); ?></p>
					</div>
				<?php endif; ?>
				<?php if ( ! empty( $projects_title ) ) : ?>
					<h2 class="h2-title section-head-title mb-0 wow fadeup-animation" data-wow-delay="0.4s"><?php echo esc_html( $projects_title ); ?></h2>
				<?php endif; ?>
			</div>
			<?php if ( ! empty( $projects_content ) ) : ?>
				<div class="section-head-desc text-l wow fadeup-animation" data-wow-delay="0.6s">
					<?php echo wp_kses_post( $projects_content ); ?>
				</div>
			<?php endif; ?>
		</div>
		<?php if ( ! empty( $cards ) ) : ?>
			<div class="row portfolio-cards">
				<?php foreach ( $cards as $card ) : ?>
					<div class="col-md-6 col-lg-4">
						<a class="portfolio-card wow fadeup-animation" href="<?php echo esc_url( $card['url'] ); ?>" title="<?php echo esc_attr( $card['alt'] ); ?>" aria-label="<?php echo esc_attr( $card['alt'] ); ?>" data-wow-delay="0.2s">
							<span class="sec-btn portfolio-card-btn">
								<iconify-icon icon="iconamoon:arrow-top-right-1"></iconify-icon>
							</span>
							<div class="portfolio-card-inner cliping-wp">
								<div class="portfolio-card-media">
									<img src="<?php echo esc_url( $card['image'] ); ?>" alt="<?php echo esc_attr( $card['alt'] ); ?>" title="<?php echo esc_attr( $card['alt'] ); ?>" width="432" height="240">
									<div class="section-head-eyebrow text-xs portfolio-card-tag">
										<p>See More</p>
									</div>
								</div>
							</div>
						</a>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>
<!-- Portfolio Section End -->
	<?php
endif;
