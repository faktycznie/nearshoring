<?php
/**
 * The template for displaying breadcrumbs
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package nearshoring
 */

// if ( function_exists('yoast_breadcrumb') ) {
// 	yoast_breadcrumb( '<section class="breadcrumbs"><div class="breadcrumbs__container container">','</div></section>' );
// }

echo '<section class="breadcrumbs"><div class="breadcrumbs__container container">';
nearshoring_breadcrumbs();
echo '</div></section>';

?>