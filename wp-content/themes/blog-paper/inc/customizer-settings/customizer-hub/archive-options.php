<?php
/**
 * Blog / Archive Options
 */

$wp_customize->add_section(
	'blog_paper_archive_page_options',
	array(
		'title' => esc_html__( 'Blog / Archive Pages Options', 'blog-paper' ),
		'panel' => 'blog_paper_theme_customizer_hub_panel',
	)
);

// Excerpt - Excerpt Length.
$wp_customize->add_setting(
	'blog_paper_excerpt_length',
	array(
		'default'           => 30,
		'sanitize_callback' => 'blog_paper_sanitize_number_range',
	)
);

$wp_customize->add_control(
	'blog_paper_excerpt_length',
	array(
		'label'       => esc_html__( 'Excerpt Length (no. of words)', 'blog-paper' ),
		'section'     => 'blog_paper_archive_page_options',
		'settings'    => 'blog_paper_excerpt_length',
		'type'        => 'number',
		'input_attrs' => array(
			'min'  => 5,
			'max'  => 200,
			'step' => 1,
		),
	)
);

// Enable archive page category setting.
$wp_customize->add_setting(
	'blog_paper_enable_archive_category',
	array(
		'default'           => true,
		'sanitize_callback' => 'blog_paper_sanitize_checkbox',
	)
);

$wp_customize->add_control(
	new Blog_Paper_Toggle_Checkbox_Custom_control(
		$wp_customize,
		'blog_paper_enable_archive_category',
		array(
			'label'    => esc_html__( 'Enable Category', 'blog-paper' ),
			'settings' => 'blog_paper_enable_archive_category',
			'section'  => 'blog_paper_archive_page_options',
			'type'     => 'checkbox',
		)
	)
);

// Enable archive page author setting.
$wp_customize->add_setting(
	'blog_paper_enable_archive_author',
	array(
		'default'           => true,
		'sanitize_callback' => 'blog_paper_sanitize_checkbox',
	)
);

$wp_customize->add_control(
	new Blog_Paper_Toggle_Checkbox_Custom_control(
		$wp_customize,
		'blog_paper_enable_archive_author',
		array(
			'label'    => esc_html__( 'Enable Author', 'blog-paper' ),
			'settings' => 'blog_paper_enable_archive_author',
			'section'  => 'blog_paper_archive_page_options',
			'type'     => 'checkbox',
		)
	)
);

// Enable archive page date setting.
$wp_customize->add_setting(
	'blog_paper_enable_archive_date',
	array(
		'default'           => true,
		'sanitize_callback' => 'blog_paper_sanitize_checkbox',
	)
);

$wp_customize->add_control(
	new Blog_Paper_Toggle_Checkbox_Custom_control(
		$wp_customize,
		'blog_paper_enable_archive_date',
		array(
			'label'    => esc_html__( 'Enable Date', 'blog-paper' ),
			'settings' => 'blog_paper_enable_archive_date',
			'section'  => 'blog_paper_archive_page_options',
			'type'     => 'checkbox',
		)
	)
);
