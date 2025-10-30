<?php
/**
 * SEO bridge for cheasy-seo-gen plugin.
 */

if ( ! defined( 'ABSPATH' ) ) {
exit;
}

function cheasy_seo_meta_output() {
if ( ! function_exists( 'cheasy_seo_gen_render_meta' ) ) {
return;
}

echo cheasy_seo_gen_render_meta();
}
add_action( 'wp_head', 'cheasy_seo_meta_output', 5 );

function cheasy_seo_schema_output() {
if ( ! function_exists( 'cheasy_seo_gen_render_schema' ) ) {
return;
}

echo cheasy_seo_gen_render_schema();
}
add_action( 'wp_footer', 'cheasy_seo_schema_output', 20 );

