<?php
/**
 * Plugin Name: Competition Manager
 * Description: A plugin to manage competitions.
 * Version: 1.0.0
 * Author: Your Name
 * Author URI: https://yourwebsite.com
 * Text Domain: competition-manager
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
  exit;
}

define( 'COMPETITIONS_CLIENT_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-competitions_client-activator.php
 */
function activate_competitions_client() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-competitions_client-activator.php';
	Competitions_client_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-competitions_client-deactivator.php
 */
function deactivate_competitions_client() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-competitions_client-deactivator.php';
	Competitions_client_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_competitions_client' );
register_deactivation_hook( __FILE__, 'deactivate_competitions_client' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */

require plugin_dir_path( __FILE__ ) . 'includes/post_type_entries.php';
require plugin_dir_path( __FILE__ ) . 'includes/post_type_competition.php';
require plugin_dir_path( __FILE__ ) . 'includes/make-template_competitions_list.php';
require plugin_dir_path( __FILE__ ) . 'includes/dynimic-submit-entry.php';

