<?php
/**
 * Singularity functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Singularity
 */

if ( ! defined( 'SINGULARITY_VERSION' ) ) {
	define( 'SINGULARITY_VERSION', '1.0.11' );
}

if ( ! function_exists( 'singularity_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function singularity_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Singularity, use a find and replace
	 * to change 'singularity' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'singularity', get_template_directory() . '/languages' );

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
	register_nav_menus( array(
		'menu-1'	=> esc_html__( 'Primary', 'singularity' ),
		'mobile'	=> esc_html__( 'Mobile', 'singularity' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'singularity_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
	
	// Add logo theme support
	add_theme_support( 'custom-logo', array( 'flex-width' => true, 'flex-height' => true ) );
}
endif;
add_action( 'after_setup_theme', 'singularity_setup' );

/**
 * Enable excerpts for pages
 */
if( ! function_exists( 'singularity_init' ) ) {
	function singularity_init() {
		add_post_type_support( 'page', 'excerpt' );
	}
}
add_action( 'init', 'singularity_init' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function singularity_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'singularity_content_width', 1920 );
}
add_action( 'after_setup_theme', 'singularity_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function singularity_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'singularity' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'singularity' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
	if( singularity_is_discussion_board_enabled() ) {
		register_sidebar( array(
			'name'          => esc_html__( 'Discussion Board Sidebar', 'singularity' ),
			'id'            => 'sidebar-discussion-board',
			'description'   => esc_html__( 'Add widgets here for the Discussion Board sidebar.', 'singularity' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h5 class="widget-title">',
			'after_title'   => '</h5>',
		) );
	}
	if( singularity_is_edd_enabled() ) {
		register_sidebar( array(
			'name'          => esc_html__( 'Downloads Sidebar', 'singularity' ),
			'id'            => 'sidebar-edd',
			'description'   => esc_html__( 'Add widgets here for the Downloads sidebar.', 'singularity' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h5 class="widget-title">',
			'after_title'   => '</h5>',
		) );
	}
	register_sidebar( array(
		'name'          => esc_html__( 'Top Bar 1', 'singularity' ),
		'id'            => 'top-bar-1',
		'description'   => esc_html__( 'Add widgets here.', 'singularity' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Top Bar 2', 'singularity' ),
		'id'            => 'top-bar-2',
		'description'   => esc_html__( 'Add widgets here.', 'singularity' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Home 1', 'singularity' ),
		'id'            => 'home-1',
		'description'   => esc_html__( 'Add widgets here.', 'singularity' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Home 2', 'singularity' ),
		'id'            => 'home-2',
		'description'   => esc_html__( 'Add widgets here.', 'singularity' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
	// Create full width widget area above footer?
	$footer_full = get_theme_mod( 'full-width-footer', 1 );
	if( $footer_full == 1 ) {
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Full Width', 'singularity' ),
			'id'            => 'footer-full-width',
			'description'   => esc_html__( 'Add widgets here.', 'singularity' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h5 class="widget-title">',
			'after_title'   => '</h5>',
		) );
	}
	// How many footer columns?
	$footer_cols = get_theme_mod( 'footer-columns', 4 );
	for( $i = 1; $i <= absint( $footer_cols ); $i++ ) {
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Column ', 'singularity' ) . $i,
			'id'            => 'footer-' . $i,
			'description'   => esc_html__( 'Add widgets here.', 'singularity' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h5 class="widget-title">',
			'after_title'   => '</h5>',
		) );
	}
	register_sidebar( array(
		'name'          => esc_html__( 'Mobile Menu Footer', 'singularity' ),
		'id'            => 'mobile-menu-footer',
		'description'   => esc_html__( 'Add widgets here.', 'singularity' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'EDD Empty Checkout Page', 'singularity' ),
		'id'            => 'empty-checkout-page',
		'description'   => esc_html__( 'Add widgets here.', 'singularity' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
}
add_action( 'widgets_init', 'singularity_widgets_init' );

function singularity_add_widget_to_checkout() {
	dynamic_sidebar( 'empty-checkout-page' );
}
add_action( 'edd_cart_empty', 'singularity_add_widget_to_checkout' );

/**
 * Enqueue scripts and styles.
 */
function singularity_scripts() {
	wp_enqueue_style( 'singularity-style', get_stylesheet_uri(), '', SINGULARITY_VERSION );
	wp_enqueue_style( 'dashicons' );
	wp_enqueue_script( 'singularity-script', get_template_directory_uri() . '/js/singularity.js', array( 'jquery' ), SINGULARITY_VERSION, true );
	
	wp_enqueue_script( 'zoom', get_template_directory_uri(). '/js/zoom.min.js', array( 'jquery' ), '0.0.2', true );

	wp_enqueue_script( 'singularity-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'singularity_scripts' );


function singularity_js_in_html() { ?>
	<script>
	var html = document.getElementsByTagName("html")[0];
	if(html.className == "no-js") {
	    html.className = html.className.replace("no-js", "has-js"); // user has JS enabled
	} 
	</script>
<?php }
add_action( 'wp_head', 'singularity_js_in_html' );

/**
 * Implement the Custom Header feature.
 */
// require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load further theme functions.
 */
require get_template_directory() . '/inc/functions-layout.php';
require get_template_directory() . '/inc/functions-discussion-board.php';
require get_template_directory() . '/inc/functions-edd.php';
require get_template_directory() . '/inc/functions-gridgets.php';
require get_template_directory() . '/inc/functions-homepage.php';
require get_template_directory() . '/inc/functions-zoom.php';

/**
 * Customizer Library Demo functions and definitions
 *
 * @author devinsays
 * @link https://github.com/devinsays/customizer-library
 */
if( file_exists ( get_template_directory() . '/inc/customizer-library/customizer-library.php' ) ) :

	// Helper library for the theme customizer.
	require get_template_directory() . '/inc/customizer-library/customizer-library.php';
	// Define options for the theme customizer.
	require get_template_directory() . '/inc/customizer-options.php';
	// Output inline styles based on theme customizer selections.
	require get_template_directory() . '/inc/customizer-styles.php';
	// Additional filters and actions based on theme customizer selections.
	require get_template_directory() . '/inc/customizer-mods.php';

else :

	add_action( 'customizer-library-notices', 'singularity_customizer_library_notice' );

endif;

function singularity_customizer_library_notice() {
	_e( '<p>Notice: The "customizer-library" sub-module is not loaded.</p><p>Please add it to the "inc" directory: <a href="https://github.com/devinsays/customizer-library">https://github.com/devinsays/customizer-library</a>.</p><p>The demo, including submodules, can also be installed via Git: "git clone --recursive git@github.com:devinsays/customizer-library-demo".</p>', 'singularity' );
}

// Stop editing here
if( ! class_exists( 'Plugin_Usage_Tracker') ) {
	require_once dirname( __FILE__ ) . '/tracking/class-plugin-usage-tracker.php';
}

/**
 * If you are copying and pasting this code to another plugin you must rename the function below
 * The function must have a unique name so that it won't conflict with any other plugins using this tracker
 */
if( ! function_exists( 'singularity_start_theme_tracking' ) ) { 	// Replace function name here
	function singularity_start_theme_tracking() { 					// Replace function name
		$PUT = new Plugin_Usage_Tracker(
			__FILE__,
			'https://wisdomplugin.com',				// Replace with the URL to the site where you will track your plugins
			array(),									// You can specify options here
			true,															// End-user opt-in is required by default
			true,															// Include deactivation form
			1																// Marketing
		);
	}
	singularity_start_theme_tracking();
}
