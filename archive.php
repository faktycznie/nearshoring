<?php
/**
 * The template for displaying archive pages
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
					$queried_object = get_queried_object();
					$cat = ( $queried_object->taxonomy == 'category' ) ? true : false;

					if( $cat ) { //single taxonomy term

						$term_id = $queried_object->term_id;
						$term_name = $queried_object->name;
						$num = get_field('number', 'category' . '_' . $term_id);
						if( !empty($num) ) {
							?>
							<div class="single-section">
								<section class="categories categories--boxed categories--single">
									<ul class="categories__list">
									<?php
									$bg = get_field('cat_image', 'category' . '_' . $term_id);
									$bg = ( !empty($bg['sizes']['category-thumb-small']) ) ? $bg['sizes']['category-thumb-small'] : '';
									$bgAttr = ( !empty($bg) ) ? 'style="background-image: url('.$bg.')"' : '';
				
									echo '<li class="categories__item">';
										echo '<div ' . $bgAttr . ' class="categories__link"><span class="categories__num">' . sprintf("%02d", $num) . '.</span><span class="categories__name">' . $term_name . '</span></div>';
									echo '</li>';
									?>
									</ul>
								</section>
							</div>
							<?
						}
					}
				?>
				<div class="posts">
				<?php
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
