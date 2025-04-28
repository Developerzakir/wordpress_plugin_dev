<?php

// Home Page Customizer panel.
$wp_customize->add_panel(
	'blog_paper_frontpage_panel',
	array(
		'title'    => esc_html__( 'Frontpage Sections', 'blog-paper' ),
		'priority' => 140,
	)
);

require get_template_directory() . '/inc/customizer-settings/frontpage-customizer/small-list.php';
require get_template_directory() . '/inc/customizer-settings/frontpage-customizer/editor-choice.php';
