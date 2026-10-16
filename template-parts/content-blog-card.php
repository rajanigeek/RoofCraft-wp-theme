<?php
/**
 * Template part for displaying blog cards in archive, index, and search grids.
 *
 * @package roofcraft
 */

$blog_card_permalink = get_permalink();
$blog_card_title     = get_the_title();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-card' ); ?>>
	<div class="blog-card-inner">
		<div class="blog-card-media">
			<a href="<?php echo esc_url( $blog_card_permalink ); ?>" title="<?php echo esc_attr( $blog_card_title ); ?>">
				<?php
				if ( has_post_thumbnail() ) {
					the_post_thumbnail(
						'large',
						array(
							'alt'   => $blog_card_title,
							'title' => $blog_card_title,
						)
					);
				} else {
					?>
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/placeholder-img.jpg' ); ?>" alt="<?php echo esc_attr( $blog_card_title ); ?>" title="<?php echo esc_attr( $blog_card_title ); ?>" width="432" height="220">
					<?php
				}
				?>
			</a>
		</div>
		<div class="blog-card-content">
			<div class="blog-card-text">
				<h3 class="blog-card-title h6-title mb-0">
					<a href="<?php echo esc_url( $blog_card_permalink ); ?>" title="<?php echo esc_attr( $blog_card_title ); ?>" rel="bookmark"><?php echo esc_html( $blog_card_title ); ?></a>
				</h3>
				<div class="blog-card-excerpt text-s">
					<p><?php echo esc_html( get_the_excerpt() ); ?></p>
				</div>
			</div>
            <div class="blog-card-link-wrap">
                <a class="blog-card-link" href="<?php echo esc_url( $blog_card_permalink ); ?>" title="Read More">
                    <span>Read More</span>
                    <iconify-icon icon="weui:arrow-outlined"></iconify-icon>
                </a>
            </div>
		</div>
	</div>
</article>
