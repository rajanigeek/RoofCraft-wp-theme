<?php
/**
 * The main template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package roofcraft
 */

get_header();
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">
		<?php get_template_part( 'template-pages/common', 'inner-banner-section' ); ?>

		<?php get_template_part( 'blog-grid', 'section' ); ?>

		<div class="section-separator bg-white"><span class="section-separator-inner bg-orange-100"></span></div>

		<?php
		// Extra rows under the grid, taken from the posts page.
		$page_id = is_home() ? (int) get_option( 'page_for_posts' ) : (int) get_queried_object_id();
		$archive_details = $page_id ? get_field( 'archive_details', $page_id ) : array();
		$archive_details = is_array( $archive_details ) ? $archive_details : array();

		$placeholder_image = get_field( 'placeholder_image', 'option' );
		$placeholder_image = is_array( $placeholder_image ) ? ( $placeholder_image['url'] ?? '' ) : (string) $placeholder_image;
		?>

		<?php if ( ! empty( $archive_details ) ) : ?>
		<!-- Service Split Start -->
		<section class="service-split">
			<div class="container container-lg">
				<div class="service-split-list">
					<?php
					$service_split_index = 0;
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

						if ( '' === $item_title && '' === $item_copy && '' === $item_image ) {
							continue;
						}

						// Respect an explicit Left/Right choice; otherwise alternate so rows still stagger.
						$is_left = ( 'Left' === $position || 'Right' === $position )
							? ( 'Left' === $position )
							: ( 0 === $service_split_index % 2 );
						$service_split_index++;

						$item_image = $item_image ? $item_image : $placeholder_image;
						$media_wow  = $is_left ? 'left-animation' : 'right-animation';
						?>
					<div class="row service-split-row">
						<?php if ( $is_left && ! empty( $item_image ) ) : ?>
						<div class="col-lg-6 service-split-media-col">
							<div class="service-split-media wow <?php echo esc_attr( $media_wow ); ?>" data-wow-delay="0.2s">
								<img src="<?php echo esc_url( $item_image ); ?>" alt="<?php echo esc_attr( $item_title ); ?>" title="<?php echo esc_attr( $item_title ); ?>" width="656" height="480">
							</div>
						</div>
						<?php endif; ?>

						<div class="col-lg-6 align-self-center service-split-content-col">
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

						<?php if ( ! $is_left && ! empty( $item_image ) ) : ?>
						<div class="col-lg-6 service-split-media-col">
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
