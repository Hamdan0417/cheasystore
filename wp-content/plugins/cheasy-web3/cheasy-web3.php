<?php
/**
 * Plugin Name: Cheasy Web3
 * Description: Wallet authentication and crypto checkout integrations for Cheasy store.
 * Version: 0.1.0
 * Author: Cheasy Labs
 * Text Domain: cheasy-web3
 */

defined( 'ABSPATH' ) || exit;

define( 'CHEASY_WEB3_VERSION', '0.1.0' );
define( 'CHEASY_WEB3_DIR', plugin_dir_path( __FILE__ ) );
define( 'CHEASY_WEB3_URL', plugin_dir_url( __FILE__ ) );

require_once CHEASY_WEB3_DIR . 'includes/class-auth.php';
require_once CHEASY_WEB3_DIR . 'includes/class-checkout.php';
require_once CHEASY_WEB3_DIR . 'includes/class-blocks.php';
require_once CHEASY_WEB3_DIR . 'includes/rest/class-rest.php';
require_once CHEASY_WEB3_DIR . 'admin/settings.php';

add_action( 'plugins_loaded', array( 'Cheasy_Web3_Auth', 'init' ) );
add_action( 'plugins_loaded', array( 'Cheasy_Web3_Checkout', 'init' ) );
add_action( 'init', array( 'Cheasy_Web3_Blocks', 'register_blocks' ) );
add_action( 'rest_api_init', array( 'Cheasy_Web3_Rest', 'register_routes' ) );

