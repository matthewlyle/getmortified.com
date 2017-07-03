<?php
/**
 * hyphen functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package hyphen
 */

if ( ! function_exists( 'hyphen_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function hyphen_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on hyphen, use a find and replace
	 * to change 'hyphen' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'hyphen', get_template_directory() . '/languages' );

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
		'menu-1' => esc_html__( 'Primary', 'hyphen' ),
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
	add_theme_support( 'custom-background', apply_filters( 'hyphen_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'hyphen_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function hyphen_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'hyphen_content_width', 640 );
}
add_action( 'after_setup_theme', 'hyphen_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function hyphen_widgets_init() {
	register_sidebar( array(
		'name'          => 'Critics quotes',
		'id'            => 'critics-quotes',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'description'   => esc_html__( 'The critics quotes on the homepage.', 'hyphen' ),
	) );
	register_sidebar( array(
		'name'          => 'Footer links',
		'id'            => 'footer-links',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'description'   => esc_html__( 'Add widgets here.', 'hyphen' ),
	) );
	register_sidebar( array(
		'name'          => 'Homepage blurb',
		'id'            => 'Homepage-blurb',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'description'   => esc_html__( 'Add widgets here.', 'hyphen' ),
	) );
}
add_action( 'widgets_init', 'hyphen_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function hyphen_scripts() {
	wp_enqueue_style( 'hyphen-style', get_stylesheet_uri() );
	wp_enqueue_script( 'mortified', get_template_directory_uri() . '/mortified.min.js', array('jquery'), '20151215', true );
}
add_action( 'wp_enqueue_scripts', 'hyphen_scripts' );

require get_template_directory() . '/inc/extras.php';

// remove_filter( 'the_content', 'wpautop' );
function remove_wpautop(){
   $pages = array(
   		10, 11, 3544, 3540, 3527, // participate and all its languages
   		36, // mortified muse
   		3793 // mortified anthologies
   		);
   if (is_page($pages)){
      remove_filter('the_content', 'wpautop');
   }
}

add_action('wp_head', 'remove_wpautop');

function _remove_script_version( $src ){
	$parts = explode( '?ver', $src );
	return $parts[0];
}
add_filter( 'script_loader_src', '_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', '_remove_script_version', 15, 1 );

function remove_plugin_scripts(){ // to include them inside mortified.min.js/css instead
		// Contact Form 7
		wp_dequeue_script('contact-form-7');
		wp_dequeue_style('contact-form-7');
		wp_dequeue_script('wp-featherlight');
		wp_dequeue_style('wp-featherlight');
}
add_action('wp_enqueue_scripts', 'remove_plugin_scripts');

$ok = apply_filters('wp_featherlight_load_css', $ok, false);
$something = apply_filters('wp_featherlight_load_js', false, $something);

function switch_to_relative_url($html, $id, $caption, $title, $align, $url, $size, $alt){
	$imageurl = wp_get_attachment_image_src($id, $size);
	$relativeurl = wp_make_link_relative($imageurl[0]);
	$html = str_replace($imageurl[0],$relativeurl,$html);
	return $html;
}
add_filter('image_send_to_editor','switch_to_relative_url',10,8);

function remove_menus(){
	remove_menu_page( 'edit.php' );                   //Posts
	remove_menu_page( 'edit-comments.php' );          //Comments

 	if( !current_user_can( 'administrator' ) ):
	  remove_menu_page( 'index.php' );                  //Dashboard
	  remove_menu_page( 'jetpack' );                    //Jetpack*
	  remove_menu_page( 'edit.php' );                   //Posts
	  remove_menu_page( 'upload.php' );                 //Media
	  remove_menu_page( 'edit.php?post_type=page' );    //Pages
	  remove_menu_page( 'edit-comments.php' );          //Comments
	  remove_menu_page( 'themes.php' );                 //Appearance
	  remove_menu_page( 'plugins.php' );                //Plugins
	  remove_menu_page( 'users.php' );                  //Users
	  remove_menu_page( 'tools.php' );                  //Tools
	  remove_menu_page( 'options-general.php' );        //Settings
	  remove_menu_page( 'edit.php?post_type=slider' );
	  remove_menu_page( 'wpcf7' );
	  remove_menu_page( 'godaddy' );
	endif;

	}
add_action( 'admin_menu', 'remove_menus' );

function title_format($content) {
return '%s';
}
add_filter('private_title_format', 'title_format');
add_filter('protected_title_format', 'title_format');

function add_theme_caps() {
   $role = get_role( 'author' );
   $role->add_cap( 'edit_others_posts' );
}
add_action( 'admin_init', 'add_theme_caps');

function is_tree($pid) {      // $pid = The ID of the page we're looking for pages underneath
	global $post;         // load details about this page
	if(is_page()&&($post->post_parent==$pid||is_page($pid)))
               return true;   // we're at the page or at a sub page
	else
               return false;  // we're elsewhere
};
