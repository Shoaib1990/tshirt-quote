<?php
/*
Plugin Name: TShirt Quote
Description: Adds a dropdown for colors, a quantity field, and calculates price based on quantity on the front end. Saves submitted data in the backend and displays it in a table format.
Version: 1.4
Author: Shoaib
Author URI:        https://shoaibkhalid.ca/
*/

if (!defined('ABSPATH')) exit; // Exit if accessed directly

// Include necessary files
require_once plugin_dir_path(__FILE__) . 'includes/quote-post-type.php';

// Enqueue scripts and styles
function ccqp_enqueue_scripts() {
    wp_enqueue_script('tshirt-quote-price-calculation', plugin_dir_url(__FILE__) . 'assets/js/script.js', [], '1.0', true);
    wp_enqueue_style('tshirt-quote-style', plugin_dir_url(__FILE__) . 'assets/css/style.css');
}
add_action('wp_enqueue_scripts', 'ccqp_enqueue_scripts');

// Enqueue admin styles
function ccqp_enqueue_admin_styles() {
    wp_enqueue_style('tshirt-quote-admin-style', plugin_dir_url(__FILE__) . 'assets/css/style.css');
}
add_action('admin_enqueue_scripts', 'ccqp_enqueue_admin_styles');

// Add settings and submission list pages
function ccqp_add_admin_pages() {
    add_menu_page('TShirt Quote Settings', 'TShirt Quote', 'manage_options', 'ccqp_settings', 'ccqp_settings_page', 'dashicons-admin-generic');
    add_submenu_page('ccqp_settings', 'Submission List', 'Submission List', 'manage_options', 'ccqp_submission_list', 'ccqp_submission_list_page');
}
add_action('admin_menu', 'ccqp_add_admin_pages');


// Settings page content
function ccqp_settings_page() {
    if (isset($_POST['ccqp_save_settings'])) {
        update_option('ccqp_show_color', isset($_POST['ccqp_show_color']) ? '1' : '0');
        update_option('ccqp_show_quantity', isset($_POST['ccqp_show_quantity']) ? '1' : '0');
        echo '<div class="updated"><p>Settings saved.</p></div>';
    }

    $show_color = get_option('ccqp_show_color', '1');
    $show_quantity = get_option('ccqp_show_quantity', '1');
    ?>
    <div class="wrap">
        <h1>T-Shirt Order Settings</h1>
        <form method="POST">
            <table class="form-table">
                <tr>
                    <th scope="row"><label for="ccqp_show_color">Show Color</label></th>
                    <td><input type="checkbox" name="ccqp_show_color" id="ccqp_show_color" value="1" <?php checked($show_color, '1'); ?>></td>
                </tr>
                <tr>
                    <th scope="row"><label for="ccqp_show_quantity">Show Quantity</label></th>
                    <td><input type="checkbox" name="ccqp_show_quantity" id="ccqp_show_quantity" value="1" <?php checked($show_quantity, '1'); ?>></td>
                </tr>
            </table>
            <p class="submit"><input type="submit" name="ccqp_save_settings" id="ccqp_save_settings" class="button button-primary" value="Save Settings"></p>
        </form>
    </div>
    <?php
}

// Frontend form shortcode


function ccqp_frontend_form() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ccqp_submit'])) {
        // Sanitize and save form data
        $color = sanitize_text_field($_POST['ccqp_color']);
        $quantity = intval($_POST['ccqp_quantity']);
        $price = $quantity * 5;

        // Create a new post for the submission
        $post_id = wp_insert_post([
            'post_type' => 'ccqp_submission',
            'post_title' => 'Submission - ' . current_time('Y-m-d H:i:s'),
            'post_status' => 'publish'
        ]);

        if ($post_id) {
            update_post_meta($post_id, 'Color', $color);
            update_post_meta($post_id, 'Quantity', $quantity);
            update_post_meta($post_id, 'Price', $price);
        }

        echo '<div class="notice notice-success">Submission successful!</div>';
    }
    
    ob_start();
    ?>
    <form method="post" action="">
    <div class="product_box">
                <img src="<?php echo plugin_dir_url(__FILE__) . 'assets/images/gray.jpg'; ?>" alt="T-shirt" />
            </div>
        <label for="ccqp_color">Choose Color:</label>
        <select name="ccqp_color" id="ccqp_color">
        <option value="gray">Gray</option>
                <option value="white">White</option>
                <option value="black">Black</option>
                <option value="red">Red</option>
        </select>
        
        <br><br>

        <label for="ccqp_quantity">Quantity:</label>
        <input type="number" name="ccqp_quantity" id="ccqp_quantity" min="1" required>
        
        <br><br>

        <!-- Display price dynamically -->
        <label>Total Price: $<span id="ccqp_price">0</span></label>
        <br><br>

        <input type="hidden" name="ccqp_submit" value="1">
        <input type="submit" value="Submit">
    </form>
    <?php
    return ob_get_clean();
}

add_shortcode('quote_form', 'ccqp_frontend_form');
