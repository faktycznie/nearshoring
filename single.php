<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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

				get_template_part( 'template-parts/content', get_post_type() );

				// the_post_navigation(
				// 	array(
				// 		'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'nearshoring' ) . '</span> <span class="nav-title">%title</span>',
				// 		'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'nearshoring' ) . '</span> <span class="nav-title">%title</span>',
				// 	)
				// );

				$soc_page_title = get_the_title();
				$soc_page_url = get_page_link();
				$soc_page_desc = get_the_excerpt();
				$soc_page_image = get_the_post_thumbnail_url();
			?>
			<div class="content__social social">
				<div class="social__label"><?php _e('Udostępnij', 'nearshoring') ?></div>
				<div class="social__list">
					<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $soc_page_url; ?>&t=<?php echo $soc_page_title; ?>" target="_blank" title="<?php echo __('Facebook', 'nearshoring'); ?>">
						<svg xmlns="http://www.w3.org/2000/svg" width="32.339" height="32.339" viewBox="0 0 32.339 32.339">
							<path id="_002-facebook" data-name="002-facebook" d="M30.554,0H1.784A1.785,1.785,0,0,0,0,1.785v28.77a1.785,1.785,0,0,0,1.785,1.784h15.49V19.833h-4.2v-4.9h4.2v-3.6c0-4.178,2.55-6.451,6.277-6.451a34.556,34.556,0,0,1,3.766.192V9.442h-2.57c-2.028,0-2.42.963-2.42,2.377v3.118h4.848l-.632,4.9H22.328V32.339h8.226a1.785,1.785,0,0,0,1.785-1.784h0V1.783A1.785,1.785,0,0,0,30.554,0Zm0,0" transform="translate(0 0)" fill="#ea5b0c"/>
						</svg>
					</a>
					<a href="https://twitter.com/intent/tweet?source=<?php echo $soc_page_url; ?>&text=<?php echo $soc_page_title; ?>:<?php echo $soc_page_url; ?>&via=" target="_blank" title="<?php echo __('Twitter', 'nearshoring'); ?>">
						<svg xmlns="http://www.w3.org/2000/svg" width="32.339" height="26.276" viewBox="0 0 32.339 26.276">
							<g id="_001-twitter" data-name="001-twitter" transform="translate(0)">
								<g id="Group_7" data-name="Group 7" transform="translate(0 0)">
								<path id="Path_8" data-name="Path 8" d="M32.339,51.111a13.823,13.823,0,0,1-3.82,1.047,6.593,6.593,0,0,0,2.917-3.664,13.249,13.249,0,0,1-4.2,1.6,6.629,6.629,0,0,0-11.468,4.534,6.827,6.827,0,0,0,.154,1.512A18.766,18.766,0,0,1,2.252,49.209,6.632,6.632,0,0,0,4.289,58.07a6.547,6.547,0,0,1-3-.817v.073A6.66,6.66,0,0,0,6.605,63.84a6.617,6.617,0,0,1-1.738.218,5.862,5.862,0,0,1-1.255-.113,6.693,6.693,0,0,0,6.195,4.618,13.321,13.321,0,0,1-8.22,2.828A12.417,12.417,0,0,1,0,71.3a18.665,18.665,0,0,0,10.171,2.975c12.2,0,18.87-10.106,18.87-18.866,0-.293-.01-.576-.024-.857A13.226,13.226,0,0,0,32.339,51.111Z" transform="translate(0 -48)" fill="#ea5b0c"/>
								</g>
							</g>
						</svg>
					</a>
					<a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo $soc_page_url; ?>" title="<?php echo __('Linkedin', 'nearshoring'); ?>">
						<svg xmlns="http://www.w3.org/2000/svg" width="32.339" height="32.339" viewBox="0 0 32.339 32.339">
							<path id="_003-linkedin" data-name="003-linkedin" d="M30.007,0H2.333A2.332,2.332,0,0,0,0,2.332V30.007a2.332,2.332,0,0,0,2.332,2.332H30.007a2.332,2.332,0,0,0,2.332-2.332V2.332A2.332,2.332,0,0,0,30.007,0ZM11.471,24.444H7.533V12.6h3.938ZM9.5,10.978H9.477a2.052,2.052,0,1,1,.052-4.094A2.053,2.053,0,1,1,9.5,10.978ZM25.671,24.444H21.733V18.106c0-1.593-.57-2.679-2-2.679a2.156,2.156,0,0,0-2.02,1.44,2.7,2.7,0,0,0-.13.961v6.616H13.65s.052-10.736,0-11.848h3.938v1.678a3.91,3.91,0,0,1,3.549-1.956c2.591,0,4.534,1.693,4.534,5.332Zm0,0" transform="translate(0)" fill="#ea5b0c"/>
						</svg>
					</a>
				</div>
			</div>
			<?php

			endwhile; // End of the loop.
			?>
			</div>
		</main>
		<?php get_sidebar(); ?>
	</div>
</div>
<?php

get_footer();

