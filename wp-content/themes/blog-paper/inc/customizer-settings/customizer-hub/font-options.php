<?php

/**
 * Font section
 */

// Font section.
$wp_customize->add_section(
	'blog_paper_font_options',
	array(
		'title' => esc_html__( 'Font ( Typography ) Options', 'blog-paper' ),
		'panel' => 'blog_paper_theme_customizer_hub_panel',
	)
);

// Typography - Site Title Font.
$wp_customize->add_setting(
	'blog_paper_site_title_font',
	array(
		'default'           => '',
		'sanitize_callback' => 'blog_paper_sanitize_google_fonts',
	)
);

$wp_customize->add_control(
	'blog_paper_site_title_font',
	array(
		'label'    => esc_html__( 'Site Title Font Family', 'blog-paper' ),
		'section'  => 'blog_paper_font_options',
		'settings' => 'blog_paper_site_title_font',
		'type'     => 'select',
		'choices'  => blog_paper_font_choices(),
	)
);

// Typography - Site Description Font.
$wp_customize->add_setting(
	'blog_paper_site_description_font',
	array(
		'default'           => '',
		'sanitize_callback' => 'blog_paper_sanitize_google_fonts',
	)
);

$wp_customize->add_control(
	'blog_paper_site_description_font',
	array(
		'label'    => esc_html__( 'Site Description Font Family', 'blog-paper' ),
		'section'  => 'blog_paper_font_options',
		'settings' => 'blog_paper_site_description_font',
		'type'     => 'select',
		'choices'  => blog_paper_font_choices(),
	)
);

// Typography - Header Font.
$wp_customize->add_setting(
	'blog_paper_header_font',
	array(
		'default'           => '',
		'sanitize_callback' => 'blog_paper_sanitize_google_fonts',
	)
);

$wp_customize->add_control(
	'blog_paper_header_font',
	array(
		'label'    => esc_html__( 'Header Font Family', 'blog-paper' ),
		'section'  => 'blog_paper_font_options',
		'settings' => 'blog_paper_header_font',
		'type'     => 'select',
		'choices'  => blog_paper_font_choices(),
	)
);

// Typography - Body Font.
$wp_customize->add_setting(
	'blog_paper_body_font',
	array(
		'default'           => '',
		'sanitize_callback' => 'blog_paper_sanitize_google_fonts',
	)
);

$wp_customize->add_control(
	'blog_paper_body_font',
	array(
		'label'    => esc_html__( 'Body Font Family', 'blog-paper' ),
		'section'  => 'blog_paper_font_options',
		'settings' => 'blog_paper_body_font',
		'type'     => 'select',
		'choices'  => blog_paper_font_choices(),
	)
);
