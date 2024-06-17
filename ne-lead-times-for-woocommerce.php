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

require __DIR__ . '/vendor/autoload.php';

use NoonElite\LeadTimesForWooCommerce\Admin\ProductPageSettings;
use NoonElite\LeadTimesForWooCommerce\Frontend\LeadTime;

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

class BN_Noon_Elite_Lead_Times_For_Woocommerce_Plugin
{
    private $productPageSettings;
    private $leadTime;

    public function __construct()
    {
        add_action('plugins_loaded', array($this, 'init'));
    }

    public function init()
    {
        if (!in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
            add_action('admin_notices', array($this, 'woocommerce_not_active_notice'));
            deactivate_plugins(plugin_basename(__FILE__));
            return;
        }

        $this->productPageSettings = new ProductPageSettings();
        $this->leadTime = new LeadTime();

        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_public_scripts'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_styles'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_public_styles'));
    }

    public function woocommerce_not_active_notice()
    {
        echo '<div class="error"><p>' . __('Lead times for WooCommerce requires WooCommerce plugin to be running to work.', 'bn-noon-elite-lead-times-for-woocommerce') . '</p></div>';
    }

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
