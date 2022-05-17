<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package nearshoring
 */


get_header();

// if ( function_exists('yoast_breadcrumb') ) {
// 	yoast_breadcrumb( '<section class="breadcrumbs"><div class="breadcrumbs__container container">','</div></section>' );
// }
?>
<div class="main container">
	<div class="main__row row">
		<main class="content col-md-9 col-sm-12 col-xs-12">
			<div class="content__container">
			<?php
				get_template_part( 'template-parts/content', 'none' );
			?>
			</div>
		</main>
		<?php get_sidebar(); ?>
	</div>
</div>
<?php

get_footer();