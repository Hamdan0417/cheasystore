<?php
/**
 * WooCommerce product archive template override.
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );
?>
<div class="cheasy-container container mx-auto px-4 lg:px-0">
<header class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 py-8">
<div>
<?php if ( function_exists( 'woocommerce_breadcrumb' ) ) : ?>
<?php woocommerce_breadcrumb(); ?>
<?php endif; ?>
<h1 class="text-3xl font-semibold text-slate-900">
<?php echo function_exists( 'woocommerce_page_title' ) ? esc_html( woocommerce_page_title( false ) ) : esc_html( get_the_title() ); ?>
</h1>
<p class="text-sm text-slate-600"><?php esc_html_e( 'Filter by brand, price, shipping origin, and more to find the perfect deal.', 'cheasy' ); ?></p>
</div>
<div class="flex items-center gap-3">
<?php if ( function_exists( 'woocommerce_catalog_ordering' ) ) : ?>
<?php woocommerce_catalog_ordering(); ?>
<?php endif; ?>
<?php if ( function_exists( 'woocommerce_result_count' ) ) : ?>
<?php woocommerce_result_count(); ?>
<?php endif; ?>
</div>
</header>
<div class="grid grid-cols-1 lg:grid-cols-[280px_minmax(0,1fr)] gap-8">
<aside class="bg-white shadow-sm rounded-2xl p-6">
<h2 class="text-lg font-semibold mb-4"><?php esc_html_e( 'Refine results', 'cheasy' ); ?></h2>
<?php
if ( shortcode_exists( 'woocommerce_product_filter' ) ) {
echo do_shortcode( '[woocommerce_product_filter]' );
} else {
esc_html_e( 'Install the product filter plugin to enable advanced filtering.', 'cheasy' );
}
?>
</aside>
<section>
<?php
if ( woocommerce_product_loop() ) {
woocommerce_product_loop_start();

if ( wc_get_loop_prop( 'total' ) ) {
while ( have_posts() ) {
the_post();
do_action( 'woocommerce_shop_loop' );
wc_get_template_part( 'content', 'product' );
}
}

woocommerce_product_loop_end();

do_action( 'woocommerce_after_shop_loop' );
} else {
do_action( 'woocommerce_no_products_found' );
}
?>
</section>
</div>
</div>
<?php
get_footer( 'shop' );
