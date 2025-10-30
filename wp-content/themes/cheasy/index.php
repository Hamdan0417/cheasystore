<?php
/**
 * Default index template.
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<main class="container mx-auto px-4 lg:px-0 py-12">
<?php if ( have_posts() ) : ?>
<?php while ( have_posts() ) : the_post(); ?>
<article <?php post_class( 'prose max-w-3xl mx-auto mb-12' ); ?>>
<?php the_title( '<h1 class="text-3xl font-semibold">', '</h1>' ); ?>
<div class="mt-4">
<?php the_content(); ?>
</div>
</article>
<?php endwhile; ?>
<?php else : ?>
<p><?php esc_html_e( 'No content yet. Stay tuned for fresh drops!', 'cheasy' ); ?></p>
<?php endif; ?>
</main>
<?php get_footer();
