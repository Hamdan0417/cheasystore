<?php
/**
 * Navigation registrations and walkers.
 */

if ( ! defined( 'ABSPATH' ) ) {
exit;
}

function cheasy_register_menus() {
return array(
'primary'   => __( 'Primary Mega Menu', 'cheasy' ),
'utility'   => __( 'Utility Bar Menu', 'cheasy' ),
'footer'    => __( 'Footer Links', 'cheasy' ),
'copyright' => __( 'Footer Copyright Links', 'cheasy' ),
);
}

class Cheasy_Mega_Menu_Walker extends Walker_Nav_Menu {
public function start_lvl( &$output, $depth = 0, $args = null ) {
$indent = str_repeat( "\t", $depth );
$output .= "\n{$indent}<div class=\"cheasy-mega\"><div class=\"cheasy-mega__columns\"><ul class=\"cheasy-mega__column\">\n";
}

public function end_lvl( &$output, $depth = 0, $args = null ) {
$indent = str_repeat( "\t", $depth );
$output .= "{$indent}</ul></div></div>\n";
}

public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
$classes   = empty( $item->classes ) ? array() : (array) $item->classes;
$classes[] = 'menu-item-' . $item->ID;

$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

$output .= sprintf( '<li%s>', $class_names );
$output .= sprintf( '<a href="%1$s">%2$s</a>', esc_url( $item->url ), apply_filters( 'the_title', $item->title, $item->ID ) );

if ( 0 === $depth && in_array( 'mega-parent', $classes, true ) ) {
$output .= '<span class="cheasy-mega__toggle" aria-hidden="true"></span>';
}
}

public function end_el( &$output, $item, $depth = 0, $args = null ) {
$output .= '</li>';
}
}

function cheasy_get_default_mega_menu_structure() {
return array(
'Electronics'      => array( 'Phones', 'Computers', 'Smart Home', 'Audio' ),
'Fashion'          => array( 'Men', 'Women', 'Shoes', 'Accessories' ),
'Home & Kitchen'   => array( 'Appliances', 'Decor', 'Storage' ),
'Beauty & Health'  => array( 'Skincare', 'Tools', 'Personal Care' ),
'Sports & Outdoors'=> array( 'Fitness', 'Camping' ),
'Toys & Kids'      => array( 'STEM', 'Toys', 'Baby' ),
'Auto & Tools'     => array( 'Car Accessories', 'Tools' ),
);
}

