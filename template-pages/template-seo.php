<?php

/**
 * Template Name: SEO
 */
get_header();

// Hero stays as-is. The text under it is the page content.
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <!-- Hero Section Start -->
		<section class="main-banner hero white-text quote-hero seo-banner">
			<div class="banner-video">
				<iframe src="https://player.vimeo.com/video/1219800827?background=1&amp;autoplay=1&amp;muted=1&amp;loop=1&amp;autopause=0&amp;playsinline=1" title="Get Your Free Estimate Today" width="1920" height="1080" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
			</div>
			<div class="container">
				<div class="hero-content">
					<div class="section-head-eyebrow text-xs wow fadeup-animation" data-wow-delay="0.2s">
						<p>Eclipse Roofing</p>
					</div>
					<div class="hero-title-group">
						<h2 class="h1-title mb-0 wow fadeup-animation" data-wow-delay="0.2s">Roofs Built on Craftsmanship, Not Compromise</h2>
						<div class="hero-desc text-l mb-0 wow fadeup-animation" data-wow-delay="0.2s">
							<p>An Amish-owned roofing company delivering exceptional craftsmanship, honest service, and durable roofing solutions throughout Southeastern Pennsylvania.</p>
						</div>
					</div>
					<div class="form-wp wow fadeup-animation" data-wow-delay="0.2s">
						<h2 class="h4-title mb-0">Request Your Free Estimate</h2>
						<?php
						echo do_shortcode('[contact-form-7 id="01e8d07" title="Request Your Free Estimate"]');
						?>
					</div>
				</div>
			</div>
			<div class="section-separator"><span class="section-separator-inner bg-white"></span></div>
		</section>
		<!-- Hero Section End -->

        <!-- Main Seo Section Start -->
        <div class="main-seo-content">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="sec-title wow fadeup-animation" data-wow-duration="0.8s" data-delay="0.2">
                            <h1 class="h2-title"><?php the_title() ?></h1>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="excerpt-content wow fadeup-animation" data-wow-duration="0.8s" data-delay="0.3">
                            <?php the_content(); ?>
                        </div>
                        <div class="submit-btn wow fadeup-animation" data-wow-duration="0.8s" data-delay="0.4">
                            <button type="button" title="Read more" id="read-more" class="sec-btn">Read more</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main Seo Section End -->

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
