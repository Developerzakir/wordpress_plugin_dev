<?php
/**
 * Footer copyright
 */

// Footer copyright
$wp_customize->add_section(
	'blog_paper_footer_section',
	array(
		'title' => esc_html__( 'Footer Options', 'blog-paper' ),
		'panel' => 'blog_paper_theme_customizer_hub_panel',
	)
);

$copyright_default = sprintf( esc_html_x( 'Copyright &copy; %1$s %2$s', '1: Year, 2: Site Title with home URL', 'blog-paper' ), '[the-year]', '[site-link]' );

// Footer copyright setting.
$wp_customize->add_setting(
	'blog_paper_copyright_txt',
	array(
		'default'           => $copyright_default,
		'sanitize_callback' => 'blog_paper_sanitize_html',
	)
);

$wp_customize->add_control(
	'blog_paper_copyright_txt',
	array(
		'label'   => esc_html__( 'Copyright text', 'blog-paper' ),
		'section' => 'blog_paper_footer_section',
		'type'    => 'textarea',
	)
);
