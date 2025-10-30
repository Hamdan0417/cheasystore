<?php
/**
 * Template for the Contact page.
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<div class="container mx-auto px-4 lg:px-0 py-12">
<header class="max-w-3xl mb-10">
<?php the_title( '<h1 class="text-3xl font-semibold text-slate-900">', '</h1>' ); ?>
<p class="text-sm text-slate-600 mt-2"><?php echo esc_html( get_post_meta( get_the_ID(), 'cheasy_page_intro', true ) ); ?></p>
</header>
<div class="prose prose-slate max-w-4xl">
<?php
while ( have_posts() ) :
the_post();
the_content();
endwhile;
?>
</div>
</div>
<?php
get_footer();
