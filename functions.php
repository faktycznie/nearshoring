<?php
/**
 * nearshoring functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package nearshoring
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'nearshoring_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function nearshoring_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on nearshoring, use a find and replace
		 * to change 'nearshoring' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'nearshoring', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'nearshoring' ),
				'menu-2' => esc_html__( 'Footer menu', 'nearshoring' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'nearshoring_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'nearshoring_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function nearshoring_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'nearshoring_content_width', 979 );
}
add_action( 'after_setup_theme', 'nearshoring_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function nearshoring_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'nearshoring' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'nearshoring' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Hero', 'nearshoring' ),
			'id'            => 'hero',
			'description'   => esc_html__( 'Add widgets here.', 'nearshoring' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'nearshoring_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function nearshoring_scripts() {
	global $is_IE;
	wp_enqueue_style( 'nearshoring-style', get_template_directory_uri() . '/css/style.css', array(), _S_VERSION );
	wp_enqueue_style( 'animate.css', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css', array(), '4.1.1' );
	
	if( $is_IE ) {
		wp_enqueue_script( 'polyfill', 'https://polyfill.io/v3/polyfill.min.js?features=URLSearchParams%2Ces6%2Cfetch%2CElement.prototype.remove%2CArray.prototype.forEach%2CElement.prototype.classList', array(), _S_VERSION, false );
		wp_enqueue_script( 'nearshoring-script', get_template_directory_uri() . '/js/script.babel.js', array('jquery'), _S_VERSION, true );
	} else {
		wp_enqueue_script( 'nearshoring-script', get_template_directory_uri() . '/js/script.js', array('jquery'), _S_VERSION, true );
	}

	wp_localize_script( 'nearshoring-script', 'nearshoring_params', array(
		'ajaxurl' => admin_url('admin-ajax.php'), // WordPress AJAX
		'query' => json_encode( $wp_query->query_vars ), // everything about your loop is here
	) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if( is_front_page() ) {
		$partners = get_field('partners', 'option');
		if( count($partners) > 2 ) {
			wp_enqueue_script("jquery");
			wp_enqueue_style( 'slick', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', array(), '1.8.1' );
			//wp_enqueue_style( 'slick-theme', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css', array(), '1.8.1' );
			
			wp_enqueue_script( 'slick-carousel', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array(), '1.8.1', true );
		}
	}

}
add_action( 'wp_enqueue_scripts', 'nearshoring_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
//require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
// if ( defined( 'JETPACK__VERSION' ) ) {
// 	require get_template_directory() . '/inc/jetpack.php';
// }


function nearshoring_remove_menus(){
	remove_menu_page( 'edit-comments.php' );
}
add_action( 'admin_menu', 'nearshoring_remove_menus' );

if( !function_exists( 'nearshoring_post_type' ) ) {
	function nearshoring_post_type() {
		// $labels_sections = array(
		// 	'name'               => __('Sekcje', 'nearshoring'),
		// 	'singular_name'      => __('Item', 'nearshoring'),
		// 	'add_new'            => __('Add New', 'nearshoring'),
		// 	'add_new_item'       => __('Add New Item', 'nearshoring'),
		// 	'edit_item'          => __('Edit Item', 'nearshoring'),
		// 	'new_item'           => __('New Item', 'nearshoring'),
		// 	'view_item'          => __('View Item', 'nearshoring'),
		// 	'search_items'       => __('Search Item', 'nearshoring'),
		// 	'not_found'          => __('No Items found', 'nearshoring'),
		// 	'not_found_in_trash' => __('No Items found in Trash', 'nearshoring'),
		// 	'parent_item_colon'  => ''
		// );

		// $args_sections = array(
		// 	'labels'              => $labels_sections,
		// 	'public'              => true,
		// 	'publicly_queryable'  => true,
		// 	'show_ui'             => true,
		// 	'query_var'           => true,
		// 	'capability_type'     => 'post',
		// 	'hierarchical'        => true,
		// 	'has_archive'         => true,
		// 	'menu_position'       => 5,
		// 	'show_in_nav_menus'   => true,
		// 	'supports'            => array('title', 'editor', 'thumbnail', 'excerpt', 'revisions'),
		// 	'rewrite'             => array('slug' => __('sekcja', 'nearshoring') )
		// );

		// register_post_type('sekcja', $args_sections);

		$labels_team = array(
			'name'               => __('Zespół', 'nearshoring'),
			'singular_name'      => __('Item', 'nearshoring'),
			'add_new'            => __('Add New', 'nearshoring'),
			'add_new_item'       => __('Add New Item', 'nearshoring'),
			'edit_item'          => __('Edit Item', 'nearshoring'),
			'new_item'           => __('New Item', 'nearshoring'),
			'view_item'          => __('View Item', 'nearshoring'),
			'search_items'       => __('Search Item', 'nearshoring'),
			'not_found'          => __('No Items found', 'nearshoring'),
			'not_found_in_trash' => __('No Items found in Trash', 'nearshoring'),
			'parent_item_colon'  => ''
		);

		$args_team = array(
			'labels'              => $labels_team,
			'public'              => true,
			'publicly_queryable'  => true,
			'show_ui'             => true,
			'query_var'           => true,
			'capability_type'     => 'post',
			'hierarchical'        => true,
			'has_archive'         => true,
			'menu_position'       => 5,
			'show_in_nav_menus'   => true,
			'supports'            => array('title', 'editor', 'thumbnail'),
			'rewrite'             => array('slug' => __('autor', 'nearshoring') )
		);

		register_post_type('team', $args_team);


		register_post_type( 'newsletter',
			array(
				'labels' => array(
					'name' => __( 'Newslettery' ),
					'singular_name' => __( 'Newslettery' )
				),
				'supports' => array( 'title', 'editor', 'thumbnail' ), 
				'public' => true,
				'has_archive' => false,
				'rewrite' => array('slug' => 'newsletter'),
				'menu_icon' => 'dashicons-text-page',
				'hierarchical' => true,
				'taxonomies' => array('post_tag')
			)
		);

	}
}
add_action('init', 'nearshoring_post_type');

/* Create Services Taxonomies */
// if (!function_exists('nearshoring_taxonomies')) {
// 	function nearshoring_taxonomies() {

