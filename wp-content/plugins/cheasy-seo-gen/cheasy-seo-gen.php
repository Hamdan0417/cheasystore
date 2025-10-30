<?php
/**
 * Plugin Name: Cheasy SEO Generator
 * Description: Automated meta tags and schema templates tailored for Cheasy.
 * Version: 0.1.0
 * Author: Cheasy Labs
 * Text Domain: cheasy-seo-gen
 */

defined( 'ABSPATH' ) || exit;

define( 'CHEASY_SEO_GEN_VERSION', '0.1.0' );
define( 'CHEASY_SEO_GEN_DIR', plugin_dir_path( __FILE__ ) );

require_once CHEASY_SEO_GEN_DIR . 'includes/class-generator.php';
require_once CHEASY_SEO_GEN_DIR . 'includes/class-schema.php';

function cheasy_seo_gen_render_meta() {
return Cheasy_SEO_Generator::instance()->render_meta_tags();
}

function cheasy_seo_gen_render_schema() {
return Cheasy_SEO_Schema::instance()->render_schema();
}

