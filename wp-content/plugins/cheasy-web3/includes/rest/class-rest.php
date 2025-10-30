<?php
/**
 * REST endpoints for Web3 operations.
 */

defined( 'ABSPATH' ) || exit;

class Cheasy_Web3_Rest {
public static function register_routes() {
if ( ! class_exists( 'WP_REST_Server' ) ) {
return;
}
register_rest_route(
'cheasy-web3/v1',
'/session',
array(
'callback'            => array( __CLASS__, 'create_session' ),
'methods'             => WP_REST_Server::CREATABLE,
'permission_callback' => '__return_true',
)
);

register_rest_route(
'cheasy-web3/v1',
'/transactions',
array(
'callback'            => array( __CLASS__, 'store_transaction' ),
'methods'             => WP_REST_Server::CREATABLE,
'permission_callback' => array( __CLASS__, 'validate_nonce' ),
)
);
}

public static function create_session( WP_REST_Request $request ) {
return rest_ensure_response(
array(
'nonce'    => wp_create_nonce( 'cheasy_web3_auth' ),
'message'  => __( 'Sign this message to authenticate with Cheasy.', 'cheasy-web3' ),
'issuedAt' => gmdate( 'c' ),
)
);
}

public static function store_transaction( WP_REST_Request $request ) {
if ( ! function_exists( 'wc_get_order' ) ) {
return new WP_Error( 'cheasy_web3_missing_wc', __( 'WooCommerce is required for crypto payments.', 'cheasy-web3' ), array( 'status' => 500 ) );
}
$order_id = absint( $request->get_param( 'order_id' ) );
$tx_hash  = sanitize_text_field( $request->get_param( 'tx_hash' ) );

if ( ! $order_id || empty( $tx_hash ) ) {
return new WP_Error( 'cheasy_web3_invalid', __( 'Missing order or transaction hash.', 'cheasy-web3' ), array( 'status' => 400 ) );
}

$order = wc_get_order( $order_id );
if ( ! $order ) {
return new WP_Error( 'cheasy_web3_order', __( 'Order not found.', 'cheasy-web3' ), array( 'status' => 404 ) );
}

$order->update_meta_data( '_cheasy_web3_tx_hash', $tx_hash );
$order->save();

return rest_ensure_response(
array(
'status' => 'pending',
'message'=> __( 'Transaction saved. Waiting for confirmations.', 'cheasy-web3' ),
)
);
}

public static function validate_nonce( WP_REST_Request $request ) {
$nonce = $request->get_header( 'x-wp-nonce' );
return (bool) wp_verify_nonce( $nonce, 'wp_rest' );
}
}
