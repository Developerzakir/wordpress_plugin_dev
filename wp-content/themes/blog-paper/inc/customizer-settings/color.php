<?php

/**
 * Color Options
 */

// Site tagline color setting.
$wp_customize->add_setting(
	'blog_paper_header_tagline',
	array(
		'default'           => '#ffffff',
		'sanitize_callback' => 'blog_paper_sanitize_hex_color',
	)
);

$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'blog_paper_header_tagline',
		array(
			'label'   => esc_html__( 'Site tagline Color', 'blog-paper' ),
			'section' => 'colors',
		)
	)
);
