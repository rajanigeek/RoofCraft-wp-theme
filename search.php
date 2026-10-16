<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package roofcraft
 */

get_header();
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">
		<?php get_template_part( 'template-pages/common', 'inner-banner-section' ); ?>

		<?php get_template_part( 'blog-grid', 'section' ); ?>
	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
