<?php
/**
 * Media helpers for accessibility and performance.
 */

if ( ! defined( 'ABSPATH' ) ) {
exit;
}

add_filter( 'wp_get_attachment_image_attributes', 'cheasy_normalize_attachment_attributes', 10, 3 );
/**
 * Ensure attachments include sane defaults for accessibility and performance.
 *
 * @param array        $attr       Attributes for the image markup.
 * @param WP_Post      $attachment Attachment object.
 * @param string|array $size       Requested size.
 *
 * @return array
 */
function cheasy_normalize_attachment_attributes( $attr, $attachment, $size ) {
if ( empty( $attr['alt'] ) ) {
$alt = get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true );

if ( ! $alt ) {
$alt = get_the_title( $attachment->ID );
}

if ( $alt ) {
$attr['alt'] = wp_strip_all_tags( $alt );
}
}

if ( empty( $attr['loading'] ) ) {
$attr['loading'] = 'lazy';
}

if ( empty( $attr['decoding'] ) ) {
$attr['decoding'] = 'async';
}

return $attr;
}

add_filter( 'woocommerce_product_get_image', 'cheasy_filter_product_image', 10, 6 );
/**
 * Inject accessible fallbacks into WooCommerce product image markup.
 *
 * @param string            $image_html Original HTML.
 * @param WC_Product        $product    Product object.
 * @param string|array      $size       Requested size handle or dimensions.
 * @param array             $attr       Existing attributes.
 * @param string            $placeholder Placeholder image markup.
 * @param int               $image_id   Attachment ID.
 *
 * @return string
 */
function cheasy_filter_product_image( $image_html, $product, $size, $attr, $placeholder, $image_id ) {
if ( empty( $image_id ) ) {
return $image_html;
}

$default_alt = ( class_exists( 'WC_Product' ) && $product instanceof WC_Product ) ? $product->get_name() : get_bloginfo( 'name' );

$attr = wp_parse_args(
$attr,
array(
'alt'      => $default_alt,
'loading'  => 'lazy',
'decoding' => 'async',
)
);

if ( empty( $attr['alt'] ) ) {
$attr['alt'] = $default_alt;
}

$size_class = is_string( $size ) ? $size : 'woocommerce_thumbnail';
$classes    = array_filter( array_map( 'trim', explode( ' ', isset( $attr['class'] ) ? $attr['class'] : '' ) ) );
$classes[]  = 'attachment-woocommerce_thumbnail';
$classes[]  = 'size-' . sanitize_html_class( $size_class );
$attr['class'] = implode( ' ', array_unique( $classes ) );

if ( 'woocommerce_single' === $size ) {
$attr['loading']       = 'eager';
$attr['fetchpriority'] = isset( $attr['fetchpriority'] ) ? $attr['fetchpriority'] : 'high';
}

$normalized = wp_get_attachment_image( $image_id, $size, false, $attr );

return $normalized ? $normalized : $image_html;
}
