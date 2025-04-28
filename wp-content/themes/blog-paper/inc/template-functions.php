<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Blog Paper
 */

function blog_paper_font_choices() {
	$font_family_arr     = array();
	$font_family_arr[''] = esc_html__( '--Default--', 'blog-paper' );

	// Make the request.
	$request = wp_remote_get( get_theme_file_uri( 'assets/webfonts.json' ) );

	if ( is_wp_error( $request ) ) {
		return false; // Bail early.
	}
	// Retrieve the data.
	$body = wp_remote_retrieve_body( $request );
	$data = json_decode( $body );
	if ( ! empty( $data ) ) {
		foreach ( $data->items as $items => $fonts ) {
			$family_str_arr                   = explode( ' ', $fonts->family );
			$family_value                     = implode( '+', $family_str_arr );
			$font_family_arr[ $family_value ] = $fonts->family;
		}
	}

	return $font_family_arr;
}

/**
 * Fetching Body Classes.
 */
require get_template_directory() . '/inc/body-classes.php';

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function blog_paper_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'blog_paper_pingback_header' );

/**
 * Get an array of post id and title.
 */
function blog_paper_get_post_choices() {
	$choices = array( '' => esc_html__( '--Select--', 'blog-paper' ) );
	$args    = array( 'numberposts' => -1 );
	$posts   = get_posts( $args );

	foreach ( $posts as $post ) {
		$id             = $post->ID;
		$title          = $post->post_title;
		$choices[ $id ] = $title;
	}

	return $choices;
	wp_reset_postdata();
}

/**
 * Get an array of cat id and title.
 */
function blog_paper_get_post_cat_choices() {
	$choices = array( '' => esc_html__( '--Select--', 'blog-paper' ) );
	$cats    = get_categories();

	foreach ( $cats as $cat ) {
		$id             = $cat->term_id;
		$title          = $cat->name;
		$choices[ $id ] = $title;
	}

	return $choices;
}

/*========================Static Homepage==============================*/
function blog_paper_is_static_homepage_enabled( $control ) {
	return ( 'page' === $control->manager->get_setting( 'show_on_front' )->value() );
}

/**
 * Checks to see if we're on the homepage or not.
 */
function blog_paper_is_frontpage() {
	return ( is_front_page() && ! is_home() );
}

/**
 * Checks to see if Static Front Page is set to "Your latest posts".
 */
function blog_paper_is_latest_posts() {
	return ( is_front_page() && is_home() );
}

/**
 * Checks to see if Static Front Page is set to "Posts page".
 */
function blog_paper_is_frontpage_blog() {
	return ( is_home() && ! is_front_page() );
}

/**
 * Shows a breadcrumb for all types of pages.  This is a wrapper function for the Breadcrumb_Trail class,
 * which should be used in theme templates.
 *
 * @since  1.0.0
 * @access public
 * @param  array $args Arguments to pass to Breadcrumb_Trail.
 * @return void
 */
function blog_paper_breadcrumb( $args = array() ) {
	$breadcrumb = apply_filters( 'breadcrumb_trail_object', null, $args );

	if ( ! is_object( $breadcrumb ) ) {
		$breadcrumb = new Breadcrumb_Trail( $args );
	}

	return $breadcrumb->trail();
}

/**
 * Add separator for breadcrumb trail.
 */
function blog_paper_breadcrumb_trail_print_styles() {
	$breadcrumb_separator = get_theme_mod( 'blog_paper_breadcrumb_separator', '/' );

	$style = '
	.trail-items li:not(:last-child):after {
		content: "' . $breadcrumb_separator . '";
	}';

	$style = apply_filters( 'blog_paper_breadcrumb_trail_inline_style', trim( str_replace( array( "\r", "\n", "\t", '  ' ), '', $style ) ) );

	if ( $style ) {
		echo "\n" . '<style type="text/css" id="breadcrumb-trail-css">' . $style . '</style>' . "\n";
	}
}
add_action( 'wp_head', 'blog_paper_breadcrumb_trail_print_styles' );

if ( ! function_exists( 'blog_paper_sidebar_layout' ) ) {
	/**
	 * Get sidebar layout.
	 */
	function blog_paper_sidebar_layout() {
		$archive_sidebar_position = get_theme_mod( 'blog_paper_archive_sidebar_position', 'right-sidebar' );
		$sidebar_position_post    = get_theme_mod( 'blog_paper_post_sidebar_position', 'right-sidebar' );
		$sidebar_position_page    = get_theme_mod( 'blog_paper_page_sidebar_position', 'right-sidebar' );

		if ( is_single() ) {
			$archive_sidebar_position = $sidebar_position_post;
		} elseif ( is_page() ) {
			$archive_sidebar_position = $sidebar_position_page;
		}

		return $archive_sidebar_position;
	}
}

if ( ! function_exists( 'blog_paper_is_sidebar_enabled' ) ) {
	/**
	 * Check if sidebar is enabled.
	 */
	function blog_paper_is_sidebar_enabled() {
		$archive_sidebar_position = get_theme_mod( 'blog_paper_archive_sidebar_position', 'right-sidebar' );
		$sidebar_position_post    = get_theme_mod( 'blog_paper_post_sidebar_position', 'right-sidebar' );
		$sidebar_position_page    = get_theme_mod( 'blog_paper_page_sidebar_position', 'right-sidebar' );

		$sidebar_enabled = true;
		if ( is_home() || is_archive() || is_search() ) {
			if ( $archive_sidebar_position === 'no-sidebar' ) {
				$sidebar_enabled = false;
			}
		} elseif ( is_single() ) {
			if ( $sidebar_position_post === 'no-sidebar' ) {
				$sidebar_enabled = false;
			}
		} elseif ( is_page() ) {
			if ( $sidebar_position_page === 'no-sidebar' ) {
				$sidebar_enabled = false;
			}
		}
		return $sidebar_enabled;
	}
}

/**
 * Pagination for archive.
 */
function blog_paper_render_posts_pagination() {
	$is_pagination_enabled = get_theme_mod( 'blog_paper_pagination_enable', true );
	if ( $is_pagination_enabled ) {
		$pagination_type = get_theme_mod( 'blog_paper_pagination_type', 'numeric' );
		if ( 'default' === $pagination_type ) :
			the_posts_navigation();
		else :
			the_posts_pagination();
		endif;
	}
}
add_action( 'blog_paper_posts_pagination', 'blog_paper_render_posts_pagination', 10 );

/**
 * Pagination for single post.
 */
function blog_paper_render_post_navigation() {
	the_post_navigation(
		array(
			'prev_text' => '<span>&#10229;</span> <span class="nav-title">%title</span>',
			'next_text' => '<span class="nav-title">%title</span> <span>&#10230;</span>',
		)
	);
}
add_action( 'blog_paper_post_navigation', 'blog_paper_render_post_navigation' );

/*excerpt length validation*/
if ( ! function_exists( 'blog_paper_excerpt_length_validation' ) ) :
	function blog_paper_excerpt_length_validation( $validity, $value ) {
		$value = intval( $value );
		if ( empty( $value ) || ! is_numeric( $value ) ) {
			$validity->add( 'required', esc_html__( 'You must supply a valid number.', 'blog-paper' ) );
		} elseif ( $value < 1 ) {
			$validity->add( 'min_no_of_posts', esc_html__( 'Minimum no of posts is 1', 'blog-paper' ) );
		} elseif ( $value > 100 ) {
			$validity->add( 'max_no_of_posts', esc_html__( 'Maximum no of posts is 100', 'blog-paper' ) );
		}
		return $validity;
	}
endif;
