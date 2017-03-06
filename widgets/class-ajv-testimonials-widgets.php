<?php

/**
 * The widget functionality of the plugin.
 *
 * @link       http://www.alexisvillegas.com
 * @since      1.0.0
 *
 * @package    AJV_Testimonials
 * @subpackage AJV_Testimonials/widget
 */

/**
 * The widget functionality of the plugin. This class is responsible for registering
 * all the widgets.
 *
 * @package    AJV_Testimonials
 * @subpackage AJV_Testimonials/widgets
 * @author     Alexis J. Villegas <alexis@ajvillegas.com>
 */
class AJV_Testimonials_Widgets {

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
		$this->load_widget_classes();

	}
	
	/**
	 * Load widget classes.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_widget_classes() {
		
		/**
		 * The class responsible for defining the Testimonials widget.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'widgets/class-widget-testimonials.php';
	
	}
	
	/**
     * Register all widgets.
     *
     * @since   1.0.0
     *
     **/
    public function register_widgets() {
	    
	    // Register the Testimonials widget
        register_widget( 'AJV_Testimonials_Widget' );
        
    }

}
