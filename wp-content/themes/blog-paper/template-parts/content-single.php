<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blog Paper
 */

$single_date       = get_theme_mod( 'blog_paper_enable_single_date', true );
$single_author     = get_theme_mod( 'blog_paper_enable_single_author', true );
$single_category   = get_theme_mod( 'blog_paper_enable_single_category', true );
$single_tag        = get_theme_mod( 'blog_paper_enable_single_tag', true );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="single-page">
		<div class="page-header-content">
			<?php if ( $single_category === true ) { ?>
				<div class="entry-cat">
					<?php blog_paper_categories_list(); ?>
				</div>
			<?php } ?>
			<?php if ( is_singular() ) : ?>
					<header class="entry-header">
						<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					</header><!-- .entry-header -->
				<?php
				if ( 'post' === get_post_type() ) {
					setup_postdata( get_post() );
					?>
					<ul class="entry-meta">
						<?php if ( $single_author === true ) { ?>
							<li class="post-author"><?php blog_paper_posted_by(); ?></li>
						<?php } ?>
						<?php if ( $single_date === true ) { ?>
							<span class="post-date"><?php blog_paper_posted_on(); ?></span>
						<?php } ?>
					</ul><!-- .entry-meta -->
				<?php } ?>
			<?php endif; ?>

			<?php
			if ( has_excerpt() ) {
				the_excerpt();
			}
			?>
		</div>
		<?php blog_paper_post_thumbnail(); ?>
			<div class="entry-content">
				<?php
				the_content(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'blog-paper' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						wp_kses_post( get_the_title() )
					)
				);
				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'blog-paper' ),
						'after'  => '</div>',
					)
				);
				?>
			</div><!-- .entry-content -->
		<footer class="entry-footer">
			<?php
			if ( $single_tag === true ) {
				blog_paper_entry_footer();
			}
			?>
		</footer><!-- .entry-footer -->
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
