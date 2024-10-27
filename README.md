# TShirt Quote
**Contributors:** Shoaib Khalid (Me)
**Tags:** tshirt, quote, custom field, color selection, quantity, pricing

**Video URL:** https://youtu.be/ChiEFrBR-o4

A WordPress plugin that allows users to get a quote for t-shirts by selecting color and quantity, with dynamic pricing based on the quantity.

### Description

The TShirt Quote plugin is designed to allow users to quickly get a price quote for t-shirts based on selected colors and quantity. The plugin includes customizable options in the backend to toggle color and quantity fields on the frontend form. The plugin calculates the total price dynamically, and submissions are saved in the backend for easy review.

**Key Features:**
* Dropdown for color selection (options: gray, white, black, red).
* Quantity field with price calculation ($5 per t-shirt).
* Dynamic price update as quantity changes.
* Backend settings to enable/disable fields.
* Submission tracking in the WordPress dashboard with a summary table displaying color, quantity, and calculated price.

### Installation

1. Upload the `tshirt-quote` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Go to "TShirt Quote" in the WordPress admin menu to configure settings and view submissions.

### Usage

1. Use the `[quote_form]` shortcode to display the TShirt Quote form on any post or page.
2. On the frontend, users can select a color, enter the quantity, and see the price update dynamically.
3. Submissions are saved in the backend and can be reviewed under "TShirt Quote > Submission List."


### Frequently Asked Questions

**How do I display the TShirt Quote form on a page or post?**
Simply add the `[quote_form]` shortcode to the desired page or post.

**Can I change the colors available in the dropdown?**
Currently, the colors are hardcoded to gray, white, yellow, and red. You can modify the code in the `ccqp_frontend_form()` function to change these colors.

**Where can I see the submissions?**
Submissions are available in the WordPress admin dashboard under "TShirt Quote > Submission List."

### Changelog

**1.4**
* Added dynamic price calculation feature.
* Organized plugin structure into separate files and added styling.
* Added image directory for future enhancements.

**1.3**
* Added backend list view for submissions with color, quantity, and price columns.

**1.0**
* Initial release with basic color and quantity fields, with settings page.

### Note:

The primary goals are to implement form submission, add a custom domain, and enable or disable features within this plugin.