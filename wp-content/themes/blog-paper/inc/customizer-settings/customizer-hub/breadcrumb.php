<?php
/**
 * Breadcrumb settings
 */

$wp_customize->add_section(
	'blog_paper_breadcrumb_section',
	array(
		'title' => esc_html__( 'Breadcrumb Options', 'blog-paper' ),
		'panel' => 'blog_paper_theme_customizer_hub_panel',
	)
);

// Breadcrumb enable setting.
$wp_customize->add_setting(
	'blog_paper_breadcrumb_enable',
	array(
		'default'           => true,
		'sanitize_callback' => 'blog_paper_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Blog_Paper_Toggle_Checkbox_Custom_control(
		$wp_customize,
		'blog_paper_breadcrumb_enable',
		array(
			'label'    => esc_html__( 'Enable breadcrumb.', 'blog-paper' ),
			'type'     => 'checkbox',
			'settings' => 'blog_paper_breadcrumb_enable',
			'section'  => 'blog_paper_breadcrumb_section',
		)
	)
);

// Breadcrumb - Separator.
$wp_customize->add_setting(
	'blog_paper_breadcrumb_separator',
	array(
		'sanitize_callback' => 'sanitize_text_field',
		'default'           => '/',
	)
);

$wp_customize->add_control(
	'blog_paper_breadcrumb_separator',
	array(
		'label'           => esc_html__( 'Separator', 'blog-paper' ),
		'section'         => 'blog_paper_breadcrumb_section',
		'active_callback' => function( $control ) {
			return ( $control->manager->get_setting( 'blog_paper_breadcrumb_enable' )->value() );
		},
	)
);
