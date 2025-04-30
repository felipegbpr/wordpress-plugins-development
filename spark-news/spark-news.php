<?php

/**
* Plugin Name: Spark News
* Plugin URI: https://www.wordpress.org/spark-news
* Description: My plugin's description
* Version: 1.0
* Requires at least: 5.6
* Requires PHP: 7.0
* Author: Felipe Borges
* Author URI: https://www.author.example.net
* License: GPL v2 or later
* License URI: https://www.gnu.org/licenses/gpl-2.0.html
* Text Domain: spark-news
* Domain Path: /languages
*/
/*
Spark News is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
Spark News is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with Spark News. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( !class_exists( 'Spark_News' ) ){

    class Spark_News{

        public function __construct() {

            // Define constants used througout the plugin
            $this->define_constants();     
            
        }

         /**
         * Define Constants
         */
        public function define_constants() {
            // Path/URL to root of this plugin, with trailing slash.
               
        }

        /**
         * Activate the plugin
         */
        public static function activate() {
           
        }

        /**
         * Deactivate the plugin
         */
        public static function deactivate() {
           
        }

        /**
         * Uninstall the plugin
         */
        public static function uninstall() {
					
        }

    }
}

if ( class_exists( 'Spark_News' ) ) {
    // Installation and uninstallation hooks
   
}