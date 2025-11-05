<?php
/**
 * SEO bridge for cheasy-seo-gen plugin.
 */

if ( ! defined( 'ABSPATH' ) ) {
exit;
}

add_action( 'wp_head', 'cheasy_output_default_meta_description', 1 );
/**
 * Provide a meta description fallback when the SEO plugin is inactive.
 */
function cheasy_output_default_meta_description() {
if ( function_exists( 'cheasy_seo_gen_render_meta' ) ) {
return;
}

$description = '';

if ( is_singular() ) {
$object = get_queried_object();

if ( $object instanceof WP_Post ) {
if ( has_excerpt( $object ) ) {
$description = $object->post_excerpt;
} else {
$description = $object->post_content;
}
}
} else {
$description = get_bloginfo( 'description', 'display' );
}

$description = trim( wp_strip_all_tags( $description ) );

if ( empty( $description ) ) {
return;
}

$description = wp_trim_words( $description, 40 );

echo '<meta name="description" content="' . esc_attr( $description ) . '" />';
echo '<meta property="og:description" content="' . esc_attr( $description ) . '" />';
echo '<meta name="twitter:description" content="' . esc_attr( $description ) . '" />';
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

