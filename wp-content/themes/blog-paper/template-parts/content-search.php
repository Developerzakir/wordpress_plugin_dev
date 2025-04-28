<?php
/**
 * Template part for displaying posts search
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blog Paper
 */

$archive_category   = get_theme_mod( 'blog_paper_enable_archive_category', true );
$archive_author     = get_theme_mod( 'blog_paper_enable_archive_author', true );
$archive_date       = get_theme_mod( 'blog_paper_enable_archive_date', true );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="single-card-container list-card">
		<div class="single-card-image">
			<?php blog_paper_post_thumbnail(); ?>
		</div>
		<div class="single-card-detail">
			<?php if ( $archive_category === true ) : ?>
				<div class="card-categories">
					<?php blog_paper_categories_list(); ?>
				</div>
			<?php endif; ?>
			<?php
			if ( is_singular() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h2 class="card-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif;
			?>
			<div class="post-excerpt">
				<?php echo wp_kses_post( wp_trim_words( get_the_excerpt(), get_theme_mod( 'blog_paper_excerpt_length', 30 ) ) ); ?>
			</div><!-- post-excerpt -->
			<?php
			if ( 'post' === get_post_type() ) :
				?>
				<div class="card-meta">
					<?php if ( $archive_author === true ) : ?>
						<span class="post-author"><?php blog_paper_posted_by(); ?></span>
					<?php endif; ?>
					<?php if ( $archive_date === true ) : ?>
						<span class="post-date"><?php blog_paper_posted_on(); ?></span>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