// 		$services_category = array(
// 			'name'                       => __('Sekcje', 'nearshoring'),
// 			'singular_name'              => __('Kategoria sekcji', 'nearshoring'),
// 			'search_items'               => __('Szukaj kategorii sekcji', 'nearshoring'),
// 			'popular_items'              => __('Popularne kategorie sekcji', 'nearshoring'),
// 			'all_items'                  => __('Wszystkie kategorie sekcji', 'nearshoring'),
// 			'parent_item'                => __('Rodzic kategorii', 'nearshoring'),
// 			'parent_item_colon'          => __('Rodzic kategorii:', 'nearshoring'),
// 			'edit_item'                  => __('Edytuj kategorie', 'nearshoring'),
// 			'update_item'                => __('Zaktualizuj kategorie', 'nearshoring'),
// 			'add_new_item'               => __('Dodaj kategorie', 'nearshoring'),
// 			'new_item_name'              => __('Nowa nazwa kategorii', 'nearshoring'),
// 			'separate_items_with_commas' => __('Oddziel kategorie przecinkami', 'nearshoring'),
// 			'add_or_remove_items'        => __('Dodaj lub usuń kategorię', 'nearshoring'),
// 			'choose_from_most_used'      => __('Wybierz najpopularniejsze kategorie', 'nearshoring'),
// 			'menu_name'                  => __('Kategorie', 'nearshoring')
// 		);

// 		register_taxonomy(
// 			'sekcje', array('sekcja'),
// 			array(
// 				'hierarchical'      => true,
// 				'has_archive'       => true,
// 				'labels'            => $services_category,
// 				'show_ui'           => true,
// 				'show_in_nav_menus' => true,
// 				'query_var'         => true,
// 				'rewrite'           => array('slug' => __('sekcje', 'nearshoring'))
// 			)
// 		);
// 	}
// }
// add_action('init', 'nearshoring_taxonomies');


add_action( 'after_setup_theme', 'nearshoring_theme_setup' );
function nearshoring_theme_setup() {
    add_image_size( 'category-thumb-small', 398, 234 );
	add_image_size( 'author-thumbnail', 544, 573 );
}

// function nearshoring_excerpt_length( $length ) {
//     return 20;
// }
// add_filter( 'excerpt_length', 'nearshoring_excerpt_length', 999 );

function nearshoring_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'nearshoring_excerpt_more' );


