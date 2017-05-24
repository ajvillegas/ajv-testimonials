<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://www.alexisvillegas.com
 * @since      1.0.0
 *
 * @package    AJV_Testimonials
 * @subpackage AJV_Testimonials/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * @package    AJV_Testimonials
 * @subpackage AJV_Testimonials/admin
 * @author     Alexis J. Villegas <alexis@ajvillegas.com>
 */
class AJV_Testimonials_Admin {

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
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/ajv-testimonials-admin.min.css', array(), $this->version, 'all' );

	}
	
	/**
	 * Add custom post admin table columns.
	 *
	 * @since    1.0.0
	 */
	public function edit_admin_columns( $columns ) {
		
		$columns = array(
	        'cb'								=> '<input type="checkbox" />',
	        'author-image' 						=> __( 'Image', 'ajv-testimonials' ),
	        'title' 							=> __( 'Name', 'ajv-testimonials' ),
	        'author-position' 					=> __( 'Position', 'ajv-testimonials' ),
	        'author-company' 					=> __( 'Company', 'ajv-testimonials' ),
	        'taxonomy-ajv_testimonial_category' => __( 'Categories', 'ajv-testimonials' ),
	        'menu-order' 						=> __( 'Order', 'ajv-testimonials' ),
	    );
	    
	    return $columns;
		
	}
	
	/**
	 * Add cotent to custom post admin table columns.
	 *
	 * @since    1.0.0
	 */
	public function define_admin_columns( $column, $post_id ) {
		
		global $post;
		
		// Get post meta
		$width = (int) 150;
		$height = (int) 150;
		$image_id = get_post_meta( $post_id, '_thumbnail_id', true );
		$image = wp_get_attachment_image( $image_id, array( $width, $height ), false );
		$position = get_post_meta( $post_id, '_ajv_testimonial_position', true );
		$company = get_post_meta( $post_id, '_ajv_testimonial_company', true );
		$url = get_post_meta( $post_id, '_ajv_testimonial_url', true );
		
		switch ( $column ) {
			
			// Image column
			case 'author-image':
				if ( has_post_thumbnail( $post_id ) )
					echo $image;
				else
					echo '<img src="' . plugin_dir_url( __FILE__ ) . 'images/default-avatar.svg" class="default-avatar" alt="default avatar">';
				break;
				
			// Position column
			case 'author-position':
				if ( $position )
					echo $position;
				else
					echo '—';
				break;
			
			// Company column
			case 'author-company':
				if ( $company && $url )
					echo '<a href="' . $url . '" target="_blank">' . $company . '</a>';
				elseif ( $company && !$url )
					echo $company;
				else
					echo '—';
				break;
			
			// Order column
			case 'menu-order':
				echo $post->menu_order;
				break;
				
			default:
				break;
				
		}
		
	}
	
	/**
	 * Make custom post admin table columns sortable.
	 *
	 * Set the array parameter to 0 or 1 to reverse the
	 * order the column sorts when it's first clicked.
	 *
	 * @since    1.0.0
	 */
	public function sortable_admin_columns( $columns ) {
		
		// Order column
		$columns['menu-order'] = array( 'menu_order', 1 );
		
		return $columns;
		
	}
	
	/**
	 * Change default post admin table columns order.
	 *
	 * @since    1.0.0
	 */
	public function orderby_admin_columns( $wp_query ) {
		
		if ( is_admin() && !isset( $_GET['orderby'] ) ) {
			
			$post_type = $wp_query->query['post_type'];
        
			if ( in_array( $post_type, array( 'ajv_testimonials' ) ) ) {
				
		        // Order column ascending
		        $wp_query->set( 'orderby', 'menu_order' );
				$wp_query->set( 'order', 'ASC' );
			
			}
		
		}
				
	}
	
	/**
	 * Register custom TinyMCE button.
	 *
	 * @since    1.0.0
	 */
	public function register_tinymce_button( $buttons ) {
		
		if ( current_user_can( 'edit_posts' ) && current_user_can( 'edit_pages' ) && get_user_option( 'rich_editing' ) == 'true' ) {
			
			array_push( $buttons, 'ajv_testimonials' );
			
		}
		
		return $buttons;
		
	}
	
	/**
	 * Load TinyMCE plugin for inserting testimonials shortcode.
	 *
	 * @since    1.0.0
	 */
	public function load_tinymce_plugin( $plugin_array ) {
		
		if ( current_user_can( 'edit_posts' ) && current_user_can( 'edit_pages' ) && get_user_option( 'rich_editing' ) == 'true' ) {
		
			$plugin_array['ajv_testimonials'] = plugin_dir_url( __FILE__ ) . '/js/ajv-testimonials-tinymce.min.js';
			
		}
		
		return $plugin_array;
		
	}

}
