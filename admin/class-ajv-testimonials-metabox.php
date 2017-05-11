<?php

/**
 * The custom meta box functionality of the plugin.
 *
 * @link       http://www.alexisvillegas.com
 * @since      1.0.0
 *
 * @package    AJV_Testimonials
 * @subpackage AJV_Testimonials/admin
 */

/**
 * The custom meta box functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    AJV_Testimonials
 * @subpackage AJV_Testimonials/admin
 * @author     Alexis J. Villegas <alexis@ajvillegas.com>
 */
class AJV_Testimonials_Metabox {

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
	 * Register the 'Testimonials' post meta box.
	 *
	 * @since    1.0.0
	 */
	public function add_testimonials_meta_box() {
		
		add_meta_box( 'ajv-testimonials-meta-box', __( 'Testimonial Details', 'ajv-testimonials' ), array( $this, 'testimonials_meta_box' ), 'ajv_testimonials', 'normal', 'high' );
		
	}
	
	/**
	 * Define the 'Testimonials' post meta box.
	 *
	 * @since    1.0.0
	 */
	public function testimonials_meta_box( $post ) {
		
		wp_nonce_field( basename( __FILE__ ), 'ajv_testimonials_nonce' );
		$testimonials_stored_meta = get_post_meta( $post->ID );
		
		// Meta box markup
		include( plugin_dir_path( __FILE__ ) . 'partials/ajv-testimonials-metabox-markup.php' );
			
	}
	
	/**
	 * Save the 'Testimonials' post meta box values.
	 *
	 * @since    1.0.0
	 */
	public function save_meta_box_values( $post_id ) {
		
		// Check save status
		$is_autosave = wp_is_post_autosave( $post_id );
		$is_revision = wp_is_post_revision( $post_id );
		$is_valid_nonce = ( isset( $_POST[ 'ajv_testimonials_nonce' ] ) && wp_verify_nonce( $_POST[ 'ajv_testimonials_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
		
		// Exit depending on save status
		if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
			return;
		}
		
		// Check for input and sanitize/save if needed
		if ( isset( $_POST[ '_ajv_testimonial_text' ] ) ) {
			update_post_meta( $post_id, '_ajv_testimonial_text', esc_textarea( $_POST[ '_ajv_testimonial_text' ] ) );
		}
		
		if ( isset( $_POST[ '_ajv_testimonial_company' ] ) ) {
			update_post_meta( $post_id, '_ajv_testimonial_company', sanitize_text_field( $_POST[ '_ajv_testimonial_company' ] ) );
		}
		
		if ( isset( $_POST[ '_ajv_testimonial_position' ] ) ) {
			update_post_meta( $post_id, '_ajv_testimonial_position', sanitize_text_field( $_POST[ '_ajv_testimonial_position' ] ) );
		}
		
		if ( isset( $_POST[ '_ajv_testimonial_url' ] ) ) {
			update_post_meta( $post_id, '_ajv_testimonial_url', esc_url( $_POST[ '_ajv_testimonial_url' ] ) );
		}
		
	}
	
	/**
	 * Replace Featured Image meta box title.
	 *
	 * @since    1.0.0
	 */
	public function replace_featured_image_meta_box() {
		
		// Remove Featured Image meta box
	    remove_meta_box( 'postimagediv', 'ajv_testimonials', 'side' );
	    
	    // Replace Featured Image meta box with custom title
	    add_meta_box( 'postimagediv', __( 'Client Image', 'ajv-testimonials' ), 'post_thumbnail_meta_box', 'ajv_testimonials', 'side', 'low' );
		
	}
	
	/**
	 * Filter the post title placeholder text.
	 *
	 * @since    1.0.0
	 */
	public function custom_enter_title( $input ) {
		
		global $post_type;

	    if ( 'ajv_testimonials' === $post_type ) {
	        return __( 'Enter the name of the client who gave the testimonial', 'ajv-testimonials' );
	    }
	
	    return $input;
		
		
	}
	
}