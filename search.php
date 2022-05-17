
<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
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
				<header class="page-header">
					<h1 class="page-title">
						<?php
						/* translators: %s: search query. */
						printf( esc_html__( 'Wyniki wyszukiwania: %s', 'nearshoring' ), '<strong>' . get_search_query() . '</strong>' );
						?>
					</h1>
				</header>
				<div class="posts">
				<?php

				if( get_search_query() === 'JDP' ) { ?>
					<article id="post-JDP" class="post post--list">
							<header class="post__header entry-header">
								<a class="post__link" href="<?php _e('https://jdp-law.pl', 'nearshoring'); ?>" target="_blank">
									<h2 class="post__title entry-title"><?php _e('Kancelaria JDP', 'nearshoring'); ?></h2>
								</a>
							</header>
					</article>
				<?php }

				while ( have_posts() ) :
					the_post();

					get_template_part( 'template-parts/content', 'list' );

				endwhile; // End of the loop.

				?>
				</div>
			</div>
		</main>
		<?php get_sidebar(); ?>
	</div>
</div>
<?php

get_footer();
