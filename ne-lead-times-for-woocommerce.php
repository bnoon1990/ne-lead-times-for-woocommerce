<?php

/**
 * Plugin Name: Lead times for WooCommerce - By Noon Elite
 * Description: Adds lead times for products.
 * Version: 1.0
 * Author: Ben Noon ( Noon Elite )
 * License: GPL2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Requires Plugins: WooCommerce
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

class BN_Noon_Elite_Lead_Times_For_Woocommerce_Plugin
{
    public function enqueue_admin_scripts($hook)
    {
        $screen = get_current_screen();
        if ($screen->id === 'product') {
            wp_enqueue_script('bn_noon_elite_lead_times_admin_script', plugin_dir_url(__FILE__) . 'dist/admin.min.js', array('jquery'), '1.0', true);
        }
    }

    public function enqueue_public_scripts()
    {
        if (is_product()) {
            wp_enqueue_script('bn_noon_elite_lead_times_public_script', plugin_dir_url(__FILE__) . 'dist/frontend.min.js', array('jquery'), '1.0', true);
        }
    }

    public function enqueue_admin_styles($hook)
    {
        $screen = get_current_screen();
        if ($screen->id === 'product') {
            wp_enqueue_style('bn_noon_elite_lead_times_admin_style', plugin_dir_url(__FILE__) . '/dist/admin.min.css', array(), '1.0');
        }
    }

    public function enqueue_public_styles()
    {
        if (is_product()) {
            wp_enqueue_style('bn_noon_elite_lead_times_public_style', plugin_dir_url(__FILE__) . '/dist/frontend.min.css', array(), '1.0');
        }
    }
}

new BN_Noon_Elite_Lead_Times_For_Woocommerce_Plugin();
