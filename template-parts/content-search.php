<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package roofcraft
 */

if ( 'post' === get_post_type() ) {
	get_template_part( 'template-parts/content', 'blog-card' );
	return;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-search-card' ); ?>>
	<div class="blog-search-card-inner">
		<h3 class="blog-search-card-title h5-title mb-0">
			<a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h3>
		<div class="blog-search-card-excerpt text-s">
			<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 24, '…' ) ); ?></p>
		</div>
		<a class="blog-card-link" href="<?php echo esc_url( get_permalink() ); ?>" title="<?php esc_attr_e( 'Read More', 'roofcraft' ); ?>">
			<span><?php esc_html_e( 'Read More', 'roofcraft' ); ?></span>
			<iconify-icon icon="weui:arrow-outlined"></iconify-icon>
		</a>
	</div>
</article>
