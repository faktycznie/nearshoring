<?php
/**
 * Template part for displaying latest posts on the front page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package nearshoring
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('post post--box'); ?>>
	<a class="post__link" href="<?php echo get_the_permalink(); ?>" rel="bookmark">
		<div class="post__meta entry-meta">
			<?php nearshoring_posted_on(); ?>
		</div>
		<header class="post__header entry-header">
			<?php the_title( '<h2 class="post__title entry-title">', '</h2>' ); ?>
		</header>
		<footer class="post__footer entry-footer">
			<?php nearshoring_entry_readmore(); ?>
		</footer>
	</a>
</article>
