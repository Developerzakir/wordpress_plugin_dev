<?php

/**
 * Register custom fonts.
 */
function blog_paper_fonts_url() {
	$fonts_url     = '';
	$font_families = array();
	$subsets       = 'latin,latin-ext';

	if ( 'off' !== _x( 'on', 'Raleway font: on or off', 'blog-paper' ) ) {
		$font_families[] = 'Raleway:400,600,700';
	}

	if ( ! empty( get_theme_mod( 'blog_paper_site_title_font' ) ) ) {
		$font_families[] = str_replace( '+', ' ', get_theme_mod( 'blog_paper_site_title_font' ) );
	}

	if ( ! empty( get_theme_mod( 'blog_paper_site_description_font' ) ) ) {
		$font_families[] = str_replace( '+', ' ', get_theme_mod( 'blog_paper_site_description_font' ) );
	}

	if ( ! empty( get_theme_mod( 'blog_paper_header_font' ) ) ) {
		$font_families[] = str_replace( '+', ' ', get_theme_mod( 'blog_paper_header_font' ) );
	}

	if ( ! empty( get_theme_mod( 'blog_paper_body_font' ) ) ) {
		$font_families[] = str_replace( '+', ' ', get_theme_mod( 'blog_paper_body_font' ) );
	}

	$query_args = array(
		'family' => urlencode( implode( '|', $font_families ) ),
		'subset' => urlencode( $subsets ),
	);

	if ( $font_families ) {

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );

	}

	return esc_url_raw( $fonts_url );
}