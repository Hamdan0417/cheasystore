<?php
/**
 * Gutenberg block registration for wallet buttons.
 */

defined( 'ABSPATH' ) || exit;

class Cheasy_Web3_Blocks {
public static function register_blocks() {
if ( ! function_exists( 'register_block_type' ) ) {
return;
}

register_block_type(
'cheasy/web3-wallet-button',
array(
'render_callback' => array( __CLASS__, 'render_wallet_button' ),
)
);
}

public static function render_wallet_button( $attributes = array() ) {
$label = isset( $attributes['label'] ) ? $attributes['label'] : __( 'Sign in with Wallet', 'cheasy-web3' );

return sprintf( '<button class="cheasy-wallet-trigger" data-action="login">%s</button>', esc_html( $label ) );
}
}
