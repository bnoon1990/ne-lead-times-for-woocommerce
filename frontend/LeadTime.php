<?php

namespace NoonElite\LeadTimesForWooCommerce\Frontend;

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

class LeadTime
{
    public function __construct()
    {
        add_action('woocommerce_single_product_summary', [$this, 'display_lead_time'], 10);
    }

    public function display_lead_time()
    {
        global $product;
        $lead_time = get_post_meta($product->get_id(), '_lead_time', true);
        if (!empty($lead_time)) {
            echo '<p class="lead-time">' . __('Lead Time: ', 'woocommerce') . esc_html($lead_time) . ' ' . __('days', 'woocommerce') . '</p>';
        }
    }
}
