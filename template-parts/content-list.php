<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package nearshoring
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('post post--list'); ?>>
		<header class="post__header entry-header">
			<a class="post__link" href="<?php echo get_the_permalink(); ?>">
				<?php the_title( '<h2 class="post__title entry-title">', '</h2>' ); ?>
			</a>
		</header>

		<div class="post__content">
			<?php the_excerpt(); ?>
		</div>
</article>
