<?php

function add_custom_taxonomies() {

// POST TYPE POST, SPEAKERS
    register_taxonomy('ct_portfolio', 'pt_portfolio', array(
        'hierarchical' => true,
        'labels' => array( 'name' => _x( 'Portfolio Categories', 'taxonomy general name', tk_theme_name() ),
        'singular_name' => _x( 'Portfolio Categories', 'taxonomy singular name', tk_theme_name() ),
        'search_items' => __( 'Search Portfolio Categories', tk_theme_name() ),
        'all_items' => __( 'All Portfolio Categories', tk_theme_name() ),
        'parent_item' => __( 'Parent Portfolio Category', tk_theme_name() ),
        'parent_item_colon' => __( 'Parent Portfolio Category', tk_theme_name() ),
        'edit_item' => __( 'Edit Portfolio Category', tk_theme_name() ),
        'update_item' => __( 'Update Portfolio Category', tk_theme_name() ),
        'add_new_item' => __( 'Add New Portfolio Categories', tk_theme_name() ),
        'new_item_name' => __( 'New Portfolio Category', tk_theme_name() ),
        'menu_name' => __( 'Portfolio Categories', tk_theme_name() ), ),
        'rewrite' => array( 'slug' => 'locations',
        'with_front' => false, 'hierarchical' => true ),
    ));

}
add_action( 'init', 'add_custom_taxonomies', 0 );

?>