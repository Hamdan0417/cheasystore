<?php
/**
 * Meta generator service.
 */

defined( 'ABSPATH' ) || exit;

class Cheasy_SEO_Generator {
protected static $instance = null;

public static function instance() {
if ( null === self::$instance ) {
self::$instance = new self();
}

return self::$instance;
}

public function render_meta_tags() {
$context = $this->build_context();

$tags   = array();
$tags[] = sprintf( '<meta name="description" content="%s" />', esc_attr( $context['description'] ) );
$tags[] = sprintf( '<meta property="og:title" content="%s" />', esc_attr( $context['title'] ) );
$tags[] = sprintf( '<meta property="og:description" content="%s" />', esc_attr( $context['description'] ) );
$tags[] = sprintf( '<meta property="og:url" content="%s" />', esc_url( $context['url'] ) );
$tags[] = sprintf( '<meta name="twitter:card" content="summary_large_image" />' );

return implode( "\n", apply_filters( 'cheasy_seo_meta_tags', $tags, $context ) );
}

protected function build_context() {
if ( function_exists( 'is_product' ) && is_product() ) {
global $product;
$title       = $product->get_name() . ' | Cheasy';
$description = wp_strip_all_tags( $product->get_short_description() );
} elseif ( function_exists( 'is_product_category' ) && is_product_category() ) {
$term        = get_queried_object();
$title       = sprintf( __( '%s deals delivered fast | Cheasy', 'cheasy-seo-gen' ), $term->name );
$description = wp_strip_all_tags( term_description( $term ) );
} else {
$title       = wp_get_document_title();
$description = get_bloginfo( 'description' );
}

global $wp;

$current_url = home_url( add_query_arg( array(), $wp ? $wp->request : '' ) );

return array(
'title'       => $title,
'description' => $description,
'url'         => $current_url,
);
}
}
