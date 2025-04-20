<?php

/**
 * Plugin Name: Inspire Translations
 * Plugin URI: https://www.wordpress.org/inspire-translations
 * Description: My plugin's description
 * Version: 1.0
 * Requires at least: 5.6
 * Requires PHP: 7.0
 * Author: Felipe Borges
 * Author URI: https://www.auhtor.net
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: inspire-translations
 * Domain Path: /languages
 */
/*
Inspire Translations is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
Inspire Translations is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with Inspire Translations. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
*/

if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

if (!class_exists('Inspire_Translations')) {

	class Inspire_Translations
	{

		public function __construct()
		{

			$this->define_constants();
		}

		public function define_constants()
		{
			// Path/URL to root of this plugin, with trailing slash.
			define('INSPIRE_TRANSLATIONS_PATH', plugin_dir_path(__FILE__));
			define('INSPIRE_TRANSLATIONS_URL', plugin_dir_url(__FILE__));
			define('INSPIRE_TRANSLATIONS_VERSION', '1.0.0');
		}

		/**
		 * Activate the plugin
		 */
		public static function activate() {
			update_option('rewrite_rules', '' );

			global $wpdb;

			$table_name = $wpdb->prefix . "translationmeta";

			$ipt_db_version = get_option( 'ipt_translation_db_version' ) ;

			if( empty( $ipt_db_version ) ) {
					$query = "
							CREATE TABLE $table_name (
									meta_id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
									translation_id bigint(20) NOT NULL DEFAULT '0',
									meta_key varchar(255) DEFAULT NULL,
									meta_value longtext,
									PRIMARY KEY  (meta_id),
									KEY translation_id (translation_id),
									KEY meta_key (meta_key))
									ENGINE=InnoDB DEFAULT CHARSET=utf8;";
					
					require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
					dbDelta( $query );

					$ipt_db_version = '1.0';
					add_option( 'ipt_translation_db_version', $ipt_db_version );
			}
		}

		/**
		 * Deactivate the plugin
		 */
		public static function deactivate()
		{
			flush_rewrite_rules();
		}

		/**
		 * Uninstall the plugin
		 */
		public static function uninstall() {}
	}
}

// Plugin Instantiation
if (class_exists('Inspire_Translations')) {

	// Installation and uninstallation hooks
	register_activation_hook(__FILE__, array('Inspire_Translations', 'activate'));
	register_deactivation_hook(__FILE__, array('Inspire_Translations', 'deactivate'));
	register_uninstall_hook(__FILE__, array('Inspire_Translations', 'uninstall'));

	// Instatiate the plugin class
	$inspire_translations = new Inspire_Translations();
}
