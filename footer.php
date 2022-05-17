<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package nearshoring
 */

$form_id = get_field('contact_form_id', 'option');

?>
	<footer class="footer">
		<div class="footer__container container">
			<div class="contact" id="contact">
				<div class="contact__copyform">
					<h2 class="contact__title"><?php echo sprintf(__('Skontaktuj się %s z nami', 'nearshoring'), '<br>'); ?></h2>
					<?php if( !empty($form_id) ) { ?>
					<div class="contact__form">
						<?php echo do_shortcode( '[contact-form-7 id="'.$form_id.'"]' ); ?>
					</div>
					<?php } ?>
					<div class="copyrights">
						<div class="copyrights__info">
							<span class="copyrights__year"><?php _e('&copy; Copyright 2022', 'nearshoring'); ?></span><span class="copyrights__divider">|</span><a class="copyrights__design" href="https://indicoweb.com" target="_blank">Design by Indico</a>
						</div>
						<div class="copyrights__menu">
							<?php
							wp_nav_menu(
								array(
									'theme_location' => 'menu-2',
									'menu_id'        => 'footer-nav',
									'menu_class'     => 'footer-nav__list',
									'container_class' => 'footer-nav',
								)
							);
							?>
						</div>
					</div>
				</div>
				<div class="contact__box"><?php get_template_part( 'template-parts/contact-box' ); ?></div>
			</div>
		</div>
	</footer>
</div>

<?php wp_footer(); ?>

</body>
</html>
