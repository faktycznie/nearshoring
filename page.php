<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package nearshoring
 */

get_header();

get_template_part( 'template-parts/breadcrumbs');
?>
<div class="main container">
	<div class="main__row row">
		<main class="content col-md-9 col-sm-12 col-xs-12">
			<div class="content__container">
			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>
			</div>
		</main>
		<?php get_sidebar(); ?>
	</div>
</div>
<?php

get_footer();
