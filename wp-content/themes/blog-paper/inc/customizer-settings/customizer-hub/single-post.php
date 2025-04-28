<?php
/**
 * Single Post Options
 */

$wp_customize->add_section(
	'blog_paper_single_page_options',
	array(
		'title' => esc_html__( 'Single Post Options', 'blog-paper' ),
		'panel' => 'blog_paper_theme_customizer_hub_panel',
	)
);

// Enable single post category setting.
$wp_customize->add_setting(
	'blog_paper_enable_single_category',
	array(
		'default'           => true,
		'sanitize_callback' => 'blog_paper_sanitize_checkbox',
	)
);

$wp_customize->add_control(
	new Blog_Paper_Toggle_Checkbox_Custom_control(
		$wp_customize,
		'blog_paper_enable_single_category',
		array(
			'label'    => esc_html__( 'Enable Category', 'blog-paper' ),
			'settings' => 'blog_paper_enable_single_category',
			'section'  => 'blog_paper_single_page_options',
			'type'     => 'checkbox',
		)
	)
);

// Enable single post author setting.
$wp_customize->add_setting(
	'blog_paper_enable_single_author',
	array(
		'default'           => true,
		'sanitize_callback' => 'blog_paper_sanitize_checkbox',
	)
);

$wp_customize->add_control(
	new Blog_Paper_Toggle_Checkbox_Custom_control(
		$wp_customize,
		'blog_paper_enable_single_author',
		array(
			'label'    => esc_html__( 'Enable Author', 'blog-paper' ),
			'settings' => 'blog_paper_enable_single_author',
			'section'  => 'blog_paper_single_page_options',
			'type'     => 'checkbox',
		)
	)
);

// Enable single post date setting.
$wp_customize->add_setting(
	'blog_paper_enable_single_date',
	array(
		'default'           => true,
		'sanitize_callback' => 'blog_paper_sanitize_checkbox',
	)
);

$wp_customize->add_control(
	new Blog_Paper_Toggle_Checkbox_Custom_control(
		$wp_customize,
		'blog_paper_enable_single_date',
		array(
			'label'    => esc_html__( 'Enable Date', 'blog-paper' ),
			'settings' => 'blog_paper_enable_single_date',
			'section'  => 'blog_paper_single_page_options',
			'type'     => 'checkbox',
		)
	)
);

// Enable single post tag setting.
$wp_customize->add_setting(
	'blog_paper_enable_single_tag',
	array(
		'default'           => true,
		'sanitize_callback' => 'blog_paper_sanitize_checkbox',
	)
);

$wp_customize->add_control(
	new Blog_Paper_Toggle_Checkbox_Custom_control(
		$wp_customize,
		'blog_paper_enable_single_tag',
		array(
			'label'    => esc_html__( 'Enable Post Tag', 'blog-paper' ),
			'settings' => 'blog_paper_enable_single_tag',
			'section'  => 'blog_paper_single_page_options',
			'type'     => 'checkbox',
		)
	)
);

// Single post related Posts title label.
$wp_customize->add_setting(
	'blog_paper_related_posts_title',
	array(
		'default'           => __( 'Related Posts', 'blog-paper' ),
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'blog_paper_related_posts_title',
	array(
		'label'    => esc_html__( 'Related Posts Title', 'blog-paper' ),
		'section'  => 'blog_paper_single_page_options',
		'settings' => 'blog_paper_related_posts_title',
	)
);

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial(
		'blog_paper_related_posts_title',
		array(
			'selector'            => '.theme-wrapper h2.related-title',
			'settings'            => 'blog_paper_related_posts_title',
			'container_inclusive' => false,
			'fallback_refresh'    => true,
		)
	);
}
