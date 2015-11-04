<?php
// Register Custom Post Type
function wcct() {

	$labels = array(
		'name'                => _x( 'Product tabs', 'Post Type General Name', 'wcct' ),
		'singular_name'       => _x( 'Product tab', 'Post Type Singular Name', 'wcct' ),
		'menu_name'           => __( 'WCCPT', 'wcct' ),
		'name_admin_bar'      => __( 'WCCPT', 'wcct' ),
		'parent_item_colon'   => __( 'Parent tab:', 'wcct' ),
		'all_items'           => __( 'All tabs', 'wcct' ),
		'add_new_item'        => __( 'Add New Tab', 'wcct' ),
		'add_new'             => __( 'Add Tab', 'wcct' ),
		'new_item'            => __( 'New tab', 'wcct' ),
		'edit_item'           => __( 'Edit tab', 'wcct' ),
		'update_item'         => __( 'Update tab', 'wcct' ),
		'view_item'           => __( 'View tab', 'wcct' ),
		'search_items'        => __( 'Search tab', 'wcct' ),
		'not_found'           => __( 'Not found', 'wcct' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'wcct' ),
	);
	$args = array(
		'label'               => __( 'Product tab', 'wcct' ),
		'description'         => __( 'Custom product tab', 'wcct' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'revisions', ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-editor-table',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => false,		
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'wcct', $args );

}
