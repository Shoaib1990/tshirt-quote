<?php

// Register custom post type for submissions
function ccqp_register_submission_post_type() {
    register_post_type('ccqp_submission', [
        'labels' => [
            'name' => 'Quote Submissions',
            'singular_name' => 'Quote Submission'
        ],
        'public' => false,
        'has_archive' => false,
        'show_ui' => true,
        'supports' => ['title', 'custom-fields'],
        'menu_icon' => 'dashicons-list-view'
    ]);
}
add_action('init', 'ccqp_register_submission_post_type');

// Submission List Page
function ccqp_submission_list_page() {
    $submissions = get_posts([
        'post_type' => 'ccqp_submission',
        'post_status' => 'publish',
        'numberposts' => -1,
    ]);

    echo '<div class="wrap"><h1>Quote Submission List</h1>';
    echo '<table class="wp-list-table widefat fixed striped">';
    echo '<thead><tr><th>Date</th><th>Color</th><th>Quantity</th><th>Price</th></tr></thead><tbody>';

    foreach ($submissions as $submission) {
        $color = get_post_meta($submission->ID, 'Color', true);
        $quantity = get_post_meta($submission->ID, 'Quantity', true);
        $price = get_post_meta($submission->ID, 'Price', true);

        echo '<tr>';
        echo '<td>' . esc_html($submission->post_date) . '</td>';
        echo '<td>' . esc_html($color) . '</td>';
        echo '<td>' . esc_html($quantity) . '</td>';
        echo '<td>$' . esc_html($price) . '</td>';
        echo '</tr>';
    }

    echo '</tbody></table></div>';
}
