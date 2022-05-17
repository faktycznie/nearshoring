<section class="categories categories--boxed">
	<h2 class="categories__title"><?php _e('Działy', 'nearshoring'); ?></h2>
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

		foreach ($categories as $term) {
			// The $term is an object, so we don't need to specify the $taxonomy.
			$term_link = get_term_link( $term );
			
			// If there was an error, continue to the next term.
			if ( is_wp_error( $term_link ) ) {
				continue;
			}

			$num = get_field('number', 'category' . '_' . $term->term_id);
			$bg = get_field('cat_image', 'category' . '_' . $term->term_id);
			$bg = ( !empty($bg['sizes']['category-thumb-small']) ) ? $bg['sizes']['category-thumb-small'] : '';
			$bgAttr = ( !empty($bg) ) ? 'style="background-image: url('.$bg.')"' : '';

			echo '<li class="categories__item">';
				echo '<a ' . $bgAttr . ' class="categories__link" href="' . esc_url( $term_link ) . '"><span class="categories__num">' . sprintf("%02d", $num) . '.</span><span class="categories__name">' . $term->name . '</span></a>';
			echo '</li>';
		}
	?>
	</ul>
</section>