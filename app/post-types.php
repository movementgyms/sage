<?php

namespace App;

/**
 * Post types
 *
 * @return void
 */
function cptui_register_my_cpts() {

	/**
	 * Post Type: Classes.
	 */

	$labels = [
		"name" => __( "Classes", "sage" ),
		"singular_name" => __( "Class", "sage" ),
	];

	$args = [
		"label" => __( "Classes", "sage" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "class", "with_front" => true ],
		"query_var" => true,
		"menu_icon" => "dashicons-money",
		"supports" => [ "title", "thumbnail" ],
	];

	register_post_type( "class", $args );


	/**
	 * Post Type: Press Releases.
	 */

	$labels = [
		"name" => __( "Press Releases", "sage" ),
		"singular_name" => __( "Press Release", "sage" ),
	];

	$args = [
		"label" => __( "Press Releases", "sage" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "press-release", "with_front" => true ],
		"query_var" => true,
		"menu_icon" => "dashicons-admin-post",
		"supports" => [ "title", "editor", "excerpt" ],
	];

	register_post_type( "press_release", $args );

	/**
	 * Post Type: Latest Coverage.
	 */

	$labels = [
		"name" => __( "Latest Coverage", "sage" ),
		"singular_name" => __( "Latest Coverage", "sage" ),
	];

	$args = [
		"label" => __( "Latest Coverage", "sage" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "latest-coverage", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "excerpt" ],
	];

	register_post_type( "latest_coverage", $args );

	/**
	 * Post Type: Downloadables.
	 */

	$labels = [
		"name" => __( "Downloadables", "sage" ),
		"singular_name" => __( "Downloadable", "sage" ),
	];

	$args = [
		"label" => __( "Downloadables", "sage" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "downloadable", "with_front" => true ],
		"query_var" => true,
		"menu_icon" => "dashicons-format-aside",
		"supports" => [ "title" ],
	];

	register_post_type( "downloadable", $args );
}

add_action( 'init', '\App\cptui_register_my_cpts' );


/**
 * Taxonomies
 *
 * @return void
 */
function cptui_register_my_taxes() {

	/**
	 * Taxonomy: Class Types.
	 */

	$labels = [
		"name" => __( "Class Types", "sage" ),
		"singular_name" => __( "Class Type", "sage" ),
	];

	$args = [
		"label" => __( "Class Types", "sage" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'class-type', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"rest_base" => "class_type",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
			];
	register_taxonomy( "class_type", [ "class" ], $args );

	/**
	 * Taxonomy: Downloadable Types.
	 */

	$labels = [
		"name" => __( "Downloadable Types", "sage" ),
		"singular_name" => __( "Downloadable Type", "sage" ),
	];

	$args = [
		"label" => __( "Downloadable Types", "sage" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'downloadable-type', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"rest_base" => "downloadable_type",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
			];
	register_taxonomy( "downloadable_type", [ "downloadable" ], $args );
}

add_action( 'init', '\App\cptui_register_my_taxes' );
