<?php
/**
 * Frontpage Customizer Settings
 *
 * @package Blog Paper
 *
 * Editor Choice Section
 */

$wp_customize->add_section(
	'blog_paper_editor_choice_section',
	array(
		'title' => esc_html__( 'Editor Choice Section', 'blog-paper' ),
		'panel' => 'blog_paper_frontpage_panel',
	)
);

// Editor Choice section enable settings.
$wp_customize->add_setting(
	'blog_paper_editor_choice_section_enable',
	array(
		'default'           => false,
		'sanitize_callback' => 'blog_paper_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Blog_Paper_Toggle_Checkbox_Custom_control(
		$wp_customize,
		'blog_paper_editor_choice_section_enable',
		array(
			'label'    => esc_html__( 'Enable Editor Choice Section', 'blog-paper' ),
			'type'     => 'checkbox',
			'settings' => 'blog_paper_editor_choice_section_enable',
			'section'  => 'blog_paper_editor_choice_section',
		)
	)
);

// Editor Choice title settings.
$wp_customize->add_setting(
	'blog_paper_editor_choice_title',
	array(
		'default'           => __( 'Editor Choice', 'blog-paper' ),
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'blog_paper_editor_choice_title',
	array(
		'label'           => esc_html__( 'Section Title', 'blog-paper' ),
		'section'         => 'blog_paper_editor_choice_section',
		'active_callback' => 'blog_paper_if_editor_choice_enabled',
	)
);

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial(
		'blog_paper_editor_choice_title',
		array(
			'selector'            => '.blog-editors-choice h3.section-title',
			'settings'            => 'blog_paper_editor_choice_title',
			'container_inclusive' => false,
			'fallback_refresh'    => true,
		)
	);
}

// editor_choice content type settings.
$wp_customize->add_setting(
	'blog_paper_editor_choice_content_type',
	array(
		'default'           => 'post',
		'sanitize_callback' => 'blog_paper_sanitize_select',
	)
);

$wp_customize->add_control(
	'blog_paper_editor_choice_content_type',
	array(
		'label'           => esc_html__( 'Content type:', 'blog-paper' ),
		'description'     => esc_html__( 'Choose where you want to render the content from.', 'blog-paper' ),
		'section'         => 'blog_paper_editor_choice_section',
		'type'            => 'select',
		'active_callback' => 'blog_paper_if_editor_choice_enabled',
		'choices'         => array(
			'post'     => esc_html__( 'Post', 'blog-paper' ),
			'category' => esc_html__( 'Category', 'blog-paper' ),
		),
	)
);

$editor_choice_count = get_theme_mod( 'blog_paper_editor_choice_count', 3 );

for ( $i = 1; $i <= $editor_choice_count; $i++ ) {
	// editor_choice post setting.
	$wp_customize->add_setting(
		'blog_paper_editor_choice_post_' . $i,
		array(
			'sanitize_callback' => 'blog_paper_sanitize_dropdown_pages',
		)
	);

	$wp_customize->add_control(
		'blog_paper_editor_choice_post_' . $i,
		array(
			'label'           => sprintf( esc_html__( 'Post %d', 'blog-paper' ), $i ),
			'section'         => 'blog_paper_editor_choice_section',
			'type'            => 'select',
			'choices'         => blog_paper_get_post_choices(),
			'active_callback' => 'blog_paper_editor_choice_section_content_type_post_enabled',
		)
	);

}

// editor_choice category setting.
$wp_customize->add_setting(
	'blog_paper_editor_choice_category',
	array(
		'sanitize_callback' => 'blog_paper_sanitize_select',
	)
);

$wp_customize->add_control(
	'blog_paper_editor_choice_category',
	array(
		'label'           => esc_html__( 'Category', 'blog-paper' ),
		'section'         => 'blog_paper_editor_choice_section',
		'type'            => 'select',
		'choices'         => blog_paper_get_post_cat_choices(),
		'active_callback' => 'blog_paper_editor_choice_section_content_type_category_enabled',
	)
);

/*========================Active Callback==============================*/
function blog_paper_if_editor_choice_enabled( $control ) {
	return $control->manager->get_setting( 'blog_paper_editor_choice_section_enable' )->value();
}
function blog_paper_editor_choice_section_content_type_post_enabled( $control ) {
	$content_type = $control->manager->get_setting( 'blog_paper_editor_choice_content_type' )->value();
	return blog_paper_if_editor_choice_enabled( $control ) && ( 'post' === $content_type );
}
function blog_paper_editor_choice_section_content_type_category_enabled( $control ) {
	$content_type = $control->manager->get_setting( 'blog_paper_editor_choice_content_type' )->value();
	return blog_paper_if_editor_choice_enabled( $control ) && ( 'category' === $content_type );
}

/*========================Partial Refresh==============================*/
if ( ! function_exists( 'blog_paper_editor_choice_title_text_partial' ) ) :
	// Title.
	function blog_paper_editor_choice_title_text_partial() {
		return esc_html( get_theme_mod( 'blog_paper_editor_choice_title' ) );
	}
endif;
