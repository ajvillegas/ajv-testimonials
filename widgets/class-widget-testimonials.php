<?php

/**
 * AJV Testimonials widget.
 *
 * Displays client testimonials.
 *
 * @link       http://www.alexisvillegas.com
 * @since      1.0.0
 *
 * @package    AJV_Testimonials
 * @subpackage AJV_Testimonials/widget
 */
 
class AJV_Testimonials_Widget extends WP_Widget {
	
    /**
     * Constructor
     *
     * Specifies the classname and description, instantiates the widget,
	 * loads localization files, and includes any necessary stylesheets and JavaScript.
     **/
	public function __construct() {
		
		$widget_ops = array(
			'classname' => 'ajv-testimonials',
			'description' => __( 'Displays client testimonials.', 'ajv-testimonials' ),
			'customize_selective_refresh' => true,
		);
		
		$control_ops = array(
			'id_base' => 'ajv-testimonials',
		);
		
		parent::__construct( 'ajv-testimonials', __( 'Testimonials', 'ajv-testimonials' ), $widget_ops, $control_ops );
		
	}
	
    /**
     * Outputs the HTML for this widget.
     *
     * @param array args The array of form elements
	 * @param array instance The current instance of the widget
     **/
	public function widget( $args, $instance ) {
		
		extract( $args, EXTR_SKIP );
		
		$instance = wp_parse_args( (array)$instance, array(
			'title' => '',
			'category' => '',
			'custom_classes' => '',
		) );
		
		$shortcode_content = do_shortcode( '[ajv_testimonials]' );
		
		if ( !empty( $shortcode_content ) ) {
		
			echo $before_widget;
			
			if ( !empty( $instance['title'] ) ) {
				echo $before_title . apply_filters( 'widget_title', $instance['title'] ) . $after_title;
			}
			
			// Categories
	    	if ( !empty( $instance['category'] ) ) {
			    $terms_array = $instance['category'];
				
				foreach ( $terms_array as $term ) {
					$slugs_array[] = get_term( absint( $term ), 'ajv_testimonial_category' )->slug;
				}
				
	    		$category = ' category="' . implode( ',', $slugs_array ) . '"';
	    	} else {
		    	$category = '';
	    	}
	    	
	    	// Custom Classes
	    	if ( !empty( $instance['custom_classes'] ) ) {
	    		$custom_classes = ' class="' . $instance['custom_classes'] . '"';
	    	} else {
		    	$custom_classes = '';
	    	}
			
			echo do_shortcode( '[ajv_testimonials'.$category.$custom_classes.']' );
			
			echo $after_widget;
			
		}
		
	}

    /**
     * Processes the widget's options to be saved.
	 *
	 * @param array new_instance The new instance of values to be generated via the update.
	 * @param array old_instance The previous instance of values before the update.
     **/
	public function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['custom_classes'] = strip_tags( $new_instance['custom_classes'] );
		
		// Validate terms
		$terms = array();
		
		if ( isset( $_REQUEST['widget-id'] ) && $_REQUEST['widget-id'] == $this->id ) {
			
			$posted_terms = array();
			
			if ( isset( $_POST['tax_input']['ajv_testimonial_category'] ) ) {
				$posted_terms = $_POST['tax_input']['ajv_testimonial_category'];
			}
			
			foreach ( $posted_terms as $term ) {
				
				if ( term_exists( absint( $term ), 'ajv_testimonial_category' ) ) {
					$terms[] = absint( $term );
				}
				
			}
			
		}
		
		$instance['category'] = $terms;
		
		return $instance;
		
	}

    /**
     * Generates the administration form for the widget.
	 *
	 * @param array instance The array of keys and values for the widget.
     **/
	public function form( $instance ) {
		
		$defaults = array(
			'title' => '',
			'custom_classes' => '',
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'ajv-testimonials' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		<p class="category-checklist-label">
			<label for="<?php echo $this->get_field_id( 'category' ); ?>" style="margin-bottom:0;"><?php _e( 'Categories:', 'ajv-testimonials' ); ?></label>
		</p> <?php
		
		// Output terms checklist
		$selected_cats = array();
		
		if ( $this->number !== '__i__' ) { // Check if widget is already saved
			$settings = get_option( $this->option_name );
			$selected_cats = $settings[$this->number]['category'];
		}
			
		$args = array (
			'descendants_and_self'  => 0,
		    'selected_cats'         => $selected_cats,
		    'popular_cats'          => false,
		    'walker'                => null,
		    'taxonomy'              => 'ajv_testimonial_category',
		    'checked_ontop'         => true,
		    'echo'					=> true,
		);
		
		ob_start();
		wp_terms_checklist( 0, $args );
		$terms_html = ob_get_contents();
		ob_end_clean();
		
		if ( !empty( $terms_html ) ) {
			$output = '<ul class="category-checklist">';
			$output .= $terms_html;
			$output .= "</ul>\n";
		} else {
			$output = '<p class="no-category">' . __( 'No categories found.', 'ajv-testimonials' ) . '</p>';
		}
		
		echo $output; ?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'custom_classes' ); ?>"><?php _e( 'Custom classes:', 'ajv-testimonials' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'custom_classes' ); ?>" name="<?php echo $this->get_field_name( 'custom_classes' ); ?>" value="<?php echo $instance['custom_classes']; ?>" />
			<span class="description" style="padding-left:2px;"><em><?php _e( 'Separate classes by a space.', 'ajv-testimonials' ) ?></em></span>
		</p> <?php
		
	}
	
}
