<?php

// Author Info Widget.
require get_template_directory() . '/inc/custom-widgets/info-author-widget.php';

// Tile List Widget.
require get_template_directory() . '/inc/custom-widgets/tile-list-widget.php';

// Social Widget.
require get_template_directory() . '/inc/custom-widgets/social-widget.php';

/**
 * Register Widgets
 */
function blog_paper_register_widgets() {

	register_widget( 'Blog_Paper_Author_Info_Widget' );

	register_widget( 'Blog_Paper_Tile_List_Widget' );

	register_widget( 'Blog_Paper_Social_Widget' );

}
add_action( 'widgets_init', 'blog_paper_register_widgets' );
