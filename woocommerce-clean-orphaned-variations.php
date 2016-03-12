<?php
/**
 * Plugin name: WooCommerce Clean Orphaned Variations
 * Plugin URI: https://github.com/Seravo/woocommerce-clean-orphaned-variations
 * Description: Adds a tool to the WooCommerce tools page which finds and deletes any Product variations without parents.
 * Version: 1.0
 * Author: @anttiviljami
 * Author: https://github.com/anttiviljami
 * License: GPLv3
 * Text Domain: woocommerce-clean-orphaned-variations
 */

/** Copyright 2016 Antti Kuosmanen
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 3, as
  published by the Free Software Foundation.
  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
  GNU General Public License for more details.
  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if (!class_exists('WooCommerce_Clean_Orphaned_Variations')) {
  class WooCommerce_Clean_Orphaned_Variations {
    public static $instance;

    public static function init() {
      if ( is_null( self::$instance ) ) {
        self::$instance = new WooCommerce_Clean_Orphaned_Variations();
      }
      return self::$instance;
    }

    private function __construct() {
      // load textdomain for translations
      add_action( 'plugins_loaded',  array( $this, 'load_our_textdomain' ) );
    }

    /**
     * Load our textdomain
     */
    function load_our_textdomain() {
      load_plugin_textdomain( 'woocommerce-clean-orphaned-variations', false, dirname( plugin_basename(__FILE__) ) . '/lang/' );
    }
}

// init the plugin
$woocommerce_clean_orphaned_variations = WooCommerce_Clean_Orphaned_Variations::init();
