<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
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
					<h1 class="h2-title mb-0 wow fadeup-animation" data-wow-delay="0.4s"><?php esc_html_e('Oops! That page can&rsquo;t be found.', 'roofcraft'); ?></h1>
				</div>
				<div class="hero-desc text-l wow fadeup-animation" data-wow-delay="0.6s">
					<p>It looks like this page has gone missing. The link may be outdated, or the page may have been moved to a new location.</p>
				</div>
			</div>
		</div>
		<div class="section-separator"><span class="section-separator-inner bg-white"></span></div>
	</section>
	<!-- Banner End -->

	<!-- 404 Page Section Start -->
	<div class="not-found-section">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<!-- Missing-page graphic. -->
					<img width="388" height="350" src="<?php echo get_template_directory_uri(); ?>/assets/images/not-found.png" alt="404 Not Found!" title="404 Not Found!">
					<div class="not-found-content">
						<h2 class="mb-0">Oops! We Can’t Find That Page</h2>
						<div class="not-found-content-text">
							<p>The page you’re looking for may have been moved, removed, or is no longer available. Let’s get you back on the right path.</p>
						</div>
						<a class="sec-btn" href="<?php echo home_url(); ?>" title="Go to Home">Go to Home</a>						
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- 404 Page Section End -->
</main>
<?php
get_footer();
