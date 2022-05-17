<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package nearshoring
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<?php

$ua = htmlentities($_SERVER['HTTP_USER_AGENT'], ENT_QUOTES, 'UTF-8');

$ie = false;
if (preg_match('~MSIE|Internet Explorer~i', $ua) || (strpos($ua, 'Trident/7.0') !== false && strpos($ua, 'rv:11.0') !== false)) {
	$ie = true;
}

$brand_bg = get_field('brand_bg', 'option');
$show_brand = ( is_front_page() && is_home() && !empty($brand_bg) && !isset($_COOKIE['nearshoring_effect']) && !$ie ) ? true : false;
$body_class = ( $show_brand ) ? 'show-brand' : '';
?>
<body <?php body_class($body_class); ?>>
<?php wp_body_open(); ?>

<div class="page-body">

	<header class="header">
		<div class="header__container container">
			<div class="header__brand brand">
				<?php if ( $show_brand ) { ?>
					<div class="brand__mask">
						<div class="brand__bg">
							<?php echo '<img src="' . $brand_bg['url'] . '" alt="">' ?>
						</div>
					</div>
				<?php } ?>
				<div class="brand__logo">
				<?php
				the_custom_logo();
				if ( is_front_page() && is_home() ) { ?>
					<h1 class="brand__title sr-only"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php } ?>
				</div>
			</div>

			<div class="header__menu">
				<div class="header__lang">
					<?php
					echo '<div class="wpml-floating-language-switcher">';
						do_action('wpml_add_language_selector');
					echo '</div>';

					$social = get_field('social', 'option');

					if( !empty($social) ) {
						foreach($social as $item) { ?>
					<div class="header__social social">
						<a href="<?php echo $item['url']; ?>" class="social__<?php echo sanitize_html_class($item['label']); ?>" title="<?php echo $item['label']; ?>"><?php echo $item['icon']; ?></a>
					</div>
					<?php }
					} ?>
				</div>
				<div class="header__nav">
					<nav class="nav-menu">
						<button class="nav-menu__toggle hamburger" aria-label="<?php esc_html_e( 'Open menu', 'smexample' ); ?>"><span class="hamburger__inner"></span></button>
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'menu-1',
								'menu_id'        => 'primary-menu',
								'menu_class'     => 'nav-menu__list',
								'container_class' => 'nav-menu__container',
							)
						);
						?>
					</nav>
					<div class="header__search search-nav">
						<button class="search-nav__button">
							<svg xmlns="http://www.w3.org/2000/svg" width="19.207" height="19.207" viewBox="0 0 19.207 19.207">
								<g transform="translate(-1795 -84)">
									<g transform="translate(1795 84)" fill="none" stroke="#ea5b0c" stroke-width="2">
										<circle cx="8.5" cy="8.5" r="8.5" stroke="none"/>
										<circle cx="8.5" cy="8.5" r="7.5" fill="none"/>
									</g>
									<line x2="5" y2="5" transform="translate(1808.5 97.5)" fill="none" stroke="#ea5b0c" stroke-width="2"/>
								</g>
							</svg>
						</button>
					</div>
				</div>
				
			</div>
		</div>
	</header>

	<section class="search-box">
		<div class="search-box__container container">
			<form class="search-box__form" action="<?php echo home_url( '/' ); ?>" method="get">
				<input type="text" class="search-box__input" name="s" id="search" placeholder="<?php _e('Szukaj...', 'nearshoring'); ?>" value="<?php echo get_search_query() ?>">
				<button type="submit" class="search-box__button">
					<svg xmlns="http://www.w3.org/2000/svg" width="19.207" height="19.207" viewBox="0 0 19.207 19.207">
						<g transform="translate(-1795 -84)">
							<g transform="translate(1795 84)" fill="none" stroke="#ea5b0c" stroke-width="2">
								<circle cx="8.5" cy="8.5" r="8.5" stroke="none"/>
								<circle cx="8.5" cy="8.5" r="7.5" fill="none"/>
							</g>
							<line x2="5" y2="5" transform="translate(1808.5 97.5)" fill="none" stroke="#ea5b0c" stroke-width="2"/>
						</g>
					</svg>
				</button>
			</form>
		</div>
	</section>