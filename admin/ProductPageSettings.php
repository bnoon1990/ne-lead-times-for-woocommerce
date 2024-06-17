<?php

namespace NoonElite\LeadTimesForWooCommerce;

class ProductPageSettings
{
    public function __construct()
    {
        add_action('woocommerce_product_options_general_product_data', array($this, 'add_custom_general_fields'));
        add_action('woocommerce_process_product_meta', array($this, 'save_custom_general_fields'));
    }

    public function add_custom_general_fields()
    {
        woocommerce_wp_text_input(
            array(
                'id'          => '_lead_time',
                'label'       => __('Lead Time', 'woocommerce'),
                'placeholder' => 'Enter lead time in days',
                'desc_tip'    => 'true',
                'description' => __('Enter the lead time for this product in days.', 'woocommerce')
            )
        );
    }

    public function save_custom_general_fields($post_id)
    {
        $lead_time = isset($_POST['_lead_time']) ? sanitize_text_field($_POST['_lead_time']) : '';
        update_post_meta($post_id, '_lead_time', $lead_time);
    }
}

new ProductPageSettings();
