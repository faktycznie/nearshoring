<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package nearshoring
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php nearshoring_post_thumbnail(); ?>
	<header class="page__header">
		<?php the_title( '<h1 class="page__title">', '</h1>' ); ?>
	</header>
	<div class="page__content">
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="page__links">' . esc_html__( 'Strony:', 'nearshoring' ),
				'after'  => '</div>',
			)
		);
		?>
	</div>
	<?php if ( get_edit_post_link() ) : ?>
		<footer class="page__footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'nearshoring' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer>
	<?php endif; ?>
</article>
