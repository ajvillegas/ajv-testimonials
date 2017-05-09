# AJV Testimonials

Easily manage and display client testimonials on your website.

**Contributors**: [ajvillegas](http://profiles.wordpress.org/ajvillegas)  
**Tags**: [testimonials](http://wordpress.org/plugins/tags/testimonials), [shortcode](http://wordpress.org/plugins/tags/shortcode)  
**Requires at least**: 4.5  
**Tested up to**: 4.8  
**Stable tag**: 1.0.1  
**License**: [GPLv2 or later](http://www.gnu.org/licenses/gpl-2.0.html)

# Description

This plugin allows you to easily manage and display client testimonials on your website by adding a new 'Testimonials' custom post type and custom taxonomy for categorizing testimonials.

You can display testimonials anywhere on your website using the `[ajv-testimonials]` shortcode or the included 'Testimonials' widget. You can also use the 'Insert Testimonials' button in the page editor to automatically add the shortcode to your page or post content.

The shortcode accepts two optional parameters, `category` and `class`. You can specify which categories you want displayed by entering the slug for each category separated by a comma, and add custom CSS classes by separating each with a space.

The following example shows how you can implement the shortcode on your website:

`[ajv-testimonials category="cat1,cat2,cat3" class="class1 class2"]`

# Installation

### Using The WordPress Dashboard

1. Navigate to the 'Add New' Plugin Dashboard
2. Click on 'Upload Plugin' and select `ajv-testimonials.zip` from your computer
3. Click on 'Install Now'
4. Activate the plugin on the WordPress Plugins Dashboard

### Using FTP

1. Extract `ajv-testimonials.zip` to your computer
2. Upload the `ajv-testimonials` directory to your `wp-content/plugins` directory
3. Activate the plugin on the WordPress Plugins Dashboard

# Screenshots

*Admin table view*

![Admin table view](wp-assets/screenshot-1.png?raw=true)

*Testimonial editor page*

![Testimonial editor page](wp-assets/screenshot-2.png?raw=true)

# Changelog

**1.0.1**
* Updated post meta IDs.
* Updated shortcode to use a dash instead of an underscore.
* Removed category ID from the taxonomy admin table.

**1.0.0**
* Initial release.
