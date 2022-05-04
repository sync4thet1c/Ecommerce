<?php
/**
 * Ecommerce functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Ecommerce
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function ecommerce_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Ecommerce, use a find and replace
		* to change 'ecommerce' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'ecommerce', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', 'ecommerce' ),
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
			'ecommerce_custom_background_args',
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

// checkbox field
add_action( 'woocommerce_after_order_notes', 'quadlayers_subscribe_checkout' );

function quadlayers_subscribe_checkout( $checkout ) {
woocommerce_form_field( 'subscriber', array(
'type' => 'checkbox',
//'required' => true,
'class' => array('custom-field form-row-wide'),
'label' => ' Subscribe to our newsletter.'
), $checkout->get_value( 'subscriber' ) );
}

add_action( 'woocommerce_checkout_update_order_meta','quadlayers_save_function' );
function quadlayers_save_function( $order_id ){
if ( ! empty( $_POST['subscriber'] ) ) {
update_post_meta( $order_id, 'subscriber', sanitize_text_field( $_POST['subscriber'] ) );
}
if ( ! empty( $_POST['feed'] ) ) {
update_post_meta( $order_id, 'feed',sanitize_text_field( $_POST['feed'] ) );
}
}


add_action( 'after_setup_theme', 'ecommerce_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ecommerce_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'ecommerce_content_width', 640 );
}
add_action( 'after_setup_theme', 'ecommerce_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ecommerce_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'ecommerce' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'ecommerce' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'ecommerce_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function ecommerce_scripts() {
	wp_enqueue_style( 'ecommerce-style', get_stylesheet_uri(), array(), _S_VERSION );	
	wp_enqueue_style( 'ecommerce-main', get_template_directory_uri() . '/css/bootstrap.min.css' );	
	wp_enqueue_style( 'css-main', get_template_directory_uri() . '/css/main.css' );	
	wp_enqueue_style( 'css-cdns', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css' );	
	wp_enqueue_style( 'css-cdn', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css' );	
	wp_enqueue_style( 'bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css');	
	wp_enqueue_style( 'ecommerce-main', get_template_directory_uri() . '/js/bootstrap.min.js');	
	wp_style_add_data( 'ecommerce-style', 'rtl', 'replace' );
	wp_enqueue_script( 'ecommerce-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'ecommerce-js', get_template_directory_uri() . '/js/main.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'ecommerce-navigation', get_template_directory_uri() . 'http://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ecommerce_scripts' );

/**
 * Custom Fonts (added aafai***)
 * font-family: 'lexend', ;sans-serif';
 */
function enqueue_custom_font() {
	if(!is_admin()) {
		wp_register_style('source_sans_pro', 'https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap');
		wp_register_style('lexend', 'https://fonts.googleapis.com/css2?family=Lexend:wght@300&display=swap');
		
		wp_enqueue_style('source_sans_pro');
		wp_enqueue_style('lexend');
	}
}
add_action('wp_enqueue_scripts', 'enqueue_custom_font');


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

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
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

function get_icon_url($imagename){
	return get_template_directory_uri().'/img/'.$imagename;
};

/**
 * Show cart contents / total Ajax
 */
add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );

function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;

	ob_start();

	?>
	<a class="cart-customlocation" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?> – <?php echo $woocommerce->cart->get_cart_total(); ?></a>
	<?php
	$fragments['a.cart-customlocation'] = ob_get_clean();
	return $fragments;
}
