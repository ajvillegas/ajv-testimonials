/**
 * The TinyMCE functionality of the plugin.
 *
 * Adds a new button to the TinyMCE editor for inserting
 * the testimonials shortcode.
 *
 * @since      1.0.0
 */

(function() {
	
    tinymce.PluginManager.add( 'ajv_testimonials', function( editor, url ) {
	    
        editor.addButton( 'ajv_testimonials', {
            title: 'Insert Testimonials',
            type: 'button',
            icon: 'icon dashicons-testimonial',
            onclick: function() {
				editor.insertContent( '[ajv-testimonials category="all" class="none"]' );
			}
        } );
        
    } );
    
} )();
