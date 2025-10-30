<?php
/**
 * Enqueue child theme assets.
 */

add_action(
'wp_enqueue_scripts',
function () {
wp_enqueue_style( 'cheasy-child', get_stylesheet_uri(), array( 'cheasy-theme' ), '0.1.0' );
}
);
