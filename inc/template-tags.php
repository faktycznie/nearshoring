<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package nearshoring
 */

if ( ! function_exists( 'nearshoring_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function nearshoring_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		echo $time_string; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'nearshoring_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function nearshoring_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'nearshoring' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;


if ( ! function_exists( 'nearshoring_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function nearshoring_entry_footer() {
	}
endif;

if ( ! function_exists( 'nearshoring_entry_readmore' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function nearshoring_entry_readmore() {
		$icon = '<span class="readmore__icon"><svg xmlns="http://www.w3.org/2000/svg" width="9.172" height="18.017" viewBox="0 0 9.172 18.017">
		<path d="M675.854,2694.623l8.122-8.667-8.122-8.667" transform="translate(-675.489 -2676.948)" fill="none" stroke="#111" stroke-width="1"/>
		</svg></span>';
		echo '<span class="readmore readmore--post-list">' . __('Czytaj', 'nearshoring') . $icon . '</span>';
	}
endif;

if ( ! function_exists( 'nearshoring_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function nearshoring_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>
			<div class="post__thumbnail">
				<?php the_post_thumbnail(); ?>
			</div>
		<?php else : ?>
			<a class="post__thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
					the_post_thumbnail(
						'post-thumbnail',
						array(
							'alt' => the_title_attribute(
								array(
									'echo' => false,
								)
							),
						)
					);
				?>
			</a>
			<?php
		endif;
	}
endif;

if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
endif;
