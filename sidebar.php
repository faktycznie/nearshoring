<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package nearshoring
 */
?>

<aside class="col-md-3 col-sm-12 col-xs-12 sidebar widget-area">

	<?php 
	$author = get_field('sec_autor');
	if( 'team' == get_post_type() ) $author = array('ID' => get_the_ID());

	if( is_single() && !empty($author) ) {

		foreach( $author as $a ) {

		$author_id = $a->ID;

		$author_pic = get_the_post_thumbnail( $author_id, 'author-thumbnail' );
		$author_name = get_the_title( $author_id );
		$author_subtitle = get_field('team_position', $author_id);
		$author_email = get_field('team_email', $author_id);
		//$author_phone = get_field('team_phone', $author_id);
		$author_link = get_field('team_external_link', $author_id);
		$author_linked = get_field('team_linkedin', $author_id);
		
		?>
		<div class="author">
			<?php if( !empty($author_pic) ) { ?>
			<div class="author__photo">
				<?php echo $author_pic; ?>
			</div>
			<?php } ?>

			<div class="author__content">
				<div class="author__name">
				<?php if($author_link) { ?>
					<a href="<?php echo $author_link; ?>" target="_blank">
					<?php } ?>
						<?php echo $author_name; ?>
					<?php if($author_link) { ?>
					</a>
				<?php } ?>
				</div>
				<div class="author__subtitle"><?php echo $author_subtitle; ?></div>
				<?php /*<a href="tel:<?php echo str_replace(' ' , '', $author_phone); ?>" class="author__phone"><?php echo str_replace('+48' , '<span class="smaller">+48</span>', $author_phone); ?></a>*/?>
				<a href="mailto:<?php echo $author_email; ?>" class="author__mail"><?php echo $author_email; ?></a>
				<?php if( !empty($author_linked) ) { ?>
					<a href="<?php echo $author_linked;?>" class="author__linkedin">
						<svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" viewBox="0 0 45 45">
							<path id="_003-linkedin" data-name="003-linkedin" d="M41.755,0H3.246A3.245,3.245,0,0,0,0,3.245V41.754A3.245,3.245,0,0,0,3.246,45H41.755A3.245,3.245,0,0,0,45,41.754V3.245A3.245,3.245,0,0,0,41.755,0ZM15.962,34.014h-5.48V17.528h5.48Zm-2.74-18.737h-.036a2.856,2.856,0,1,1,.072-5.7,2.857,2.857,0,1,1-.036,5.7Zm22.5,18.737H30.242v-8.82c0-2.216-.793-3.728-2.776-3.728a3,3,0,0,0-2.811,2,3.753,3.753,0,0,0-.18,1.337v9.207H18.994s.072-14.939,0-16.486h5.479v2.334a5.44,5.44,0,0,1,4.938-2.721c3.605,0,6.309,2.356,6.309,7.42Zm0,0" transform="translate(0)" fill="#fff" opacity="0.8"/>
						</svg>
					</a>
				<?php } ?>
			</div>
		</div>
	<?php } 
	} else { ?>

	<div class="categories categories--sidebar widget">
		<h2 class="categories__title"><?php _e('Sekcje', 'nearshoring'); ?></h2>
		<ul class="categories__list">
		<?php
			$args = array(
				'taxonomy' => 'category',
				'order' => 'ASC',
				'meta_key'      => 'number',
				'meta_compare'  => 'NUMERIC',
				'orderby'       => 'meta_value_num',
				'hierarchical'  =>  false,
				'hide_empty'      => false,
			);

			$categories = get_terms($args);
			$queried_object = get_queried_object();

			$current_term = ( !empty($queried_object->term_id) ) ? $queried_object->term_id : false;

			foreach ($categories as $term) {
				// The $term is an object, so we don't need to specify the $taxonomy.
				$term_link = get_term_link( $term );
				
				// If there was an error, continue to the next term.
				if ( is_wp_error( $term_link ) ) {
					continue;
				}

				$active_class = ( $term->term_id === $current_term ) ? ' categories__item--active' : '';

				echo '<li class="categories__item' . $active_class .'">';
					echo '<a class="categories__link" href="' . esc_url( $term_link ) . '"><span class="categories__name">' . $term->name . '</span></a>';
				echo '</li>';

			}
		?>
		</ul>
	</div>

	<div class="blog blog--sidebar widget">
		<h2 class="blog__title"><?php _e('Aktualności', 'nearshoring'); ?></h2>
		<?php
		$lastposts = get_posts( array(
			'posts_per_page' => 2,
			'post_status'    => 'publish',
			'suppress_filters' => false,
		) );
		
		if ( $lastposts ) { ?>
		<ul class="blog__list">
		<?php
			foreach ( $lastposts as $post ) {
				setup_postdata( $post );
				get_template_part( 'template-parts/front', 'list' );
			}
			wp_reset_postdata();
			?>
		</ul>
		<?php } ?>
	</div>

	<?php /* <div class="sidebar__contact"><?php get_template_part( 'template-parts/contact-box' ); ?></div> */ ?>

	<?php } ?>

	<?php 
	if ( is_active_sidebar( 'sidebar-1' ) ) {
		dynamic_sidebar( 'sidebar-1' );
	}
	?>

</aside>