add_action('wp_ajax_loadmore', 'nearshoring_loadmore_ajax'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_loadmore', 'nearshoring_loadmore_ajax'); // wp_ajax_nopriv_{action}
function nearshoring_loadmore_ajax() {

	$paged = $_POST['page'] + 1;

	if( !empty($_POST['dir']) ) {
		$paged = ( $_POST['dir'] == 'prev' ) ? $_POST['page'] - 1 : $_POST['page'] + 1;
	}

	// prepare our arguments for the query
	$args = json_decode( stripslashes( $_POST['query'] ), true );
	$args['paged'] = $paged; // we need next page to be loaded
	$args['post_status'] = 'publish';

	// it is always better to use WP_Query but not here
	query_posts( $args );

	if( have_posts() ) :

		// run the loop
		while( have_posts() ): the_post();

			get_template_part( 'template-parts/front', 'list' );

		endwhile;

	endif;
	die; // here we exit the script and even no wp_reset_query() required!
}


add_action('acf/init', 'nearshoring_acf_op_init');
function nearshoring_acf_op_init() {

    // Check function exists.
    if( function_exists('acf_add_options_page') ) {

        // Register options page.
        $option_page = acf_add_options_page(array(
            'page_title'    => __('Theme Settings'),
            'menu_title'    => __('Theme Settings'),
            'menu_slug'     => 'theme-settings',
            'capability'    => 'edit_posts',
            'redirect'      => false
        ));
    }
}

if ( ! function_exists( 'nearshoring_breadcrumbs' ) ) {
	/**
	 * Breadcrumbs
	 * @param array $args
	 */
	function nearshoring_breadcrumbs( $args = array() ) {
		if ( is_front_page() ) {
			return;
		}
		global $post;
		$defaults  = array(
			'breadcrumbs_id'      => 'breadcrumbs',
			'breadcrumbs_classes' => 'breadcrumbs__list',
			'home_title'          => esc_html__('Strona główna', 'nearshoring'),
		);
		$args      = apply_filters( 'pe_breadcrumbs_args', wp_parse_args( $args, $defaults ) );

		$separator_icon = '<span class="sep" aria-hidden="true"></span>';
		$separator = '<li class="separator">' . $separator_icon . '</li>';

		// Open the breadcrumbs
		$html = '<ul id="' . esc_attr( $args['breadcrumbs_id'] ) . '" class="' . sanitize_html_class( $args['breadcrumbs_classes'] ) . '">';
		// Add Homepage link & separator (always present)
		$html .= '<li class="item-home"><a class="bread-link bread-home" href="' . get_home_url() . '" title="' . esc_attr( $args['home_title'] ) . '">' . esc_attr( $args['home_title'] ) . '</a></li>';
		$html .= $separator;
		// Post
		if ( is_singular( 'post' ) ) {
			$category = get_the_category();
			$category_values = array_values( $category );
			$last_category = end( $category_values );
			$cat_parents = rtrim( get_category_parents( $last_category->term_id, true, ',' ), ',' );
			$cat_parents = explode( ',', $cat_parents );
			foreach ( $cat_parents as $parent ) {
				$html .= '<li class="item-cat">' . wp_kses( $parent, wp_kses_allowed_html( 'a' ) ) . '</li>';
				$html .= $separator;
			}
			$html .= '<li class="item-current item-' . $post->ID . '"><span class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</span></li>';
		} elseif ( is_singular( 'page' ) ) {
			if ( $post->post_parent ) {
				$parents = get_post_ancestors( $post->ID );
				$parents = array_reverse( $parents );
				foreach ( $parents as $parent ) {
					$html .= '<li class="item-parent item-parent-' . esc_attr( $parent ) . '"><a class="bread-parent bread-parent-' . esc_attr( $parent ) . '" href="' . esc_url( get_permalink( $parent ) ) . '" title="' . get_the_title( $parent ) . '">' . get_the_title( $parent ) . '</a></li>';
					$html .= $separator;
				}
			}
			$html .= '<li class="item-current item-' . $post->ID . '"><span title="' . esc_attr( get_the_title() ) . '"> ' . esc_attr( get_the_title() ) . '</span></li>';
		} elseif ( is_singular( 'attachment' ) ) {
			$parent_id        = $post->post_parent;
			$parent_title     = get_the_title( $parent_id );
			$parent_permalink = get_permalink( $parent_id );
			$html .= '<li class="item-parent"><a class="bread-parent" href="' . esc_url( $parent_permalink ) . '" title="' . esc_attr( $parent_title ) . '">' . esc_attr( $parent_title ) . '</a></li>';
			$html .= $separator;
			$html .= '<li class="item-current item-' . $post->ID . '"><span title="' . esc_attr( get_the_title() ) . '"> ' . esc_attr( get_the_title() ) . '</span></li>';
		} elseif ( is_singular() ) {
			$post_type         = get_post_type();
			$post_type_object  = get_post_type_object( $post_type );
			$post_type_archive = get_post_type_archive_link( $post_type );
			$html .= '<li class="item-cat item-custom-post-type-' . esc_attr( $post_type ) . '"><a class="bread-cat bread-custom-post-type-' . esc_attr( $post_type ) . '" href="' . esc_url( $post_type_archive ) . '" title="' . esc_attr( $post_type_object->labels->name ) . '">' . esc_attr( $post_type_object->labels->name ) . '</a></li>';
			$html .= $separator;

			// if( $post_type == 'sekcja' ) {
			// 	$post_id = get_the_ID();
			// 	$terms = get_the_terms( $post_id, 'sekcje' );
			// 	if(!empty($terms)) {
			// 		$term = end($terms);
			// 		$term_link = get_term_link($term);
			// 		$html .= '<li class="item-term"><a class="bread-cat bread-term" href="' . esc_url( $term_link ) . '" title="' . esc_attr( $term->name ) . '">' . esc_attr( $term->name ) . '</a></li>';
			// 		$html .= $separator;
			// 	}
			// }
			$html .= '<li class="item-current item-' . $post->ID . '"><span class="bread-current bread-' . $post->ID . '" title="' . $post->post_title . '">' . $post->post_title . '</span></li>';
		} elseif ( is_category() ) {
			$parent = get_queried_object()->category_parent;
			if ( $parent !== 0 ) {
				$parent_category = get_category( $parent );
				$category_link   = get_category_link( $parent );
				$html .= '<li class="item-parent item-parent-' . esc_attr( $parent_category->slug ) . '"><a class="bread-parent bread-parent-' . esc_attr( $parent_category->slug ) . '" href="' . esc_url( $category_link ) . '" title="' . esc_attr( $parent_category->name ) . '">' . esc_attr( $parent_category->name ) . '</a></li>';
				$html .= $separator;
			}
			$html .= '<li class="item-current item-cat"><span class="bread-current bread-cat" title="' . $post->ID . '">' . single_cat_title( '', false ) . '</span></li>';
		} elseif ( is_tag() ) {
			$html .= '<li class="item-current item-tag"><span class="bread-current bread-tag">' . single_tag_title( '', false ) . '</span></li>';
		} elseif ( is_author() ) {
			$html .= '<li class="item-current item-author"><span class="bread-current bread-author">' . get_queried_object()->display_name . '</span></li>';
		} elseif ( is_day() ) {
			$html .= '<li class="item-current item-day"><span class="bread-current bread-day">' . get_the_date() . '</span></li>';
		} elseif ( is_month() ) {
			$html .= '<li class="item-current item-month"><span class="bread-current bread-month">' . get_the_date( 'F Y' ) . '</span></li>';
		} elseif ( is_year() ) {
			$html .= '<li class="item-current item-year"><span class="bread-current bread-year">' . get_the_date( 'Y' ) . '</span></li>';
		} elseif( is_tax() ) {
			$term_name = get_queried_object()->name;
			$tax_slug = get_queried_object()->taxonomy;
			$tax = get_taxonomy($tax_slug);
			$tax_name = $tax->label;
			$tax_post_type = $tax->object_type[0];

			$archive_link = get_post_type_archive_link($tax_post_type);

			$html .= '<li class="item-tax item-tax"><a class="bread-link bread-archive" href="' . $archive_link . '"><span class="bread-current bread-tax">' . esc_attr( $tax_name ) . '</span></a></li>';
			$html .= $separator;
			$html .= '<li class="item-current item-archive"><span class="bread-current bread-term">' . esc_attr( $term_name ) . '</span></li>';
		} elseif ( is_archive() ) {
			$custom_tax_name = get_queried_object()->label;
			if( empty($custom_tax_name) ) $custom_tax_name = get_queried_object()->name;
			$html .= '<li class="item-current item-archive"><span class="bread-current bread-archive">' . esc_attr( $custom_tax_name ) . '</span></li>';
		} elseif ( is_search() ) {
			$html .= '<li class="item-current item-search"><span class="bread-current bread-search">' . esc_html__('Wyniki wyszukiwania: ', 'nearshoring') . get_search_query() . '</span></li>';
		} elseif ( is_404() ) {
			$html .= '<li>' . esc_html__( 'Error 404', 'nearshoring' ) . '</li>';
		} elseif ( is_home() ) {
			$html .= '<li>' . get_the_title( get_option( 'page_for_posts' ) ) . '</li>';
		}
		$html .= '</ul>';
		$html = apply_filters( 'nearshoring_breadcrumbs_filter', $html );
		echo wp_kses_post( $html );
	}
}