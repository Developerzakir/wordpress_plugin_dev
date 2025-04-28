<?php

/**
 * Theme Customizer Hub.
 */

$wp_customize->add_panel(
	'blog_paper_theme_customizer_hub_panel',
	array(
		'title'    => esc_html__( 'Customizer Hub', 'blog-paper' ),
		'priority' => 150,
	)
);

$theme_customizer_hub = array( 'font-options', 'breadcrumb', 'archive-options', 'sidebar-layout', 'pagination', 'single-post', 'footer' );

foreach ( $theme_customizer_hub as $customizer ) {
	require get_template_directory() . '/inc/customizer-settings/customizer-hub/' . $customizer . '.php';

}
