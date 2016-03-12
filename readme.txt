=== WooCommerce Clean Orphaned Variations ===
Contributors: Zuige
Tags: Woocommerce, Tool, Tools, Clean, Orphaned, Variations
Donate link: https://seravo.fi/
Requires at least: 4.3.1
Tested up to: 4.4
Stable tag: 1.0
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html

== Description ==

Adds a tool to the WooCommerce tools page which finds and deletes any Product variations without parents.

**Usage**

1. Navigate to: WooCommerce > System Status > Tools (/wp-admin/admin.php?page=wc-status&tab=tools)
2. Click the "Clean Orphaned Variations" -button

**Why?**

Sometimes, for reasons unknown, WooCommerce will leave orphaned variation products in the database which can cause all sorts of problems.

Most commonly, you would get this error message

    PHP Fatal error:  Call to a member function get_attributes() on a non-object in /my/wp/root/wp-content/plugins/woocommerce/includes/class-wc-product-variation.php on line 664

This small tool is a quick and easy fix for those situations.

**Contributing**

Please contribute to this project on Github. Pull requests welcome!

https://github.com/anttiviljami/wp-libre-form

== Installation ==

1. Upload plugin to the `/wp-content/plugins/` directory.
2. Activate the plugin through the "Plugins" menu in WordPress.
3. Installation done!

== Frequently Asked Questions ==

None yet.

== Screenshots ==

1. The tools page

== Changelog ==

Note that complete commit log is available at https://github.com/anttiviljami/woocommerce-clean-orphaned-variations/commits/master

== Upgrade Notice ==

* 1.0 There's a new version available. Please update!
