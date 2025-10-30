<?php
/**
 * Security hardening helpers.
 */

if ( ! defined( 'ABSPATH' ) ) {
exit;
}

function cheasy_security_headers() {
headers_sent() || header( 'X-Frame-Options: SAMEORIGIN' );
headers_sent() || header( 'X-Content-Type-Options: nosniff' );
headers_sent() || header( 'Referrer-Policy: strict-origin-when-cross-origin' );
headers_sent() || header( 'Permissions-Policy: accelerometer=(), camera=(), microphone=()' );
}
add_action( 'send_headers', 'cheasy_security_headers' );

function cheasy_disable_xmlrpc() {
add_filter( 'xmlrpc_enabled', '__return_false' );
}
add_action( 'init', 'cheasy_disable_xmlrpc' );

function cheasy_limit_login_attempts() {
if ( ! class_exists( 'WP_REST_Server' ) ) {
return;
}

add_filter( 'authenticate', 'cheasy_block_brute_force', 30, 3 );
}
add_action( 'plugins_loaded', 'cheasy_limit_login_attempts' );

function cheasy_block_brute_force( $user, $username ) {
$ip            = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : 'anonymous';
$transient_key = 'cheasy_failed_' . md5( sanitize_key( $username ) . '_' . $ip );
$attempts      = (int) get_transient( $transient_key );

if ( $attempts > 5 ) {
return new WP_Error( 'cheasy_locked', __( 'Too many failed attempts. Please try again later.', 'cheasy' ) );
}

if ( is_wp_error( $user ) ) {
set_transient( $transient_key, $attempts + 1, 15 * MINUTE_IN_SECONDS );
}

return $user;
}

