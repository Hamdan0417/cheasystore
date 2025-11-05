<?php
/**
 * Theme header.
 */

defined( 'ABSPATH' ) || exit;
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<?php wp_head(); ?>
</head>
<body <?php body_class( 'bg-surface text-dark' ); ?>>
<?php wp_body_open(); ?>
<header class="shadow-sm bg-white">
<div class="container mx-auto px-4 lg:px-0 py-4 flex items-center justify-between gap-6">
<div class="flex items-center gap-3">
<?php
$home_url  = home_url( '/' );
$site_name = get_bloginfo( 'name' );

if ( has_custom_logo() ) {
$custom_logo_id = get_theme_mod( 'custom_logo' );
$logo_markup    = '';

if ( $custom_logo_id ) {
$logo_src    = wp_get_attachment_image_src( $custom_logo_id, 'full' );
$logo_width  = is_array( $logo_src ) && isset( $logo_src[1] ) ? (int) $logo_src[1] : 160;
$logo_height = is_array( $logo_src ) && isset( $logo_src[2] ) ? (int) $logo_src[2] : 48;
$logo_markup = wp_get_attachment_image(
$custom_logo_id,
'full',
false,
array(
'class'   => 'site-logo h-10 w-auto',
'alt'     => $site_name,
'loading' => 'eager',
'decoding' => 'async',
'width'   => $logo_width > 0 ? $logo_width : 160,
'height'  => $logo_height > 0 ? $logo_height : 48,
)
);
}

if ( $logo_markup ) {
echo '<a class="flex items-center" href="' . esc_url( $home_url ) . '" aria-label="' . esc_attr( $site_name ) . '">' . $logo_markup . '</a>';
} else {
echo '<a class="text-2xl font-bold text-dark" href="' . esc_url( $home_url ) . '">' . esc_html( $site_name ) . '</a>';
}
} else {
echo '<a class="text-2xl font-bold text-dark" href="' . esc_url( $home_url ) . '">' . esc_html( $site_name ) . '</a>';
}
?>
<nav class="hidden lg:block" aria-label="<?php esc_attr_e( 'Primary navigation', 'cheasy' ); ?>">
<?php
wp_nav_menu(
array(
'theme_location' => 'primary',
'container'      => false,
'menu_class'     => 'flex items-center gap-6 text-sm font-medium',
'walker'         => new Cheasy_Mega_Menu_Walker(),
)
);
?>
</nav>
</div>
<div class="flex items-center gap-4 text-sm">
<?php if ( function_exists( 'wc_get_page_permalink' ) ) : ?>
<a class="text-blue-600 font-semibold" href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>"><?php esc_html_e( 'Account', 'cheasy' ); ?></a>
<?php endif; ?>
<?php if ( function_exists( 'wc_get_cart_url' ) ) : ?>
<a class="btn-primary" href="<?php echo esc_url( wc_get_cart_url() ); ?>"><?php esc_html_e( 'Cart', 'cheasy' ); ?></a>
<?php endif; ?>
</div>
</div>
</header>
<main id="content">
