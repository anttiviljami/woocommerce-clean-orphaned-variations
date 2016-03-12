# WooCommerce Clean Orphaned Variations
[![License](http://img.shields.io/:license-gpl3-blue.svg)](http://www.gnu.org/licenses/gpl-3.0.html)

Adds a tool to the WooCommerce tools page which finds and deletes any Product variations without parents.

## Usage

1. Navigate to: *WooCommerce > System Status > Tools* (`/wp-admin/admin.php?page=wc-status&tab=tools`)
2. Click the "Clean Orphaned Variations" -button

## Screenshots

![Clean Orphaned Variations button](/assets/screenshot-1.png)

## Why?

Sometimes, for reasons unknown, WooCommerce will leave orphaned variation products in the database which can cause all sorts of problems.

Most commonly, you would get this error message
```
PHP Fatal error:  Call to a member function get_attributes() on a non-object in /my/wp/root/wp-content/plugins/woocommerce/includes/class-wc-product-variation.php on line 664
```

This small tool is a quick and easy fix for those situations.

## Installation

1. Upload plugin to the `/wp-content/plugins/` directory.
2. Activate the plugin through the "Plugins" menu in WordPress.
3. Installation done!

