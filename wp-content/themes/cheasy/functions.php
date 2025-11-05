<?php
/**
 * Cheasy theme bootstrap file.
 */

define( 'CHEASY_THEME_VERSION', '0.1.0' );
define( 'CHEASY_THEME_DIR', get_template_directory() );
define( 'CHEASY_THEME_URI', get_template_directory_uri() );

require_once CHEASY_THEME_DIR . '/inc/menus.php';
require_once CHEASY_THEME_DIR . '/inc/performance.php';
require_once CHEASY_THEME_DIR . '/inc/security.php';
require_once CHEASY_THEME_DIR . '/inc/seo.php';
require_once CHEASY_THEME_DIR . '/inc/media.php';

if ( ! function_exists( 'cheasy_setup' ) ) {
function cheasy_setup() {
add_theme_support( 'woocommerce' );
add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );
add_theme_support( 'custom-logo', array( 'height' => 64, 'width' => 200, 'flex-width' => true ) );

register_nav_menus( cheasy_register_menus() );
}
}
add_action( 'after_setup_theme', 'cheasy_setup' );

function cheasy_enqueue_assets() {
$theme_version = CHEASY_THEME_VERSION;

wp_enqueue_style( 'cheasy-theme', CHEASY_THEME_URI . '/assets/css/theme.css', array(), $theme_version );
wp_enqueue_script( 'cheasy-vendor', CHEASY_THEME_URI . '/assets/js/vendor.js', array(), $theme_version, true );
wp_enqueue_script( 'cheasy-theme', CHEASY_THEME_URI . '/assets/js/theme.js', array( 'jquery' ), $theme_version, true );
wp_localize_script(
'cheasy-theme',
'cheasyTheme',
array(
'ajaxUrl'   => admin_url( 'admin-ajax.php' ),
'nonce'     => wp_create_nonce( 'cheasy_nonce' ),
'assetBase' => CHEASY_THEME_URI . '/assets/',
)
);
}
add_action( 'wp_enqueue_scripts', 'cheasy_enqueue_assets' );

function cheasy_enqueue_block_editor_assets() {
wp_enqueue_style( 'cheasy-block-editor', CHEASY_THEME_URI . '/assets/css/editor.css', array(), CHEASY_THEME_VERSION );
}
add_action( 'enqueue_block_editor_assets', 'cheasy_enqueue_block_editor_assets' );

function cheasy_widgets_init() {
register_sidebar(
array(
'name'          => __( 'Footer Widgets', 'cheasy' ),
'id'            => 'cheasy-footer',
'description'   => __( 'Widgets displayed in the footer columns.', 'cheasy' ),
'before_widget' => '<section id="%1$s" class="widget %2$s">',
'after_widget'  => '</section>',
'before_title'  => '<h3 class="widget-title">',
'after_title'   => '</h3>',
)
);
}
add_action( 'widgets_init', 'cheasy_widgets_init' );

