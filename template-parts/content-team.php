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

		$args = array(
			'post_type' => 'post',
			'posts_per_page' => -1,
			'meta_query' => array(
					array(
						'key'     => 'sec_autor',
						'value'   => '"' . get_the_ID() . '"',
						'compare' => 'LIKE',
					),
				),
			);

		$the_query = new WP_Query($args);

		// The Loop
		if ( $the_query->have_posts() ) {
			echo '<ul>';
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				echo '<li><a href="'. get_the_permalink() . '">' . get_the_title() . '</a></li>';
			}
			echo '</ul>';
		} else {
			echo 'no posts';
		}
		/* Restore original Post Data */
		wp_reset_postdata();

		?>
	</div>
	<footer class="post__footer">
		<?php nearshoring_entry_footer(); ?>
	</footer>
</article>
