<?php

/**
 * The custom post type and taxonomy functionality of the plugin.
 *
 * @link       http://www.alexisvillegas.com
 * @since      1.0.0
 *
 * @package    AJV_Testimonials
 * @subpackage AJV_Testimonials/admin
 */

/**
 * The custom post type and taxonomy functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    AJV_Testimonials
 * @subpackage AJV_Testimonials/admin
 * @author     Alexis J. Villegas <alexis@ajvillegas.com>
 */
class AJV_Testimonials_CPT {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param    string    $plugin_name		The name of this plugin.
	 * @param    string    $version			The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}
	
	/**
	 * Register the 'Testimonials' custom post type.
	 *
	 * @since    1.0.0
	 */
	public function custom_post_type() {
		
		register_post_type( 'ajv_testimonials', array(
				'labels' => apply_filters( 'ajv_testimonials_post_type_labels', array(
					'name'				=> _x( 'Testimonials', 'post type general name', 'ajv-testimonials' ),
					'singular_name'		=> _x( 'Testimonial', 'post type singular name', 'ajv-testimonials' ),
					'menu_name'			=> _x( 'Testimonials', 'admin menu', 'ajv-testimonials' ),
					'name_admin_bar'	=> _x( 'Testimonial', 'add new on admin bar', 'ajv-testimonials' ),
					'add_new' 			=> _x( 'Add New', 'testimonial', 'ajv-testimonials' ),
					'add_new_item' 		=> __( 'Add New Testimonial', 'ajv-testimonials' ),
					'new_item' 			=> __( 'New Testimonial', 'ajv-testimonials' ),
					'edit_item' 		=> __( 'Edit Testimonial', 'ajv-testimonials' ),
					'view_item' 		=> __( 'View Testimonial', 'ajv-testimonials' ),
					'all_items'			=> __( 'All Testimonials', 'ajv-testimonials' ),
					'search_items' 		=> __( 'Search Testimonials', 'ajv-testimonials' ),
					'parent_item_colon' => __( 'Parent Testimonial:', 'ajv-testimonials' ),
					'not_found' 		=> __( 'No Testimonials Found', 'ajv-testimonials' ),
					'not_found_in_trash'=> __( 'No Testimonials Found in Trash', 'ajv-testimonials' ),
				) ),
				'public' 			 => false,
				'publicly_queryable' => false,
				'exclude_from_search'=> true,
				'show_in_menu' 		 => true,
				'show_ui' 			 => true,
				'rewrite' 			 => false,
				'query_var'			 => true,
				'capability_type'    => 'post',
				'has_archive' 		 => false,
				'hierarchical' 		 => false,
				'menu_position' 	 => 20,
				'menu_icon'			 => 'dashicons-testimonial',
				'taxonomies'		 => array( 'ajv_testimonial_category' ),
				'supports' 			 => array( 'title', 'thumbnail', 'page-attributes' ),
			)
		);

	}

	/**
	 * Register the 'Testimonials' custom taxonomy.
	 *
	 * @since    1.0.0
	 */
	public function custom_taxonomy() {
		
		register_taxonomy( 'ajv_testimonial_category', 'ajv_testimonials', array(
				'labels' => apply_filters( 'ajv_testimonials_taxonomy_labels', array(
					'name'						=> _x( 'Testimonial Categories', 'taxonomy general name', 'ajv-testimonials' ),
					'singular_name'				=> _x( 'Testimonial Category', 'taxonomy singular name', 'ajv-testimonials' ),
					'menu_name'					=> __( 'Categories', 'ajv-testimonials' ),
					'search_items'				=> __( 'Search Testimonial Categories', 'ajv-testimonials' ),
					'all_items'					=> __( 'All Testimonial Categories', 'ajv-testimonials' ),
					'parent_item'				=> __( 'Parent Testimonial Category', 'ajv-testimonials' ),
					'parent_item_colon' 		=> __( 'Parent Testimonial Category:', 'ajv-testimonials' ),
					'edit_item'					=> __( 'Edit Testimonial Category', 'ajv-testimonials' ),
					'update_item'				=> __( 'Update Testimonial Category', 'ajv-testimonials' ),
					'add_new_item'				=> __( 'Add New Testimonial Category', 'ajv-testimonials' ),
					'new_item_name'				=> __( 'New Testimonial Category Name', 'ajv-testimonials' ),
					'popular_items' 			=> __( 'Popular Categories', 'ajv-testimonials' ),
					'separate_items_with_commas'=> __( 'Separate categories with commas', 'ajv-testimonials' ),
					'add_or_remove_items'		=> __( 'Add or remove categories', 'ajv-testimonials' ),
					'choose_from_most_used'		=> __( 'Choose from the most used categories', 'ajv-testimonials' ),
					'not_found'					=> __( 'No categories found', 'ajv-testimonials' ),
				) ),
				'public'			 => false,
				'show_ui'			 => true,
				'show_in_menu'		 => true,
				'show_in_nav_menus'	 => false,
				'show_tagcloud'		 => false,
				'hierarchical'		 => true,
				'has_archive'		 => false,
				'show_admin_column'	 => true,
				'rewrite'			 => false,
			)
		);

	}
	
}
