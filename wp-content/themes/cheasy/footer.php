<?php
/**
 * Theme footer.
 */

defined( 'ABSPATH' ) || exit;
?>
</main>
<footer class="bg-[#111111] text-white mt-16">
<div class="container mx-auto px-4 lg:px-0 py-10 grid grid-cols-1 md:grid-cols-4 gap-8 text-sm">
<div>
<h3 class="text-lg font-semibold mb-3"><?php esc_html_e( 'About Cheasy', 'cheasy' ); ?></h3>
<p class="opacity-80"><?php esc_html_e( 'Dropshipping marketplace delivering trending products with transparent pricing.', 'cheasy' ); ?></p>
</div>
<div>
<h3 class="text-lg font-semibold mb-3"><?php esc_html_e( 'Customer Care', 'cheasy' ); ?></h3>
<?php
wp_nav_menu(
array(
'theme_location' => 'footer',
'container'      => false,
'menu_class'     => 'space-y-2',
)
);
?>
</div>
<div>
<h3 class="text-lg font-semibold mb-3"><?php esc_html_e( 'Policies', 'cheasy' ); ?></h3>
<?php
wp_nav_menu(
array(
'theme_location' => 'copyright',
'container'      => false,
'menu_class'     => 'space-y-2',
)
);
?>
</div>
<div>
<h3 class="text-lg font-semibold mb-3"><?php esc_html_e( 'Stay in the loop', 'cheasy' ); ?></h3>
<p class="opacity-80"><?php esc_html_e( 'Join our newsletter for flash deals and crypto rewards.', 'cheasy' ); ?></p>
<form class="mt-3 flex">
<input type="email" class="px-3 py-2 rounded-l-full text-dark" placeholder="<?php esc_attr_e( 'Email address', 'cheasy' ); ?>" required>
<button type="submit" class="px-4 py-2 rounded-r-full bg-[#FF6A00] text-white font-semibold"><?php esc_html_e( 'Subscribe', 'cheasy' ); ?></button>
</form>
</div>
</div>
<div class="border-t border-white/10 py-4 text-center text-xs opacity-60">
&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> Cheasy Labs. <?php esc_html_e( 'All rights reserved.', 'cheasy' ); ?>
</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
