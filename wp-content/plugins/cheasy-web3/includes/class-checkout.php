<?php
/**
 * Crypto checkout logic.
 */

defined( 'ABSPATH' ) || exit;

class Cheasy_Web3_Checkout {
public static function init() {
if ( ! class_exists( 'WooCommerce' ) ) {
return;
}
add_filter( 'woocommerce_payment_gateways', array( __CLASS__, 'register_gateway' ) );
add_action( 'woocommerce_thankyou_cheasy_crypto', array( __CLASS__, 'thankyou_page' ) );
add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_scripts' ) );
}

public static function register_gateway( $gateways ) {
$gateways[] = 'Cheasy_Web3_Gateway';
return $gateways;
}

public static function thankyou_page( $order_id ) {
$order = wc_get_order( $order_id );
if ( ! $order ) {
return;
}

$tx_hash = $order->get_meta( '_cheasy_web3_tx_hash' );

if ( $tx_hash ) {
printf( '<p>%s <strong>%s</strong></p>', esc_html__( 'Transaction hash:', 'cheasy-web3' ), esc_html( $tx_hash ) );
}
}

public static function enqueue_scripts() {
if ( ! is_checkout() ) {
return;
}

wp_enqueue_script( 'cheasy-web3-checkout', CHEASY_WEB3_URL . 'includes/js/checkout.js', array(), CHEASY_WEB3_VERSION, true );
$options = get_option( Cheasy_Web3_Settings::OPTION_KEY, Cheasy_Web3_Settings::get_defaults() );
wp_localize_script(
'cheasy-web3-checkout',
'cheasyWeb3Checkout',
array(
'nonce'          => wp_create_nonce( 'wp_rest' ),
'endpoint'       => rest_url( '/cheasy-web3/v1/transactions' ),
'rpcUrl'         => $options['rpc_url'],
'usdtAddress'    => $options['usdt_address'],
'usdcAddress'    => $options['usdc_address'],
'confirmations'  => (int) $options['confirmations'],
'wallets'        => $options['wallet_providers'],
)
);
}
}

if ( class_exists( 'WC_Payment_Gateway' ) ) {
class Cheasy_Web3_Gateway extends WC_Payment_Gateway {
public function __construct() {
$this->id                 = 'cheasy_crypto';
$this->icon               = CHEASY_WEB3_URL . 'assets/crypto-icon.svg';
$this->has_fields         = true;
$this->method_title       = __( 'Cheasy Crypto', 'cheasy-web3' );
$this->method_description = __( 'Pay using stablecoins on Binance Smart Chain.', 'cheasy-web3' );

$this->init_form_fields();
$this->init_settings();

add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options' ) );
}

public function init_form_fields() {
$this->form_fields = array(
'enabled'      => array(
'title'   => __( 'Enable/Disable', 'cheasy-web3' ),
'type'    => 'checkbox',
'label'   => __( 'Enable Cheasy Crypto payments', 'cheasy-web3' ),
'default' => 'yes',
),
'title'        => array(
'title'       => __( 'Title', 'cheasy-web3' ),
'type'        => 'text',
'description' => __( 'This controls the title which the user sees during checkout.', 'cheasy-web3' ),
'default'     => __( 'Pay with Crypto', 'cheasy-web3' ),
),
'description'  => array(
'title'       => __( 'Description', 'cheasy-web3' ),
'type'        => 'textarea',
'description' => __( 'Payment instructions for the customer.', 'cheasy-web3' ),
'default'     => __( 'Complete payment with USDT or USDC over Binance Smart Chain.', 'cheasy-web3' ),
),
);
}

public function payment_fields() {
if ( $this->get_description() ) {
echo wpautop( wptexturize( $this->get_description() ) );
}
printf( '<div class="cheasy-web3-widget" data-gateway="%s" data-order-id=""></div>', esc_attr( $this->id ) );
}

public function validate_fields() {
return true;
}

public function process_payment( $order_id ) {
$order = wc_get_order( $order_id );
$order->update_status( 'on-hold', __( 'Awaiting on-chain confirmation.', 'cheasy-web3' ) );

return array(
'result'   => 'success',
'redirect' => $order->get_checkout_order_received_url(),
);
}
}
}
