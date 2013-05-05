<?php
    add_action('admin_init', 'tk_header');

    function tk_header()
    {

            wp_enqueue_script( 'jquery-livequery', get_template_directory_uri() . '/inc/shortcodes/js/jquery.livequery.js' );
            wp_enqueue_script( 'base64', get_template_directory_uri() . '/inc/shortcodes/js/base64.js' );
            wp_enqueue_script( 'popup', get_template_directory_uri() . '/inc/shortcodes/js/popup.js' );
    }

        add_action('init', 'tk_add_button');

	function tk_add_button()
	{
		if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
			return;

		if ( get_user_option('rich_editing') == 'true' )
		{
			add_filter( 'mce_external_plugins', 'tk_add_plugin' );
			add_filter( 'mce_buttons', 'tk_mce_button' );
		}
	}

	function tk_add_plugin( $plugin_array )
	{

		$plugin_array['shortcodes'] = get_template_directory_uri() . '/inc/shortcodes/plugin.js';
		return $plugin_array;
	}

	function tk_mce_button( $buttons )
	{
		array_push( $buttons, "|", 'tk_button' );
		return $buttons;
	}
?>