<?php
/**
 * Theme functions and definitions
 *
 * @package NewsBlogy
 */

/**
 * After setup theme hook
 */
function newsblogy_theme_setup(){
    /*
     * Make child theme available for translation.
     * Translations can be filed in the /languages/ directory.
     */
    load_child_theme_textdomain( 'newsblogy' );	
}
add_action( 'after_setup_theme', 'newsblogy_theme_setup' );

/**
 * Load assets.
 */

function newsblogy_theme_css() {
	wp_enqueue_style( 'newsblogy-parent-theme-style', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'newsblogy_theme_css', 99);

/*=========================================
 NewsBlogy Remove Customize Panel from parent theme
=========================================*/
function newsblogy_remove_parent_setting( $wp_customize ) {
	$wp_customize->remove_control('NewsMunch_hdr_social_head');
	$wp_customize->remove_control('newsmunch_hs_hdr_social');
	$wp_customize->remove_control('newsmunch_hdr_social');
	$wp_customize->remove_control('newsmunch_hdr_banner');
	$wp_customize->remove_control('newsmunch_hs_hdr_banner');
	$wp_customize->remove_control('newsmunch_hdr_banner_img');
	$wp_customize->remove_control('newsmunch_hdr_banner_link');
	$wp_customize->remove_control('newsmunch_hdr_banner_target');
	$wp_customize->remove_control('slider_right_options_head');
	$wp_customize->remove_control('newsmunch_hs_slider_right');
	$wp_customize->remove_control('newsmunch_slider_right_ttl');
	$wp_customize->remove_control('newsmunch_tabfirst_cat');
	$wp_customize->remove_control('newsmunch_tabsecond_cat');
	$wp_customize->remove_control('newsmunch_tabthird_cat');
	$wp_customize->remove_control('newsmunch_hs_slider_tab_title');
	$wp_customize->remove_control('newsmunch_hs_slider_tab_cat_meta');
	$wp_customize->remove_control('newsmunch_hs_slider_tab_date_meta');
	$wp_customize->remove_control('newsmunch_num_slides_tab');
}
add_action( 'customize_register', 'newsblogy_remove_parent_setting',99 );


/*=========================================
NewsMunch Main Slider
=========================================*/
if ( ! function_exists( 'newsblogy_site_slider_main' ) ) :
function newsblogy_site_slider_main() {
	$newsmunch_slider_position		= get_theme_mod('newsmunch_slider_position','left') == 'left' ? '': 'dt-flex-row-reverse'; 
	$newsmunch_slider_ttl			= get_theme_mod('newsmunch_slider_ttl','Main Story');
	$newsmunch_slider_cat			= get_theme_mod('newsmunch_slider_cat','0');
	$newsmunch_num_slides			= get_theme_mod('newsmunch_num_slides','6');
	$newsmunch_slider_posts			= newsmunch_get_posts($newsmunch_num_slides, $newsmunch_slider_cat);
	$newsmunch_hs_slider_title		= get_theme_mod('newsmunch_hs_slider_title','1');
	$newsmunch_hs_slider_cat_meta	= get_theme_mod('newsmunch_hs_slider_cat_meta','1');
	$newsmunch_hs_slider_auth_meta	= get_theme_mod('newsmunch_hs_slider_auth_meta','1');
	$newsmunch_hs_slider_date_meta	= get_theme_mod('newsmunch_hs_slider_date_meta','1');
	$newsmunch_hs_slider_comment_meta= get_theme_mod('newsmunch_hs_slider_comment_meta','1');
	$newsmunch_hs_slider_views_meta	= get_theme_mod('newsmunch_hs_slider_views_meta','1');
	if(!empty($newsmunch_slider_ttl)):
	 ?>
		<div class="widget-header sl-main">
			<h4 class="widget-title"><?php echo wp_kses_post($newsmunch_slider_ttl); ?></h4>
		</div>
	<?php endif; ?>
	<div class="post-carousel-banner post-carousel-column3" data-slick='{"slidesToShow": 3, "slidesToScroll": 1}'>
		<?php
			if ($newsmunch_slider_posts->have_posts()) :
			while ($newsmunch_slider_posts->have_posts()) : $newsmunch_slider_posts->the_post();

			global $post;
			$format = get_post_format() ? : 'standard';	
		?>
			<div class="post featured-post-lg">
				<div class="details clearfix">
					<?php if($newsmunch_hs_slider_cat_meta=='1'): newsmunch_getpost_categories();  endif; ?>
					<?php if($newsmunch_hs_slider_title=='1'): newsmunch_common_post_title('h2','post-title'); endif; ?> 
					<ul class="meta list-inline dt-mt-0 dt-mb-0 dt-mt-3">
						<?php if($newsmunch_hs_slider_auth_meta=='1'): ?>
							<li class="list-inline-item"><i class="far fa-user-circle"></i> <?php esc_html_e('By','newsblogy');?> <a href="<?php echo esc_url(get_author_posts_url( absint(get_the_author_meta( 'ID' )) ));?>"><?php echo esc_html(get_the_author()); ?></a></li>
						<?php endif; ?>	
						
						<?php if($newsmunch_hs_slider_date_meta=='1'): ?>
							<li class="list-inline-item"><i class="far fa-calendar-alt"></i> <?php echo esc_html(get_the_date( 'F j, Y' )); ?></li>
						<?php endif; ?>	
						
						<?php if($newsmunch_hs_slider_comment_meta=='1'): ?>
							<li class="list-inline-item"><i class="far fa-comments"></i> <?php echo esc_html(get_comments_number($post->ID)); ?></li>
						<?php endif; ?>	
						
						<?php if($newsmunch_hs_slider_views_meta=='1'): ?>
							<li class="list-inline-item"><i class="far fa-eye"></i> <?php echo wp_kses_post(newsmunch_get_post_view()); ?></li>
						<?php endif; newsmunch_edit_post_link(); ?>
					</ul>
				</div>
				<div class="thumb">
					<?php if ( $format !== 'standard'): ?>
						<span class="post-format-sm">
							<?php do_action('newsmunch_post_format_icon_type'); ?>
						</span>
					<?php endif; ?>
					<a href="<?php echo esc_url(get_permalink()); ?>">
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="inner data-bg-image" data-bg-image="<?php echo esc_url(get_the_post_thumbnail_url()); ?>"></div>
						<?php else: ?>
							<div class="inner"></div>
						<?php endif; ?>
					</a>
				</div>
			</div>
		<?php endwhile;endif;wp_reset_postdata(); ?>
	</div>
	<?php
	} 
endif;
add_action( 'newsblogy_site_slider_main', 'newsblogy_site_slider_main' );

/**
 * Sample implementation of the Custom Header feature
 */
function newsblogy_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'newsblogy_custom_header_args', array(
		'default-image'          => esc_url(get_stylesheet_directory_uri() . '/assets/images/banner.png'),
		'default-text-color'     => 'fff',
		'width'                  => 1920,
		'height'                 => 200,
		'flex-height'            => true,
		'wp-head-callback'       => 'newsmunch_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'newsblogy_custom_header_setup' );

/**
 * Import Options From Parent Theme
 *
 */
function newsblogy_parent_theme_options() {
	$newsmunch_mods = get_option( 'theme_mods_newsmunch' );
	if ( ! empty( $newsmunch_mods ) ) {
		foreach ( $newsmunch_mods as $newsmunch_mod_k => $newsmunch_mod_v ) {
			set_theme_mod( $newsmunch_mod_k, $newsmunch_mod_v );
		}
	}
}
add_action( 'after_switch_theme', 'newsblogy_parent_theme_options' );