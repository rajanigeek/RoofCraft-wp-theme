<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package roofcraft
 */

get_header();
?>
<main id="primary" class="site-main">
	<!-- Banner Start -->
	<section class="main-banner hero inner-banner white-text">
		<div class="inner-banner-bg">
			<?php
			$inner_banner_title = get_the_title();
			if (has_post_thumbnail()) {
				echo wp_get_attachment_image(
					get_post_thumbnail_id(),
					'full',
					false,
					array(
						'alt'   => $inner_banner_title,
						'title' => $inner_banner_title,
					)
				);
			} else {
				?>
				<img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/common-banner.jpg'); ?>" alt="<?php echo esc_attr($inner_banner_title); ?>" title="<?php echo esc_attr($inner_banner_title); ?>" width="1280" height="720">
				<?php
			}
			?>
		</div>
		<div class="container">
			<div class="hero-content">
				<div class="hero-title-group">
					<h1 class="h2-title mb-0 wow fadeup-animation" data-wow-delay="0.4s"><?php the_title(); ?></h1>
				</div>
			</div>
		</div>
		<div class="section-separator"><span class="section-separator-inner bg-white"></span></div>
	</section>
	<!-- Banner End -->
	<div class="inner-page-text">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-8">
					<?php
						while ( have_posts() ) :
							the_post();
				
							get_template_part( 'template-parts/content', get_post_type() );
				
							the_post_navigation(
								array(
									'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous', 'roofcraft' ) . '</span> <span class="nav-title">: %title</span>',
									'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next', 'roofcraft' ) . '</span> <span class="nav-title">: %title</span>',
								)
							);
				
							// If comments are open or we have at least one comment, load up the comment template.
							// if ( comments_open() || get_comments_number() ) :
							// 	comments_template();
							// endif;
				
						endwhile; // End of the loop.
					?>
				</div>
			</div>
		</div>
	</div>
</main><!-- #main -->

<?php
get_footer();
