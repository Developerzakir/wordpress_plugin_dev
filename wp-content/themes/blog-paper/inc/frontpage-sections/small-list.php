<?php
/**
 * Frontpage Small List Section.
 *
 * @package Blog Paper
 */

// Small List Section.
$small_list_section = get_theme_mod( 'blog_paper_small_list_section_enable', false );

if ( false === $small_list_section ) {
	return;
}

$content_ids             = array();
$small_list_content_type = get_theme_mod( 'blog_paper_small_list_content_type', 'post' );

if ( $small_list_content_type === 'post' ) {

	for ( $i = 1; $i <= 4; $i++ ) {
		$content_ids[] = get_theme_mod( 'blog_paper_small_list_post_' . $i );
	}

	$args = array(
		'post_type'           => 'post',
		'posts_per_page'      => absint( 4 ),
		'ignore_sticky_posts' => true,
	);

	if ( ! empty( array_filter( $content_ids ) ) ) {
		$args['post__in'] = array_filter( $content_ids );
		$args['orderby']  = 'post__in';
	} else {
		$args['orderby'] = 'date';
	}

} else {
	$cat_content_id = get_theme_mod( 'blog_paper_small_list_category' );
	$args           = array(
		'cat'            => $cat_content_id,
		'posts_per_page' => absint( 4 ),
	);
}

$query = new WP_Query( $args );
if ( $query->have_posts() ) {
	?>

	<section id="blog_paper_small_list_section" class="small-list section-divider">
		<div class="site-container-width">
			<div class="container-wrap">

				<?php
				while ( $query->have_posts() ) :
					$query->the_post();
					?>
					<div class="single-card-container list-card">
						<div class="single-card-image">
							<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
						</div>
						<div class="single-card-detail">
							<h3 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<div class="card-meta">
								<span class="post-author">
									<?php blog_paper_posted_by(); ?>
								</span>
							</div>
						</div>
					</div>

					<?php
				endwhile;
				wp_reset_postdata();
				?>
			</div>
		</div>
	</section>

	<?php
}
