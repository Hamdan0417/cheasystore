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
<a class="text-2xl font-bold text-dark" href="<?php echo esc_url( home_url( '/' ) ); ?>">Cheasy</a>
<nav class="hidden lg:block">
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
