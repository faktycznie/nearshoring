<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package nearshoring
 */

get_header();

$partners_target_url = get_field('partners_target_url', 'option');
$partners_estate_url = get_field('partners_estate_url', 'option');

$intro = get_field('intro_text', 'option');
$intro_full = get_field('intro_text_full', 'option');
?>
<?php if ( is_active_sidebar( 'hero' ) ) { ?>
<section class="hero">
	<div class="hero__container container">
		<?php dynamic_sidebar( 'hero' ); ?>
	</div>
</section>
<?php } ?>

<?php if( !empty($intro) ) { ?>
<section class="intro">
	<div class="intro__container container">
		<p class="intro__text"><?php echo $intro; ?></p>
		<?php if( !empty($intro_full) ) { ?>
			<p class="intro__fulltext"><?php echo $intro_full; ?></p>
			<a class="intro__readmore readmore" href="#" data-label="<?php echo __('Mniej', 'nearshoring'); ?>">
				<span class="readmore__label"><?php echo __('Więcej', 'nearshoring'); ?></span>
				<span class="readmore__icon">
					<svg xmlns="http://www.w3.org/2000/svg" width="9.172" height="18.017" viewBox="0 0 9.172 18.017">
						<path d="M675.854,2694.623l8.122-8.667-8.122-8.667" transform="translate(-675.489 -2676.948)" fill="none" stroke="#111" stroke-width="1"></path>
					</svg>
				</span>
			</a>
		<?php } ?>
	</div>
</section>
<?php } ?>

<div class="main container">
	<div class="main__row row">
		<div class="sections col-md-6 col-sm-12 col-xs-12">
			<?php get_template_part( 'template-parts/sections' ); ?>
		</div>
		<main class="blog col-md-6 col-sm-12 col-xs-12">
			<div class="blog__header">
				<h2 class="blog__title"><?php _e('Aktualności', 'nearshoring'); ?></h2>
				<a class="blog__newsletter news-link" href="newsletter"><?php _e('Powiadom o nowych artykułach', 'nearshoring'); ?>
					<span class="news-link__icon"><svg xmlns="http://www.w3.org/2000/svg" width="27" height="29.368" viewBox="0 0 27 29.368">
						<g transform="translate(8 18.368)" fill="#fff" stroke="#ea5b0c" stroke-width="2">
							<circle cx="5.5" cy="5.5" r="5.5" stroke="none"/>
							<circle cx="5.5" cy="5.5" r="4.5" fill="none"/>
						</g>
						<g transform="translate(3 4.368)" fill="#fff" stroke="#ea5b0c" stroke-width="2">
							<path d="M10,0h1A10,10,0,0,1,21,10V20a0,0,0,0,1,0,0H0a0,0,0,0,1,0,0V10A10,10,0,0,1,10,0Z" stroke="none"/>
							<path d="M10,1h1a9,9,0,0,1,9,9v8a1,1,0,0,1-1,1H2a1,1,0,0,1-1-1V10A9,9,0,0,1,10,1Z" fill="none"/>
						</g>
						<g transform="translate(0 22.368)" fill="#fff" stroke="#ea5b0c" stroke-width="1">
							<rect width="27" height="2" rx="1" stroke="none"/>
							<rect x="0.5" y="0.5" width="26" height="1" rx="0.5" fill="none"/>
						</g>
						<g transform="translate(14.5) rotate(90)" fill="#fff" stroke="#ea5b0c" stroke-width="1">
							<rect width="5.895" height="2" rx="1" stroke="none"/>
							<rect x="0.5" y="0.5" width="4.895" height="1" rx="0.5" fill="none"/>
						</g>
					</svg></span>
				</a>
			</div>
			
			<?php if ( have_posts() ) { 
				global $wp_query;

				$current_page = get_query_var( 'paged' ) ? get_query_var('paged') : 1;
				$max_page = $wp_query->max_num_pages;
				
				?>
				<div class="blog__content"> 
					<div class="blog__list" data-current="<?php echo $current_page; ?>" data-max="<?php echo $max_page; ?>">
					<?php /* Start the Loop */
					while ( have_posts() ) {
						the_post();

						get_template_part( 'template-parts/front', 'list' );

					} ?>
					</div>
					<?php if( $wp_query->max_num_pages > 1 ) { ?>
					<div class="blog__navi">
						<button class="prev disabled" title="<?php _e('Prev', 'nearshoring'); ?>" disabled></button>
						<button class="next" title="<?php _e('Next', 'nearshoring'); ?>"></button>
					</div>
					<?php } ?>
				</div>
			<?php } ?>
		</main>
	</div>
</div>
<?php 

$partners = get_field('partners', 'option');
if( !empty($partners) ) {
	$slider = '';
	if( count($partners) > 2 ) {
		$slider = 'slick';
		?>
		<script>
		jQuery( document ).ready(function() {
			jQuery('.partners__list').slick({
				slidesToShow: 2,
				slidesToScroll: 1,
				dots: true,
				arrows: false,
				autoplay: true,
				autoplaySpeed: 5000,
			});
		});
		</script>
		<?php
	}
?>
<section class="partners">
	<div class="partners__container container">
		<div class="partners__row <?php echo $slider; ?>">
			<h2 class="partners__title"><?php _e('Partnerzy', 'nearshoring'); ?></h2>
			<div class="partners__list" <?php echo $slick; ?>>
				<?php foreach( $partners as $partner ) { ?>
				<div class="partners__box partners__box--<?php echo sanitize_html_class($partner['label']); ?>">
					<a class="partners__link" href="<?php echo $partner['url']; ?>" target="_blank">
						<span class="partners__icon">
							<?php echo $partner['icon']; ?>
						</span>
						<span class="partners__divider"></span>
						<span class="partners__label"><?php echo $partner['label']; ?></span>
					</a>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</section>
<?php
}

//get_sidebar();
get_footer();
