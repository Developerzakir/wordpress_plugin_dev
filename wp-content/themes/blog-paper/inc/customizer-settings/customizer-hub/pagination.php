<?php
/**
 * Pagination setting
 */

// Pagination setting.
$wp_customize->add_section(
	'blog_paper_pagination',
	array(
		'title' => esc_html__( 'Pagination', 'blog-paper' ),
		'panel' => 'blog_paper_theme_customizer_hub_panel',
	)
);

// Pagination enable setting.
$wp_customize->add_setting(
	'blog_paper_pagination_enable',
	array(
		'default'           => true,
		'sanitize_callback' => 'blog_paper_sanitize_checkbox',
	)
);

$wp_customize->add_control(
	new Blog_Paper_Toggle_Checkbox_Custom_control(
		$wp_customize,
		'blog_paper_pagination_enable',
		array(
			'label'    => esc_html__( 'Enable Pagination.', 'blog-paper' ),
			'settings' => 'blog_paper_pagination_enable',
			'section'  => 'blog_paper_pagination',
			'type'     => 'checkbox',
		)
	)
);

// Pagination - Pagination Style.
$wp_customize->add_setting(
	'blog_paper_pagination_type',
	array(
		'default'           => 'numeric',
		'sanitize_callback' => 'blog_paper_sanitize_select',
	)
);

$wp_customize->add_control(
	'blog_paper_pagination_type',
	array(
		'label'           => esc_html__( 'Pagination Style', 'blog-paper' ),
		'section'         => 'blog_paper_pagination',
		'type'            => 'select',
		'choices'         => array(
			'default' => __( 'Default (Older/Newer)', 'blog-paper' ),
			'numeric' => __( 'Numeric', 'blog-paper' ),
		),
		'active_callback' => 'blog_paper_pagination_enabled',
	)
);

/*========================Active Callback==============================*/
function blog_paper_pagination_enabled( $control ) {
	return $control->manager->get_setting( 'blog_paper_pagination_enable' )->value();
}
