<?php
/**
 * Admin settings page.
 */

defined( 'ABSPATH' ) || exit;

class Cheasy_Web3_Settings {
const OPTION_KEY = 'cheasy_web3_settings';

public static function init() {
add_action( 'admin_menu', array( __CLASS__, 'register_page' ) );
add_action( 'admin_init', array( __CLASS__, 'register_settings' ) );
}

public static function register_page() {
add_options_page(
__( 'Cheasy Web3', 'cheasy-web3' ),
__( 'Cheasy Web3', 'cheasy-web3' ),
'manage_options',
'cheasy-web3',
array( __CLASS__, 'render_page' )
);
}

public static function register_settings() {
register_setting( self::OPTION_KEY, self::OPTION_KEY, array( __CLASS__, 'sanitize' ) );

add_settings_section( 'cheasy_web3_network', __( 'Network', 'cheasy-web3' ), '__return_false', self::OPTION_KEY );
add_settings_field( 'rpc_url', __( 'BSC RPC URL', 'cheasy-web3' ), array( __CLASS__, 'field_input' ), self::OPTION_KEY, 'cheasy_web3_network', array( 'key' => 'rpc_url' ) );
add_settings_field( 'usdt_address', __( 'USDT Contract', 'cheasy-web3' ), array( __CLASS__, 'field_input' ), self::OPTION_KEY, 'cheasy_web3_network', array( 'key' => 'usdt_address' ) );
add_settings_field( 'usdc_address', __( 'USDC Contract', 'cheasy-web3' ), array( __CLASS__, 'field_input' ), self::OPTION_KEY, 'cheasy_web3_network', array( 'key' => 'usdc_address' ) );
add_settings_field( 'confirmations', __( 'Required Confirmations', 'cheasy-web3' ), array( __CLASS__, 'field_number' ), self::OPTION_KEY, 'cheasy_web3_network', array( 'key' => 'confirmations', 'min' => 1 ) );

add_settings_section( 'cheasy_web3_wallets', __( 'Wallet Providers', 'cheasy-web3' ), '__return_false', self::OPTION_KEY );
add_settings_field( 'wallet_providers', __( 'Enabled Wallets', 'cheasy-web3' ), array( __CLASS__, 'field_checkbox_group' ), self::OPTION_KEY, 'cheasy_web3_wallets' );
}

public static function sanitize( $input ) {
$defaults = self::get_defaults();

$input = wp_parse_args( $input, $defaults );
$input['rpc_url']        = esc_url_raw( $input['rpc_url'] );
$input['usdt_address']   = sanitize_text_field( $input['usdt_address'] );
$input['usdc_address']   = sanitize_text_field( $input['usdc_address'] );
$input['confirmations']  = absint( $input['confirmations'] );
$input['wallet_providers'] = array_map( 'sanitize_key', (array) $input['wallet_providers'] );

return $input;
}

public static function field_input( $args ) {
$options = get_option( self::OPTION_KEY, self::get_defaults() );
$key     = $args['key'];
$value   = isset( $options[ $key ] ) ? $options[ $key ] : '';
printf( '<input type="text" class="regular-text" name="%1$s[%2$s]" value="%3$s" />', esc_attr( self::OPTION_KEY ), esc_attr( $key ), esc_attr( $value ) );
}

public static function field_number( $args ) {
$options = get_option( self::OPTION_KEY, self::get_defaults() );
$key     = $args['key'];
$value   = isset( $options[ $key ] ) ? $options[ $key ] : '';
printf( '<input type="number" class="small-text" min="%4$d" name="%1$s[%2$s]" value="%3$s" />', esc_attr( self::OPTION_KEY ), esc_attr( $key ), esc_attr( $value ), isset( $args['min'] ) ? (int) $args['min'] : 0 );
}

public static function field_checkbox_group() {
$options   = get_option( self::OPTION_KEY, self::get_defaults() );
$providers = array(
'metamask'      => __( 'MetaMask', 'cheasy-web3' ),
'walletconnect' => __( 'WalletConnect', 'cheasy-web3' ),
'trust'         => __( 'Trust Wallet', 'cheasy-web3' ),
);

foreach ( $providers as $key => $label ) {
$checked = in_array( $key, (array) $options['wallet_providers'], true ) ? 'checked' : '';
printf( '<label style="display:block;margin-bottom:6px;"><input type="checkbox" name="%1$s[wallet_providers][]" value="%2$s" %4$s /> %3$s</label>', esc_attr( self::OPTION_KEY ), esc_attr( $key ), esc_html( $label ), $checked );
}
}

public static function render_page() {
?>
<div class="wrap">
<h1><?php esc_html_e( 'Cheasy Web3 Settings', 'cheasy-web3' ); ?></h1>
<form action="options.php" method="post">
<?php
settings_fields( self::OPTION_KEY );
do_settings_sections( self::OPTION_KEY );
submit_button();
?>
</form>
</div>
<?php
}

public static function get_defaults() {
return array(
'rpc_url'          => 'https://rpc.ankr.com/bsc',
'usdt_address'     => '',
'usdc_address'     => '',
'confirmations'    => 3,
'wallet_providers' => array( 'metamask', 'walletconnect', 'trust' ),
);
}
}

Cheasy_Web3_Settings::init();
