<?php
/**
 * Wallet authentication handler.
 */

defined( 'ABSPATH' ) || exit;

class Cheasy_Web3_Auth {
public static function init() {
add_action( 'login_form', array( __CLASS__, 'render_wallet_button' ) );
add_action( 'woocommerce_login_form', array( __CLASS__, 'render_wallet_button' ) );
add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_scripts' ) );
add_action( 'login_enqueue_scripts', array( __CLASS__, 'enqueue_scripts' ) );
add_action( 'wp_ajax_cheasy_wallet_login', array( __CLASS__, 'handle_login' ) );
add_action( 'wp_ajax_nopriv_cheasy_wallet_login', array( __CLASS__, 'handle_login' ) );
}

public static function render_wallet_button() {
?>
<div class="cheasy-wallet-login">
<button type="button" class="button button-primary cheasy-wallet-trigger" data-action="login">
<?php esc_html_e( 'Sign in with Wallet', 'cheasy-web3' ); ?>
</button>
</div>
<?php
}

public static function enqueue_scripts() {
wp_enqueue_script( 'cheasy-web3-auth', CHEASY_WEB3_URL . 'includes/js/auth.js', array(), CHEASY_WEB3_VERSION, true );
wp_localize_script(
'cheasy-web3-auth',
'cheasyWeb3Auth',
array(
'nonce'    => wp_create_nonce( 'cheasy_web3_auth' ),
'endpoint' => rest_url( '/cheasy-web3/v1/session' ),
)
);
wp_enqueue_style( 'cheasy-web3-auth', CHEASY_WEB3_URL . 'includes/css/auth.css', array(), CHEASY_WEB3_VERSION );
}

public static function handle_login() {
check_ajax_referer( 'cheasy_web3_auth', 'nonce' );

$address = isset( $_POST['address'] ) ? sanitize_text_field( wp_unslash( $_POST['address'] ) ) : '';

if ( empty( $address ) ) {
wp_send_json_error( array( 'message' => __( 'Wallet address missing.', 'cheasy-web3' ) ), 400 );
}

$user = self::get_user_by_wallet( $address );

if ( ! $user ) {
$random_password = wp_generate_password( 24, true );
$user_id         = wp_create_user( $address, $random_password, $address . '@wallet.local' );

if ( is_wp_error( $user_id ) ) {
wp_send_json_error( array( 'message' => $user_id->get_error_message() ), 400 );
}

update_user_meta( $user_id, 'cheasy_wallet_address', $address );
$user = get_user_by( 'id', $user_id );
}

wp_set_current_user( $user->ID );
wp_set_auth_cookie( $user->ID );

$redirect = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'myaccount' ) : home_url();
wp_send_json_success( array( 'redirect' => apply_filters( 'cheasy_web3_login_redirect', $redirect ) ) );
}

public static function get_user_by_wallet( $address ) {
$user_query = new WP_User_Query(
array(
'number'     => 1,
'meta_key'   => 'cheasy_wallet_address',
'meta_value' => $address,
)
);

$users = $user_query->get_results();

return $users ? $users[0] : false;
}
}
