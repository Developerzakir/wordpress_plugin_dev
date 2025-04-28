<?php
/**
 * Sidebar settings
 */

$wp_customize->add_section(
	'blog_paper_sidebar_option',
	array(
		'title' => esc_html__( 'Sidebar Options', 'blog-paper' ),
		'panel' => 'blog_paper_theme_customizer_hub_panel',
	)
);

// Sidebar Option - Archive Sidebar Position.
$wp_customize->add_setting(
	'blog_paper_archive_sidebar_position',
	array(
		'sanitize_callback' => 'blog_paper_sanitize_select',
		'default'           => 'right-sidebar',
	)
);

$wp_customize->add_control(
	'blog_paper_archive_sidebar_position',
	array(
		'label'   => esc_html__( 'Archive Sidebar Position', 'blog-paper' ),
		'section' => 'blog_paper_sidebar_option',
		'type'    => 'select',
		'choices' => array(
			'right-sidebar' => esc_html__( 'Right Sidebar', 'blog-paper' ),
			'no-sidebar'    => esc_html__( 'No Sidebar', 'blog-paper' ),
		),
	)
);

// Sidebar Option - Post Sidebar Position.
$wp_customize->add_setting(
	'blog_paper_post_sidebar_position',
	array(
		'sanitize_callback' => 'blog_paper_sanitize_select',
		'default'           => 'right-sidebar',
	)
);

$wp_customize->add_control(
	'blog_paper_post_sidebar_position',
	array(
		'label'   => esc_html__( 'Post Sidebar Position', 'blog-paper' ),
		'section' => 'blog_paper_sidebar_option',
		'type'    => 'select',
		'choices' => array(
			'right-sidebar' => esc_html__( 'Right Sidebar', 'blog-paper' ),
			'no-sidebar'    => esc_html__( 'No Sidebar', 'blog-paper' ),
		),
	)
);

// Sidebar Option - Page Sidebar Position.
$wp_customize->add_setting(
	'blog_paper_page_sidebar_position',
	array(
		'sanitize_callback' => 'blog_paper_sanitize_select',
		'default'           => 'right-sidebar',
	)
);

$wp_customize->add_control(
	'blog_paper_page_sidebar_position',
	array(
		'label'   => esc_html__( 'Page Sidebar Position', 'blog-paper' ),
		'section' => 'blog_paper_sidebar_option',
		'type'    => 'select',
		'choices' => array(
			'right-sidebar' => esc_html__( 'Right Sidebar', 'blog-paper' ),
			'no-sidebar'    => esc_html__( 'No Sidebar', 'blog-paper' ),
		),
	)
);
