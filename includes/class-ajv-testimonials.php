<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://www.alexisvillegas.com
 * @since      1.0.0
 *
 * @package    AJV_Testimonials
 * @subpackage AJV_Testimonials/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    AJV_Testimonials
 * @subpackage AJV_Testimonials/includes
 * @author     Alexis J. Villegas <alexis@ajvillegas.com>
 */
class AJV_Testimonials {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      AJV_Testimonials_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->plugin_name = 'ajv-testimonials';
		$this->version = '1.0.2';
		$this->load_dependencies();
		$this->set_locale();
		$this->define_cpt_hooks();
		$this->define_metabox_hooks();
		$this->define_admin_hooks();
		$this->define_public_hooks();
		$this->load_widgets();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - AJV_Testimonials_Loader. Orchestrates the hooks of the plugin.
	 * - AJV_Testimonials_i18n. Defines internationalization functionality.
	 * - AJV_Testimonials_CPT. Defines all hooks for registering custom post types and taxonomies.
	 * - AJV_Testimonials_Metabox. Defines all hooks related to the meta box functionality.
	 * - AJV_Testimonials_Admin. Defines all hooks for the admin area.
	 * - AJV_Testimonials_Public. Defines all hooks for the public side of the site.
	 * - AJV_Testimonials_Widgets. Registers all widgets.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-ajv-testimonials-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-ajv-testimonials-i18n.php';

		/**
		 * The class responsible for defining all actions for registering custom post types and taxonomies.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-ajv-testimonials-cpt.php';
		
		/**
		 * The class responsible for defining all actions related to the meta box functionality.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-ajv-testimonials-metabox.php';
		
		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-ajv-testimonials-admin.php';
		
		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-ajv-testimonials-public.php';
		
		/**
		 * The class responsible for registering all widgets.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'widgets/class-ajv-testimonials-widgets.php';

		$this->loader = new AJV_Testimonials_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the AJV_Testimonials_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new AJV_Testimonials_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}
	
	/**
	 * Register all of the hooks related to the custom post type functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_cpt_hooks() {

		$plugin_cpt = new AJV_Testimonials_CPT( $this->get_plugin_name(), $this->get_version() );

		// Register custom post type
		$this->loader->add_action( 'init', $plugin_cpt, 'custom_post_type' );
		
		// Register custom taxonomy
		$this->loader->add_action( 'init', $plugin_cpt, 'custom_taxonomy' );

	}
	
	/**
	 * Register all of the hooks related to the custom meta box functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_metabox_hooks() {

		$plugin_metabox = new AJV_Testimonials_Metabox( $this->get_plugin_name(), $this->get_version() );

		// Register custom post meta box
		$this->loader->add_action( 'add_meta_boxes_ajv_testimonials', $plugin_metabox, 'add_testimonials_meta_box' );
		
		// Save custom post meta box values
		$this->loader->add_action( 'save_post', $plugin_metabox, 'save_meta_box_values' );
		
		// Replace Featured Image meta box title
		$this->loader->add_action( 'do_meta_boxes', $plugin_metabox, 'replace_featured_image_meta_box' );
		
		// Filter the post title placeholder text
		$this->loader->add_filter( 'enter_title_here', $plugin_metabox, 'custom_enter_title' );

	}
	
	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new AJV_Testimonials_Admin( $this->get_plugin_name(), $this->get_version() );
		
		// Enqueue styles
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		
		// Add custom post admin table columns
		$this->loader->add_filter( 'manage_ajv_testimonials_posts_columns', $plugin_admin, 'edit_admin_columns' );
		
		// Add cotent to custom post admin table columns
		$this->loader->add_action( 'manage_ajv_testimonials_posts_custom_column', $plugin_admin, 'define_admin_columns', 10, 2 );
		
		// Make custom post admin table columns sortable
		$this->loader->add_action( 'manage_edit-ajv_testimonials_sortable_columns', $plugin_admin, 'sortable_admin_columns' );
		
		// Change default post admin table columns order
		$this->loader->add_action( 'pre_get_posts', $plugin_admin, 'orderby_admin_columns' );
		
		// Register custom TinyMCE button
		$this->loader->add_filter( 'mce_buttons_2', $plugin_admin, 'register_tinymce_button' );
		
		// Load TinyMCE plugin for inserting testimonials shortcode
		$this->loader->add_filter( 'mce_external_plugins', $plugin_admin, 'load_tinymce_plugin' );

	}
	
	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new AJV_Testimonials_Public( $this->get_plugin_name(), $this->get_version() );

		// Define the testimonials shortcode
		$this->loader->add_action( 'init', $plugin_public, 'register_shortcodes' );

	}
	
	/**
     * Registers the hooks responsible for registering all widgets.
     *
     * @since    1.0.0
     * @access   private
     */
    private function load_widgets() {
	    
        $plugin_widgets = new AJV_Testimonials_Widgets( $this->get_Plugin_Name(), $this->get_version() );
        
        // Register widgets
		$this->loader->add_action( 'widgets_init', $plugin_widgets, 'register_widgets' );
        
    }

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    AJV_Testimonials_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
