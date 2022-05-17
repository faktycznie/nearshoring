<?php
/**
 * The template for displaying all posts
 *
 * This is the template that displays all posts by default.
 * Please note that this is the WordPress construct of posts
 * and that other 'posts' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package nearshoring
 */

get_header();
?>

<div class="main container">
	<div class="main__row row">

		<main class="col-md-9">

			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', 'list' );

			endwhile; // End of the loop.
			?>

		</main>

		<?php get_sidebar(); ?>

	</div>
</div>

<?php

get_footer();
