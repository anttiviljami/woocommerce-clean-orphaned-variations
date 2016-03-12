<?php
/**
 * Plugin name: WooCommerce Clean Orphaned Variations
 * Plugin URI: https://github.com/anttiviljami/woocommerce-clean-orphaned-variations
 * Description: Adds a tool to the WooCommerce tools page which finds and deletes any Product variations without parents.
 * Version: 1.0
 * Author: @anttiviljami
 * Author URI: https://github.com/anttiviljami
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
      add_filter( 'admin_init', array( $this, 'handle_woocommerce_tool' ) );
      add_filter( 'woocommerce_debug_tools', array( $this, 'add_woocommerce_tool' ) );

      // load textdomain for translations
      add_action( 'plugins_loaded',  array( $this, 'load_our_textdomain' ) );
    }

    /**
     * Runs an SQL query in the database, which finds any orphaned variations
     * and deletes them
     *
     * @source: https://gist.github.com/pmgarman/6135967
     */
    public function clean_orphaned_variations() {
      global $wpdb;
      $sql = "DELETE o FROM $wpdb->posts o
        LEFT OUTER JOIN $wpdb->posts r
        ON o.post_parent = r.ID
        WHERE r.id IS null AND o.post_type = 'product_variation'";
      $rows = $wpdb->query( $sql );

      if( false !== $rows ) {
        $this->deleted = $rows;
        add_action( 'admin_notices', array( $this, 'admin_notice__success' ) );
      }
    }

    /**
     * Adds a tool to the WooCommerce tools
     */
    public function add_woocommerce_tool( $tools ) {
      $tools['clean_orphaned_variations'] = array(
        'name'    => __( 'Delete variation products with no parent', 'woocommerce-clean-orphaned-variations' ),
        'button'  => __( 'Clean Orphaned Variations', 'woocommerce-clean-orphaned-variations' ),
        'desc'    => __( '<strong class="red">Note:</strong> This option will delete all posts of type product_variation with no existing parent, use with caution!', 'woocommerce-clean-orphaned-variations' ),
      );
      return $tools;
    }

    /**
     * Runs the tool
     *
     * The tool button, when clicked, will send a GET request to the tab page
     * along with &action=clean_orphaned_variations
     */
    public function handle_woocommerce_tool() {
      // check that we are on woocommerce system status admin page
      if( 'wc-status' != $_REQUEST['page'] ) {
        return;
      }

      // check that we are on the tools tab
      if( 'tools' != $_REQUEST['tab'] ) {
        return;
      }

      // check permissions
      if( ! is_user_logged_in() || ! current_user_can('manage_woocommerce') ) {
        return;
      }

      if ( ! empty( $_GET['action'] ) && ! empty( $_REQUEST['_wpnonce'] ) && wp_verify_nonce( $_REQUEST['_wpnonce'], 'debug_action' ) ) {
        if( $_GET['action'] === 'clean_orphaned_variations' ) {
          $this->clean_orphaned_variations();
        }
      }
    }

    /**
     * Admin notification after running the tool
     */
    public function admin_notice__success( ) {
      $deleted = $this->deleted;
    ?>
<div class="notice notice-success is-dismissible">
  <p><?php echo wp_sprintf( __('%d orphans were deleted.', 'woocommerce-clean-orphaned-variations'), $deleted ); ?></p>
</div>
    <?php
    }

    /**
     * Load our textdomain
     */
    public static function load_our_textdomain() {
      load_plugin_textdomain( 'woocommerce-clean-orphaned-variations', false, dirname( plugin_basename(__FILE__) ) . '/lang/' );
    }
  }
}

// init the plugin
$woocommerce_clean_orphaned_variations = WooCommerce_Clean_Orphaned_Variations::init();
