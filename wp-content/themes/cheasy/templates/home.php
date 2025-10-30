<?php
/**
 * Template Name: Cheasy Home
 */

global $product;

get_header();
?>
<main class="home-landing">
<section class="hero grid grid-cols-1 lg:grid-cols-3 gap-6">
<div class="col-span-2 p-8 rounded-3xl bg-gradient-to-r from-orange-500 to-blue-600 text-white">
<h1 class="text-4xl font-bold mb-4"><?php esc_html_e( 'Discover smart deals tailored for you', 'cheasy' ); ?></h1>
<p class="text-lg opacity-90 mb-6"><?php esc_html_e( 'Fresh dropshipping arrivals, trending best sellers, and crypto checkout built-in.', 'cheasy' ); ?></p>
<?php if ( function_exists( 'wc_get_page_permalink' ) ) : ?>
<a class="inline-flex items-center px-6 py-3 rounded-full bg-white text-orange-500 font-semibold" href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>">
<?php esc_html_e( 'Shop Flash Deals', 'cheasy' ); ?>
</a>
<?php endif; ?>
</div>
<div class="col-span-1 grid gap-4">
<div class="p-4 rounded-xl bg-white shadow-sm">
<h2 class="font-semibold text-lg mb-2"><?php esc_html_e( 'Hot Categories', 'cheasy' ); ?></h2>
<ul class="space-y-1 text-sm">
<?php foreach ( cheasy_get_default_mega_menu_structure() as $category => $children ) : ?>
<li class="flex justify-between">
<span><?php echo esc_html( $category ); ?></span>
<span class="text-blue-600"><?php echo esc_html( count( $children ) ); ?> <?php esc_html_e( 'options', 'cheasy' ); ?></span>
</li>
<?php endforeach; ?>
</ul>
</div>
<div class="p-4 rounded-xl bg-white shadow-sm">
<h2 class="font-semibold text-lg mb-2"><?php esc_html_e( 'Crypto-native perks', 'cheasy' ); ?></h2>
<p class="text-sm text-slate-600"><?php esc_html_e( 'Sign in with your wallet, earn loyalty USDT rewards and pay directly via BSC.', 'cheasy' ); ?></p>
</div>
</div>
</section>

<section class="flash-deals mt-12">
<div class="flex items-center justify-between mb-4">
<h2 class="text-2xl font-semibold"><?php esc_html_e( 'Flash Deals', 'cheasy' ); ?></h2>
<?php if ( function_exists( 'wc_get_page_permalink' ) ) : ?>
<a class="text-blue-600 text-sm font-medium" href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>"><?php esc_html_e( 'View all deals', 'cheasy' ); ?></a>
<?php endif; ?>
</div>
<div class="grid grid-cols-2 md:grid-cols-4 xl:grid-cols-5 gap-4">
<?php
$flash_query = new WP_Query(
array(
'post_type'      => 'product',
'posts_per_page' => 10,
'orderby'        => 'date',
'order'          => 'DESC',
)
);
if ( $flash_query->have_posts() ) :
while ( $flash_query->have_posts() ) :
$flash_query->the_post();
wc_get_template_part( 'content', 'product' );
endwhile;
wp_reset_postdata();
else :
printf( '<p class="text-sm text-slate-500">%s</p>', esc_html__( 'Deals incoming — stay tuned!', 'cheasy' ) );
endif;
?>
</div>
</section>

<section class="featured-collections mt-16">
<h2 class="text-2xl font-semibold mb-6"><?php esc_html_e( 'Shop by collection', 'cheasy' ); ?></h2>
<div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
<?php foreach ( cheasy_get_default_mega_menu_structure() as $category => $children ) : ?>
<article class="rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-all bg-white p-6 flex flex-col">
<h3 class="text-xl font-semibold text-slate-900 mb-3"><?php echo esc_html( $category ); ?></h3>
<ul class="space-y-1 text-sm text-slate-600">
<?php foreach ( $children as $child ) : ?>
<li><?php echo esc_html( $child ); ?></li>
<?php endforeach; ?>
</ul>
<span class="mt-auto inline-flex items-center gap-2 text-blue-600 text-sm font-medium"><?php esc_html_e( 'Explore now', 'cheasy' ); ?><svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor"><path d="M7 4l5 6-5 6"/></svg></span>
</article>
<?php endforeach; ?>
</div>
</section>
</main>
<?php
get_footer();
