<?php
/**
 * Plugin Name: WebDevise Team Elementor Widget
 * Description: Plugin provides different types of layouts for the Teams.
 * Plugin URI:  https://web-devise.com/
 * Version:     1.0.0
 * Author:      WEB Devise
 * Text Domain: web-devise-tew
 * Requires at least: 4.8
 * Tested up to: 5.8.1
 * Requires PHP: 5.6
 * Elementor tested up to: 3.0.0
 * Elementor Pro tested up to: 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

require_once( plugin_dir_path( __FILE__ ) . 'inc/elementor/elementor.php' );

/**
 * Registering image sizes
 *
 */
if ( ! function_exists( 'devise_team_setup' ) ) {
	function devise_team_setup() {
		add_image_size( 'team-1-photo', 200, 280 );
		add_image_size( 'team-2-photo', 500, 500, true );
		add_image_size( 'team-3-photo-w', 400, 600, true );
		add_image_size( 'team-3-photo-h', 600, 400, true );
	}
}
add_action( 'after_setup_theme', 'devise_team_setup' );

/**
 * Load Textdomain
 *
 * Load plugin localization files.
 */
if ( ! function_exists( 'devise_i18n' ) ) {
	function devise_i18n() {
		load_plugin_textdomain( 'web-devise-tew', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}
}
add_action( 'init', 'devise_i18n' );
