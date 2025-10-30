<?php
/**
 * Performance-related optimizations.
 */

if ( ! defined( 'ABSPATH' ) ) {
exit;
}

function cheasy_performance_init() {
add_action( 'wp_head', 'cheasy_output_preconnects', 1 );
add_action( 'wp_head', 'cheasy_output_critical_css', 2 );
add_filter( 'script_loader_tag', 'cheasy_defer_non_essential_scripts', 10, 3 );
add_filter( 'style_loader_src', 'cheasy_remove_query_strings', 10, 2 );
}
add_action( 'after_setup_theme', 'cheasy_performance_init' );

function cheasy_output_preconnects() {
$origins = array(
'https://fonts.googleapis.com',
'https://fonts.gstatic.com',
'https://cdn.jsdelivr.net',
'https://unpkg.com',
);

foreach ( $origins as $origin ) {
echo '<link rel="preconnect" href="' . esc_url( $origin ) . '" crossorigin />';
}
}

function cheasy_output_critical_css() {
$critical_path = CHEASY_THEME_DIR . '/assets/css/critical.css';

if ( ! file_exists( $critical_path ) ) {
return;
}

$critical_css = file_get_contents( $critical_path );

if ( empty( $critical_css ) ) {
return;
}

echo '<style id="cheasy-critical-css">' . wp_strip_all_tags( $critical_css ) . '</style>';
}

function cheasy_defer_non_essential_scripts( $tag, $handle, $src ) {
$defer_handles = array( 'cheasy-theme', 'cheasy-vendor' );

if ( in_array( $handle, $defer_handles, true ) ) {
return '<script src="' . esc_url( $src ) . '" defer></script>';
}

return $tag;
}

function cheasy_remove_query_strings( $src ) {
if ( strpos( $src, '?ver' ) ) {
$src = remove_query_arg( 'ver', $src );
}

return $src;
}

