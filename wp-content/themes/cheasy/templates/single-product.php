<?php
/**
 * The Template for displaying all single products.
 */

defined( 'ABSPATH' ) || exit;

global $product;

get_header( 'shop' );
?>
<div class="cheasy-product-page container mx-auto px-4 lg:px-0 py-10">
<?php if ( function_exists( 'woocommerce_breadcrumb' ) ) : ?>
<?php woocommerce_breadcrumb(); ?>
<?php endif; ?>
<div class="grid grid-cols-1 lg:grid-cols-2 gap-10 mt-6">
<div class="product-gallery space-y-4">
<?php do_action( 'woocommerce_before_single_product_summary' ); ?>
</div>
<div class="product-summary bg-white rounded-2xl shadow-sm p-8">
<?php do_action( 'woocommerce_single_product_summary' ); ?>
<div class="mt-6 p-4 bg-slate-50 rounded-xl">
<h2 class="text-lg font-semibold mb-2 flex items-center gap-2">
<span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-teal-400 text-white font-mono">Ξ</span>
<?php esc_html_e( 'Pay with Crypto', 'cheasy' ); ?>
</h2>
<p class="text-sm text-slate-600 mb-3"><?php esc_html_e( 'Secure checkout with USDT/USDC on BSC. Wallets: MetaMask, WalletConnect, Trust Wallet.', 'cheasy' ); ?></p>
<button type="button" class="cheasy-crypto-checkout w-full inline-flex items-center justify-center gap-2 px-4 py-3 rounded-full bg-gradient-to-r from-orange-500 to-blue-600 text-white font-semibold">
<?php esc_html_e( 'Pay with Crypto', 'cheasy' ); ?>
</button>
</div>
</div>
</div>

<div class="mt-16">
<?php do_action( 'woocommerce_after_single_product_summary' ); ?>
</div>

<section class="mt-20">
<h2 class="text-2xl font-semibold mb-6"><?php esc_html_e( 'Frequently asked questions', 'cheasy' ); ?></h2>
<?php if ( shortcode_exists( 'cheasy_faq' ) ) : ?>
<?php echo do_shortcode( '[cheasy_faq]' ); ?>
<?php else : ?>
<p class="text-sm text-slate-500"><?php esc_html_e( 'FAQ content coming soon.', 'cheasy' ); ?></p>
<?php endif; ?>
</section>
</div>
<?php
get_footer( 'shop' );
