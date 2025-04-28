<?php
/**
 * Frontpage Customizer Settings
 *
 * @package Blog Paper
 *
 * Small List Section
 */

$wp_customize->add_section(
	'blog_paper_small_list_section',
	array(
		'title' => esc_html__( 'Small List Section', 'blog-paper' ),
		'panel' => 'blog_paper_frontpage_panel',
	)
);

// Small List section enable settings.
$wp_customize->add_setting(
	'blog_paper_small_list_section_enable',
	array(
		'default'           => false,
		'sanitize_callback' => 'blog_paper_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Blog_Paper_Toggle_Checkbox_Custom_control(
		$wp_customize,
		'blog_paper_small_list_section_enable',
		array(
			'label'    => esc_html__( 'Enable Small List Section', 'blog-paper' ),
			'type'     => 'checkbox',
			'settings' => 'blog_paper_small_list_section_enable',
			'section'  => 'blog_paper_small_list_section',
		)
	)
);

// Small List content type settings.
$wp_customize->add_setting(
	'blog_paper_small_list_content_type',
	array(
		'default'           => 'post',
		'sanitize_callback' => 'blog_paper_sanitize_select',
	)
);

$wp_customize->add_control(
	'blog_paper_small_list_content_type',
	array(
		'label'           => esc_html__( 'Content type:', 'blog-paper' ),
		'description'     => esc_html__( 'Choose where you want to render the content from.', 'blog-paper' ),
		'section'         => 'blog_paper_small_list_section',
		'type'            => 'select',
		'active_callback' => 'blog_paper_if_small_list_enabled',
		'choices'         => array(
			'post'     => esc_html__( 'Post', 'blog-paper' ),
			'category' => esc_html__( 'Category', 'blog-paper' ),
		),
	)
);

for ( $i = 1; $i <= 4; $i++ ) {
	// Small List post setting.
	$wp_customize->add_setting(
		'blog_paper_small_list_post_' . $i,
		array(
			'sanitize_callback' => 'blog_paper_sanitize_dropdown_pages',
		)
	);

	$wp_customize->add_control(
		'blog_paper_small_list_post_' . $i,
		array(
			'label'           => sprintf( esc_html__( 'Post %d', 'blog-paper' ), $i ),
			'section'         => 'blog_paper_small_list_section',
			'type'            => 'select',
			'choices'         => blog_paper_get_post_choices(),
			'active_callback' => 'blog_paper_small_list_section_content_type_post_enabled',
		)
	);

}

// Small List category setting.
$wp_customize->add_setting(
	'blog_paper_small_list_category',
	array(
		'sanitize_callback' => 'blog_paper_sanitize_select',
	)
);

$wp_customize->add_control(
	'blog_paper_small_list_category',
	array(
		'label'           => esc_html__( 'Category', 'blog-paper' ),
		'section'         => 'blog_paper_small_list_section',
		'type'            => 'select',
		'choices'         => blog_paper_get_post_cat_choices(),
		'active_callback' => 'blog_paper_small_list_section_content_type_category_enabled',
	)
);

/*========================Active Callback==============================*/
function blog_paper_if_small_list_enabled( $control ) {
	return $control->manager->get_setting( 'blog_paper_small_list_section_enable' )->value();
}
function blog_paper_small_list_section_content_type_post_enabled( $control ) {
	$content_type = $control->manager->get_setting( 'blog_paper_small_list_content_type' )->value();
	return blog_paper_if_small_list_enabled( $control ) && ( 'post' === $content_type );
}
function blog_paper_small_list_section_content_type_category_enabled( $control ) {
	$content_type = $control->manager->get_setting( 'blog_paper_small_list_content_type' )->value();
	return blog_paper_if_small_list_enabled( $control ) && ( 'category' === $content_type );
}
