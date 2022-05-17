<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package nearshoring
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
	<?php nearshoring_post_thumbnail(); ?>
	<header class="post__header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="post__title">', '</h1>' );
		else :
			the_title( '<h2 class="post__title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="post__meta">
				<?php nearshoring_posted_on(); ?>
			</div>
		<?php endif; ?>
	</header>
	<div class="post__content">
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="post__links">' . esc_html__( 'Strony:', 'nearshoring' ),
				'after'  => '</div>',
			)
		);
		?>
	</div>
	<footer class="post__footer">
		<?php nearshoring_entry_footer(); ?>
	</footer>
</article>
