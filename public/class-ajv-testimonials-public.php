<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://www.alexisvillegas.com
 * @since      1.0.0
 *
 * @package    AJV_Testimonials
 * @subpackage AJV_Testimonials/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the 'ajv-testimonials' shortcode.
 *
 * @package    AJV_Testimonials
 * @subpackage AJV_Testimonials/public
 * @author     Alexis J. Villegas <alexis@ajvillegas.com>
 */
class AJV_Testimonials_Public {

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
	 * Register shortcodes.
	 *
	 * @since    1.0.0
	 */
	public function register_shortcodes() {
		
		// Testimonials shortcode
		add_shortcode( 'ajv-testimonials', array( $this, 'display_testimonials' ) );
		
	}
	
	/**
	 * Define the testimonials shortcode.
	 *
	 * @since    1.0.0
	 */
	public function display_testimonials( $atts ) {
		
		ob_start();
		
		// Define attributes and default values
		$atts = shortcode_atts( array(
	        'category' => 'all',
	        'class' => 'none',
	    ), $atts, 'ajv-testimonials' );
	    
	    // Define taxonomy terms
	    if ( 'all' == strtolower( $atts['category'] ) || empty( $atts['category'] ) ) {
	    	$terms = '';
	    } else {
		    $terms = array(
				'taxonomy' => 'ajv_testimonial_category',
				'field' => 'slug',
				'terms' => explode( ',', $atts['category'] ),
			);
	    }
	    
	    // Define custom class
	    if ( 'none' == strtolower( $atts['class'] ) || empty( $atts['class'] ) ) {
	    	$class = '';
	    } else {
		    $class = ' ' . strtolower( $atts['class'] );
	    }
	    
		// Define query parameters
		$args = array(
		    'post_type' => array( 'ajv_testimonials' ),
		    'tax_query' => array( $terms ),
			'posts_per_page' => -1,
			'orderby' => 'menu_order',
			'order' => 'ASC',
		);
		
		$the_query = new WP_Query( $args );
		
		// Custom loop
		if ( $the_query->have_posts() ) { ?>
		
			<div class="ajv-testimonials<?php echo $class; ?>"> <?php
		
				foreach ( $the_query->posts as $query ) {
					
					// Get post meta
					$post_id = $query->ID;
					$width = (int) 150;
					$height = (int) 150;
					$image_id = get_post_meta( $post_id, '_thumbnail_id', true );
					$image = wp_get_attachment_image( $image_id, apply_filters( 'ajv_testimonials_avatar_size', array( $width, $height ) ), false, array( "style" => "display:block;" ) );
					$text = get_post_meta( $post_id, '_ajv_testimonial_text', true );
					$author = $query->post_title;
					$position = get_post_meta( $post_id, '_ajv_testimonial_position', true );
					$company = get_post_meta( $post_id, '_ajv_testimonial_company', true );
					$url = get_post_meta( $post_id, '_ajv_testimonial_url', true );
					
					if ( $text && $author ) { ?>
						
						<blockquote class="testimonial">
						    <?php echo wpautop( esc_attr( $text ) ); ?>
						    <footer> <?php 
								if ( $image ) { ?>
							    <div class="author-avatar"><?php echo $image; ?></div> <?php
							    } ?>
							    <cite>
									<span class="author"><?php echo esc_html( $author ); ?></span> <?php
									if ( $position ) { ?>
									<span class="position"><?php echo esc_html( $position ); ?></span> <?php
									}
									if ( $company && $url ) { ?>
									<span class="company"><a href="<?php echo esc_url( $url ); ?>" target="_blank"><?php echo esc_html( $company ); ?></a></span> <?php
									} elseif ( $company && empty( $url ) ) { ?>
									<span class="company"><?php echo esc_html( $company ); ?></span> <?php
									} ?>
								</cite>
						    </footer>
						</blockquote> <?php
					
					}
					
				} ?>
				
			</div> <?php
				
			$html = ob_get_clean();
			
			return $html;
		
		}
		
		// Reset post data
		wp_reset_postdata();
		
	}

}
