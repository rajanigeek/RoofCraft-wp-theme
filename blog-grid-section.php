<?php
/**
 * Blog grid section — archive, index, and search listing layout.
 *
 * @package roofcraft
 */

global $wp_query;

// Title changes for search, categories, author, and dates.
$blog_grid_title = get_query_var( 'blog_grid_title' );

if ( empty( $blog_grid_title ) ) {
	if ( is_search() ) {
		$blog_grid_title = sprintf(
			/* translators: %s: search query. */
			__( 'Search Results for "%s"', 'roofcraft' ),
			get_search_query()
		);
	} elseif ( is_category() || is_tag() || is_tax() ) {
		$blog_grid_title = single_term_title( '', false );
	} elseif ( is_author() ) {
		$blog_grid_title = get_the_author();
	} elseif ( is_date() ) {
		$blog_grid_title = get_the_date( 'F Y' );
	} else {
		$blog_grid_title = __( 'Latest Articles', 'roofcraft' );
	}
}

$blog_grid_shown   = (int) $wp_query->post_count;
$blog_grid_total   = (int) $wp_query->found_posts;
$blog_grid_context = roofcraft_blog_grid_context();
$blog_has_more     = (int) $wp_query->max_num_pages > 1;
?>

<!-- Blog Grid Section Start -->
<section class="blog-grid">
	<div class="container">
		<div class="blog-grid-head">
			<h2 class="blog-grid-title h5-title mb-0"><?php echo esc_html( $blog_grid_title ); ?></h2>
			<?php if ( $blog_grid_total > 0 ) : ?>
				<p class="blog-grid-count text-s mb-0">
					<?php
					printf(
						/* translators: 1: posts on this page, 2: total published posts. */
						esc_html__( 'Showing %1$d (%2$d) publications', 'roofcraft' ),
						$blog_grid_shown,
						$blog_grid_total
					);
					?>
				</p>
			<?php endif; ?>
		</div>

		<?php if ( have_posts() ) : ?>
			<div class="row blog-grid-cards" data-page="1" data-context="<?php echo esc_attr( wp_json_encode( $blog_grid_context ) ); ?>">
				<?php
				while ( have_posts() ) :
					the_post();
					echo roofcraft_blog_card_html(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				endwhile;
				?>
			</div>
			<div class="loader-wp" style="display: none;">
				<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/loader.svg' ); ?>" alt="Loader" title="Loader" width="100" height="100">
			</div>
			<div class="blog-grid-more"<?php echo $blog_has_more ? '' : ' style="display: none;"'; ?>>
				<button type="button" class="sec-btn dark-outline-btn js-blog-load-more" aria-label="Load More">Load More</button>
			</div>
		<?php else : ?>
			<?php get_template_part( 'template-parts/content', 'none' ); ?>
		<?php endif; ?>
	</div>
</section>
<!-- Blog Grid Section End -->
