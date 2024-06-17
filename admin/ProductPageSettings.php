<?php

namespace NoonElite\LeadTimesForWooCommerce\Admin;

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

class ProductPageSettings
{
    public function __construct()
    {
        add_filter('woocommerce_product_data_tabs', array($this, 'add_lead_time_tab'));
        add_action('woocommerce_product_data_panels', array($this, 'add_custom_general_fields'));
        add_action('woocommerce_process_product_meta', array($this, 'save_custom_general_fields'));
    }

    public function add_lead_time_tab($tabs)
    {
        $tabs['lead_time'] = array(
            'label'    => __('Lead Time', 'woocommerce'),
            'target'   => 'lead_time_product_data',
            'class'    => array(),
            'priority' => 80,
        );
        return $tabs;
    }

    public function add_custom_general_fields()
    {
        echo '<div id="lead_time_product_data" class="panel woocommerce_options_panel hidden">';
        woocommerce_wp_text_input(
            array(
                'id'          => '_lead_time',
                'label'       => __('Lead Time', 'woocommerce'),
                'placeholder' => 'Enter lead time in days',
                'desc_tip'    => 'true',
                'description' => __('Enter the lead time for this product in days.', 'woocommerce')
            )
        );
        echo '</div>';
    }

    public function save_custom_general_fields($post_id)
    {
        $lead_time = isset($_POST['_lead_time']) ? sanitize_text_field($_POST['_lead_time']) : '';
        update_post_meta($post_id, '_lead_time', $lead_time);
    }
}
