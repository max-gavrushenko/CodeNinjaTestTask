<?php

if ( ! function_exists('custom_post_type_film') ) {

// Register Custom Post Type
	function custom_post_type_film() {

		$labels = array(
			'name'                  => _x( 'Films', 'Post Type General Name', 'twentyseventeen-child' ),
			'singular_name'         => _x( 'Film', 'Post Type Singular Name', 'twentyseventeen-child' ),
			'menu_name'             => __( 'Film', 'twentyseventeen-child' ),
			'name_admin_bar'        => __( 'Post Type', 'twentyseventeen-child' ),
			'archives'              => __( 'Film Archives', 'twentyseventeen-child' ),
			'attributes'            => __( 'Film Attributes', 'twentyseventeen-child' ),
			'parent_item_colon'     => __( 'Parent Film:', 'twentyseventeen-child' ),
			'all_items'             => __( 'All Films', 'twentyseventeen-child' ),
			'add_new_item'          => __( 'Add New Film', 'twentyseventeen-child' ),
			'add_new'               => __( 'Add New Film', 'twentyseventeen-child' ),
			'new_item'              => __( 'New Film', 'twentyseventeen-child' ),
			'edit_item'             => __( 'Edit Film', 'twentyseventeen-child' ),
			'update_item'           => __( 'Update Film', 'twentyseventeen-child' ),
			'view_item'             => __( 'View Film', 'twentyseventeen-child' ),
			'view_items'            => __( 'View Films', 'twentyseventeen-child' ),
			'search_items'          => __( 'Search Film', 'twentyseventeen-child' ),
			'not_found'             => __( 'Not found', 'twentyseventeen-child' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'twentyseventeen-child' ),
			'featured_image'        => __( 'Featured Image', 'twentyseventeen-child' ),
			'set_featured_image'    => __( 'Set featured image', 'twentyseventeen-child' ),
			'remove_featured_image' => __( 'Remove featured image', 'twentyseventeen-child' ),
			'use_featured_image'    => __( 'Use as featured image', 'twentyseventeen-child' ),
			'insert_into_item'      => __( 'Insert into item', 'twentyseventeen-child' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'twentyseventeen-child' ),
			'items_list'            => __( 'Films list', 'twentyseventeen-child' ),
			'items_list_navigation' => __( 'Films list navigation', 'twentyseventeen-child' ),
			'filter_items_list'     => __( 'Filter items list', 'twentyseventeen-child' ),
		);
		$args = array(
			'label'                 => __( 'Film', 'twentyseventeen-child' ),
			'description'           => __( 'Post Type Description', 'twentyseventeen-child' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields', ),
			'taxonomies'            => array( 'category' ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'post',
		);
		register_post_type( 'films', $args );

	}
	add_action( 'init', 'custom_post_type_film', 0 );

}
