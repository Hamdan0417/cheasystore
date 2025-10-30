<?php
/**
 * Schema generator service.
 */

defined( 'ABSPATH' ) || exit;

class Cheasy_SEO_Schema {
protected static $instance = null;

public static function instance() {
if ( null === self::$instance ) {
self::$instance = new self();
}

return self::$instance;
}

public function render_schema() {
$context = $this->build_context();
$template = $this->locate_template( $context['template'] );

if ( ! $template ) {
return '';
}

ob_start();
$payload = $context['data'];
include $template;
$json = ob_get_clean();

return sprintf( '<script type="application/ld+json">%s</script>', $json );
}

protected function build_context() {
if ( function_exists( 'is_product' ) && is_product() ) {
global $product;
return array(
'template' => 'schema-product.php',
'data'     => array(
'name'        => $product->get_name(),
'description' => wp_strip_all_tags( $product->get_short_description() ),
'sku'         => $product->get_sku(),
'price'       => $product->get_price(),
'currency'    => get_woocommerce_currency(),
'availability'=> $product->is_in_stock() ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock',
),
);
}

if ( function_exists( 'is_page_template' ) && is_page_template( 'templates/page-faq.php' ) ) {
return array(
'template' => 'schema-faq.php',
'data'     => array( 'faq' => $this->extract_faq_blocks() ),
);
}

return array(
'template' => 'schema-organization.php',
'data'     => array(
'name' => get_bloginfo( 'name' ),
'url'  => home_url(),
'logo' => get_theme_mod( 'custom_logo' ),
),
);
}

protected function extract_faq_blocks() {
global $post;
$faqs = array();

if ( has_blocks( $post->post_content ) ) {
$blocks = parse_blocks( $post->post_content );
foreach ( $blocks as $block ) {
if ( 'core/paragraph' === $block['blockName'] ) {
$faqs[] = array(
'question' => wp_strip_all_tags( $block['attrs']['placeholder'] ?? 'Question' ),
'answer'   => wp_strip_all_tags( $block['innerHTML'] ),
);
}
}
}

return $faqs;
}

protected function locate_template( $template ) {
$path = CHEASY_SEO_GEN_DIR . 'templates/' . $template;
return file_exists( $path ) ? $path : false;
}
}
