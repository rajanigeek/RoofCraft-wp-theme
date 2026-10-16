<?php

/**
 * Eclipse Roofing functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package roofcraft
 */

if (! defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function roofcraft_setup()
{
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Eclipse Roofing, use a find and replace
		* to change 'roofcraft' to the name of your theme in all the template files.
		*/
	load_theme_textdomain('roofcraft', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support('title-tag');

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'primary' => esc_html__('Primary', 'roofcraft'),
			'footer-navigation' => esc_html__('Footer Navigation', 'roofcraft'),
			'footer-services' => esc_html__('Footer Services', 'roofcraft'),
			'privacy-menu' => esc_html__('Privacy Menu', 'roofcraft'),
            'seo-menu' => esc_html__('SEO Menu', 'roofcraft'),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'roofcraft_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action('after_setup_theme', 'roofcraft_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function roofcraft_content_width()
{
	$GLOBALS['content_width'] = apply_filters('roofcraft_content_width', 640);
}
add_action('after_setup_theme', 'roofcraft_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function roofcraft_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'roofcraft'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'roofcraft'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'roofcraft_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function roofcraft_scripts()
{
	// Enqueue CSS files
	wp_enqueue_style('roofcraft-layout-css', get_template_directory_uri() . '/assets/css/layout.css', array(), filemtime(get_template_directory() . '/assets/css/layout.css'));
	wp_enqueue_style('roofcraft-swiper-bundle-min-css', get_template_directory_uri() . '/assets/css/swiper-bundle.min.css', array(), filemtime(get_template_directory() . '/assets/css/swiper-bundle.min.css'));
	wp_enqueue_style('roofcraft-fancybox-css', get_template_directory_uri() . '/assets/css/fancybox.css', array(), filemtime(get_template_directory() . '/assets/css/fancybox.css'));
	wp_enqueue_style('roofcraft-twentytwenty-css', get_template_directory_uri() . '/assets/css/twentytwenty.css', array(), filemtime(get_template_directory() . '/assets/css/twentytwenty.css'));

	wp_enqueue_style('roofcraft-style', get_stylesheet_uri(), array(), _S_VERSION);

	// Enqueue jQuery
	wp_enqueue_script('jquery');

	// Enqueue JavaScript files
	wp_enqueue_script('roofcraft-layout-js', get_template_directory_uri() . '/assets/js/layout.js', array(), filemtime(get_template_directory() . '/assets/js/layout.js'), true);
	wp_enqueue_script('roofcraft-iconify-icon-min-js', get_template_directory_uri() . '/assets/js/iconify-icon.min.js', array(), filemtime(get_template_directory() . '/assets/js/iconify-icon.min.js'), true);
	wp_enqueue_script('roofcraft-swiper-bundle-js', get_template_directory_uri() . '/assets/js/swiper-bundle.min.js', array(), filemtime(get_template_directory() . '/assets/js/swiper-bundle.min.js'), true);
	wp_enqueue_script('roofcraft-simplebar-js', get_template_directory_uri() . '/assets/js/simplebar.min.js', array(), filemtime(get_template_directory() . '/assets/js/simplebar.min.js'), true);
	wp_enqueue_script('roofcraft-fancybox-umd-js', get_template_directory_uri() . '/assets/js/fancybox.umd.js', array(), filemtime(get_template_directory() . '/assets/js/fancybox.umd.js'), true);
	wp_enqueue_script('roofcraft-jquery-twentytwenty-js', get_template_directory_uri() . '/assets/js/jquery.twentytwenty.js', array(), filemtime(get_template_directory() . '/assets/js/jquery.twentytwenty.js'), true);
	wp_enqueue_script('roofcraft-custom-js', get_template_directory_uri() . '/assets/js/custom.js', array('jquery'), filemtime(get_template_directory() . '/assets/js/custom.js'), true);

	$google_api_key = function_exists( 'get_field' ) ? get_field( 'google_api_key', 'option' ) : '';
	wp_localize_script(
		'roofcraft-custom-js',
		'custom_call',
		array(
			'ajaxurl'         => admin_url( 'admin-ajax.php' ),
			'homeurl'         => home_url(),
			'googleMapApi'    => ! empty( $google_api_key ) ? $google_api_key : '',
			'reviewsNonce'    => wp_create_nonce( 'roofcraft_reviews' ),
			'portfolioNonce'  => wp_create_nonce( 'roofcraft_portfolio' ),
			'blogNonce'       => wp_create_nonce( 'roofcraft_blog' ),
		)
	);

	wp_enqueue_script('roofcraft-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), _S_VERSION, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'roofcraft_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Disable auto-paragraphs in Contact Form 7.
 */
add_filter('wpcf7_autop_or_not', '__return_false');

function custom_home_url_shortcode() {
    return esc_url( home_url() );
}
add_shortcode('home_url', 'custom_home_url_shortcode');

/**
 * Disable comments site-wide in WordPress
 */
function disable_comments_sitewide() {

    // Close comments on the front-end
    add_filter('comments_open', '__return_false', 20, 2);
    add_filter('pings_open', '__return_false', 20, 2);
    // Hide existing comments
    add_filter('comments_array', '__return_empty_array', 10, 2);

    // Remove comments menu from admin
    add_action('admin_menu', function () {
        remove_menu_page('edit-comments.php');
    });
    // Redirect comments page in admin
    add_action('admin_init', function () {
        global $pagenow;

        if ($pagenow === 'edit-comments.php') {
            wp_redirect(admin_url());
            exit;
        }
    });

    // Remove comments support from post types
    add_action('init', function () {
        $post_types = get_post_types();

        foreach ($post_types as $post_type) {
            if (post_type_supports($post_type, 'comments')) {
                remove_post_type_support($post_type, 'comments');
                remove_post_type_support($post_type, 'trackbacks');
            }
        }
    });
    // Remove comments icon from admin bar
    add_action('wp_before_admin_bar_render', function () {
        global $wp_admin_bar;
        $wp_admin_bar->remove_menu('comments');
    });
}

disable_comments_sitewide();

add_filter('get_custom_logo', 'change_html_custom_logo');

function change_html_custom_logo()

{

	$custom_logo_id = get_theme_mod('custom_logo');

	$site_name = get_bloginfo('name');

	$html = sprintf(

		'<a href="%1$s" class="custom-logo-link" rel="home" title="' . $site_name . '">%2$s</a>',

		esc_url(home_url('/')),

		wp_get_attachment_image($custom_logo_id, 'full', false, array(

			'class' => 'custom-logo',

			'alt' => $site_name,

			'title' => $site_name,

			'width' => 157,

			'height' => 68,

		))

	);

	return $html;
}

function add_menu_atts( $atts, $item, $args ) {
$atts['title'] = ucwords(strtolower($item->title));
return $atts;
} add_filter( 'nav_menu_link_attributes', 'add_menu_atts', 10, 3 );

/**
 * Reviews listing query. 8 per request for the template and AJAX load more.
 */
function roofcraft_reviews_query( $paged = 1 ) {
	return new WP_Query(
		array(
			'post_type'      => 'testimonial',
			'post_status'    => 'publish',
			'posts_per_page' => 8,
			'paged'          => max( 1, (int) $paged ),
			'orderby'        => 'menu_order date',
			'order'          => 'ASC',
		)
	);
}

function roofcraft_reviews_card_html() {
	$review_name  = get_the_title();
	$review_quote = get_the_content();
	if ( empty( $review_name ) && empty( $review_quote ) ) {
		return '';
	}

	ob_start();
	?>
	<div class="reviews-card testimonials-card wow fadeup-animation" data-wow-delay="0.2s">
		<div class="star-rating-wp">
			<div class="star-rating">
				<span class="star-rating-fill" style="width:100%"></span>
			</div>
		</div>
		<?php if ( ! empty( $review_quote ) ) : ?>
			<div class="testimonials-card-text">
				<?php echo apply_filters( 'the_content', $review_quote ); ?>
			</div>
		<?php endif; ?>
		<?php if ( ! empty( $review_name ) ) : ?>
			<div class="testimonials-card-author text-s">
				<h3 class="text-s mb-0"><?php echo esc_html( $review_name ); ?></h3>
			</div>
		<?php endif; ?>
	</div>
	<?php
	return ob_get_clean();
}

function roofcraft_ajax_load_more_reviews() {
	if ( ! check_ajax_referer( 'roofcraft_reviews', 'nonce', false ) ) {
		wp_send_json_error( null, 403 );
	}

	$page  = isset( $_POST['page'] ) ? absint( $_POST['page'] ) : 1;
	$query = roofcraft_reviews_query( $page );
	$html  = '';

	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			$html .= roofcraft_reviews_card_html();
		}
		wp_reset_postdata();
	}

	wp_send_json_success(
		array(
			'html'     => $html,
			'has_more' => $page < (int) $query->max_num_pages,
		)
	);
}
add_action( 'wp_ajax_load_more_reviews', 'roofcraft_ajax_load_more_reviews' );
add_action( 'wp_ajax_nopriv_load_more_reviews', 'roofcraft_ajax_load_more_reviews' );

/**
 * Resolve the Portfolio archive page URL (template-portfolio.php), used as the
 * fallback destination for project cards that have no explicit page link set.
 */
function roofcraft_get_portfolio_page_url() {
	static $url = null;
	if ( null !== $url ) {
		return $url;
	}

	$url   = '';
	$pages = get_posts(
		array(
			'post_type'      => 'page',
			'post_status'    => 'publish',
			'posts_per_page' => 1,
			'fields'         => 'ids',
			'no_found_rows'  => true,
			'meta_query'     => array(
				array(
					'key'     => '_wp_page_template',
					'value'   => 'template-portfolio',
					'compare' => 'LIKE',
				),
			),
		)
	);
	if ( ! empty( $pages ) ) {
		$url = get_permalink( (int) $pages[0] );
	}

	return $url;
}

/**
 * Portfolio gallery: Project Categories tabs, images from images_gallery on the project CPT.
 */
function roofcraft_portfolio_gallery_images( $term_id ) {
	$post_type = post_type_exists( 'project' ) ? 'project' : 'projects';
	$query     = new WP_Query(
		array(
			'post_type'      => $post_type,
			'post_status'    => 'publish',
			'posts_per_page' => -1,
			'orderby'        => 'menu_order date',
			'order'          => 'ASC',
			'fields'         => 'ids',
			'no_found_rows'  => true,
			'tax_query'      => array(
				array(
					'taxonomy' => 'project-categorie',
					'field'    => 'term_id',
					'terms'    => (int) $term_id,
				),
			),
		)
	);

	$images = array();
	foreach ( $query->posts as $post_id ) {
		$gallery = function_exists( 'get_field' ) ? get_field( 'images_gallery', $post_id ) : array();
		if ( ! is_array( $gallery ) || empty( $gallery ) ) {
			continue;
		}

		$fallback = get_the_title( $post_id );
		foreach ( $gallery as $image ) {
			$item = roofcraft_portfolio_normalize_image( $image, $fallback );
			if ( $item ) {
				$images[] = $item;
			}
		}
	}

	return $images;
}

function roofcraft_portfolio_normalize_image( $image, $fallback = '' ) {
	$url    = '';
	$alt    = '';
	$title  = '';
	$width  = 432;
	$height = 330;

	if ( is_array( $image ) ) {
		$url    = $image['url'] ?? '';
		$alt    = $image['alt'] ?? '';
		$title  = $image['alt'] ?? '';
		$width  = ! empty( $image['width'] ) ? $image['width'] : 432;
		$height = ! empty( $image['height'] ) ? $image['height'] : 330;
	} elseif ( is_numeric( $image ) ) {
		$id  = (int) $image;
		$src = wp_get_attachment_image_src( $id, 'full' );
		if ( $src ) {
			$url    = $src[0];
			$width  = $src[1];
			$height = $src[2];
		}
		$alt   = get_post_meta( $id, '_wp_attachment_image_alt', true );
		$title = get_the_title( $id );
	} elseif ( is_string( $image ) ) {
		$url = $image;
	}

	if ( empty( $url ) ) {
		return null;
	}

	return array(
		'url'    => $url,
		'alt'    => $alt ? $alt : $fallback,
		'title'  => $title ? $title : $fallback,
		'width'  => $width,
		'height' => $height,
	);
}

function roofcraft_portfolio_gallery_item_html( $item, $fancybox = 'portfolio-gallery' ) {
	if ( empty( $item['url'] ) ) {
		return '';
	}

	ob_start();
	?>
	<div class="col-lg-4 col-md-6">
		<a class="portfolio-gallery-item wow fadeup-animation" href="<?php echo esc_url( $item['url'] ); ?>" data-fancybox="<?php echo esc_attr( $fancybox ); ?>" title="<?php echo esc_attr( $item['alt'] ); ?>" data-wow-delay="0.2s">
			<img src="<?php echo esc_url( $item['url'] ); ?>" alt="<?php echo esc_attr( $item['alt'] ); ?>" title="<?php echo esc_attr( $item['alt'] ); ?>" width="<?php echo esc_attr( $item['width'] ); ?>" height="<?php echo esc_attr( $item['height'] ); ?>">
		</a>
	</div>
	<?php
	return ob_get_clean();
}

function roofcraft_portfolio_gallery_page( $term_id, $paged = 1, $per_page = 12 ) {
	$images   = roofcraft_portfolio_gallery_images( $term_id );
	$total    = count( $images );
	$paged    = max( 1, (int) $paged );
	$per_page = max( 1, (int) $per_page );
	$offset   = ( $paged - 1 ) * $per_page;
	$slice    = array_slice( $images, $offset, $per_page );
	$fancybox = 'portfolio-gallery-' . (int) $term_id;
	$html     = '';

	foreach ( $slice as $item ) {
		$html .= roofcraft_portfolio_gallery_item_html( $item, $fancybox );
	}

	return array(
		'html'     => $html,
		'has_more' => ( $offset + count( $slice ) ) < $total,
	);
}

function roofcraft_ajax_load_portfolio_gallery() {
	if ( ! check_ajax_referer( 'roofcraft_portfolio', 'nonce', false ) ) {
		wp_send_json_error( null, 403 );
	}

	$term_id = isset( $_POST['term'] ) ? absint( $_POST['term'] ) : 0;
	$page    = isset( $_POST['page'] ) ? absint( $_POST['page'] ) : 1;
	$data    = roofcraft_portfolio_gallery_page( $term_id, $page );

	wp_send_json_success( $data );
}
add_action( 'wp_ajax_load_portfolio_gallery', 'roofcraft_ajax_load_portfolio_gallery' );
add_action( 'wp_ajax_nopriv_load_portfolio_gallery', 'roofcraft_ajax_load_portfolio_gallery' );

/**
 * Blog grid listing: same query on first paint and AJAX load more.
 */
function roofcraft_blog_grid_context() {
	global $wp_query;

	$context = array(
		'ppp'      => (int) $wp_query->get( 'posts_per_page' ),
		's'        => (string) $wp_query->get( 's' ),
		'cat'      => (int) $wp_query->get( 'cat' ),
		'tag_id'   => (int) $wp_query->get( 'tag_id' ),
		'author'   => (int) $wp_query->get( 'author' ),
		'year'     => (int) $wp_query->get( 'year' ),
		'monthnum' => (int) $wp_query->get( 'monthnum' ),
		'day'      => (int) $wp_query->get( 'day' ),
	);

	$post_type = $wp_query->get( 'post_type' );
	if ( is_array( $post_type ) ) {
		$post_type = implode( ',', array_map( 'sanitize_key', $post_type ) );
	}
	$context['post_type'] = is_string( $post_type ) ? $post_type : '';

	$queried = get_queried_object();
	if ( $queried instanceof WP_Term && ! is_category() && ! is_tag() ) {
		$context['taxonomy'] = $queried->taxonomy;
		$context['term_id']  = (int) $queried->term_id;
	}

	return array_filter(
		$context,
		static function ( $value ) {
			return '' !== $value && 0 !== $value && null !== $value;
		}
	);
}

function roofcraft_blog_query( $paged = 1, $context = array() ) {
	$context = is_array( $context ) ? $context : array();
	$ppp     = ! empty( $context['ppp'] ) ? (int) $context['ppp'] : (int) get_option( 'posts_per_page' );

	$args = array(
		'post_status'    => 'publish',
		'posts_per_page' => max( 1, $ppp ),
		'paged'          => max( 1, (int) $paged ),
		'orderby'        => 'date',
		'order'          => 'DESC',
	);

	if ( ! empty( $context['s'] ) ) {
		$args['s'] = sanitize_text_field( $context['s'] );
	}

	if ( ! empty( $context['post_type'] ) ) {
		$types = array_values( array_filter( array_map( 'sanitize_key', explode( ',', (string) $context['post_type'] ) ) ) );
		if ( $types ) {
			$args['post_type'] = ( 1 === count( $types ) ) ? $types[0] : $types;
			if ( 'any' !== $args['post_type'] && is_string( $args['post_type'] ) && ! is_post_type_viewable( $args['post_type'] ) ) {
				$args['post_type'] = 'post';
			}
		}
	} elseif ( empty( $args['s'] ) ) {
		$args['post_type'] = 'post';
	}

	if ( ! empty( $context['cat'] ) ) {
		$args['cat'] = absint( $context['cat'] );
	}
	if ( ! empty( $context['tag_id'] ) ) {
		$args['tag_id'] = absint( $context['tag_id'] );
	}
	if ( ! empty( $context['author'] ) ) {
		$args['author'] = absint( $context['author'] );
	}
	if ( ! empty( $context['year'] ) ) {
		$args['year'] = absint( $context['year'] );
	}
	if ( ! empty( $context['monthnum'] ) ) {
		$args['monthnum'] = absint( $context['monthnum'] );
	}
	if ( ! empty( $context['day'] ) ) {
		$args['day'] = absint( $context['day'] );
	}
	if ( ! empty( $context['taxonomy'] ) && taxonomy_exists( $context['taxonomy'] ) && ! empty( $context['term_id'] ) ) {
		$args['tax_query'] = array(
			array(
				'taxonomy' => sanitize_key( $context['taxonomy'] ),
				'field'    => 'term_id',
				'terms'    => absint( $context['term_id'] ),
			),
		);
	}

	return new WP_Query( $args );
}

function roofcraft_blog_card_html() {
	ob_start();
	?>
	<div class="col-lg-4 col-md-6">
		<?php
		if ( 'post' === get_post_type() ) {
			get_template_part( 'template-parts/content', 'blog-card' );
		} else {
			get_template_part( 'template-parts/content', 'search' );
		}
		?>
	</div>
	<?php
	return ob_get_clean();
}

function roofcraft_ajax_load_more_blog() {
	if ( ! check_ajax_referer( 'roofcraft_blog', 'nonce', false ) ) {
		wp_send_json_error( null, 403 );
	}

	$page    = isset( $_POST['page'] ) ? absint( $_POST['page'] ) : 1;
	$raw     = isset( $_POST['context'] ) ? wp_unslash( $_POST['context'] ) : '';
	$context = json_decode( $raw, true );
	$context = is_array( $context ) ? $context : array();
	$query   = roofcraft_blog_query( $page, $context );
	$html    = '';

	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			$html .= roofcraft_blog_card_html();
		}
		wp_reset_postdata();
	}

	$ppp   = ! empty( $context['ppp'] ) ? (int) $context['ppp'] : (int) get_option( 'posts_per_page' );
	$shown = ( ( $page - 1 ) * max( 1, $ppp ) ) + (int) $query->post_count;
	$total = (int) $query->found_posts;

	wp_send_json_success(
		array(
			'html'     => $html,
			'has_more' => $page < (int) $query->max_num_pages,
			'count'    => sprintf(
				/* translators: 1: posts loaded so far, 2: total published posts. */
				__( 'Showing %1$d (%2$d) publications', 'roofcraft' ),
				$shown,
				$total
			),
		)
	);
}
add_action( 'wp_ajax_load_more_blog', 'roofcraft_ajax_load_more_blog' );
add_action( 'wp_ajax_nopriv_load_more_blog', 'roofcraft_ajax_load_more_blog' );


// Stop WP adding sizes that were throwing the layout off.
function remove_auto_sizes_css_fix($add_auto_sizes) {return false;}
add_filter('wp_img_tag_add_auto_sizes', 'remove_auto_sizes_css_fix');

// Browsers expect application/speculationrules on that script tag. 
add_action('template_redirect', function () {
    ob_start(function ($buffer) {
        return str_replace(
            'type="speculationrules"',
            'type="application/speculationrules"',
            $buffer
        );
    });
});

add_action( 'template_redirect', function () {

    // Old /services/ URL goes home.
    if ( is_page( 'services' ) ) {
        wp_safe_redirect( home_url( '/' ), 301 );
        exit;
    }

} );


/**
 * Noindex Portfolio filtered URLs.
 */
function roofcraft_portfolio_filtered_noindex( $robots ) {

    if ( is_page( 'portfolio' ) && isset( $_GET['term'] ) ) {

        return 'noindex, follow';

    }

    return $robots;
}

add_filter(
    'wpseo_robots',
    'roofcraft_portfolio_filtered_noindex'
);