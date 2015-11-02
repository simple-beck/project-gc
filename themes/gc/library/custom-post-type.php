<?php
/* Bones Custom Post Type Example
This page walks you through creating 
a custom post type and taxonomies. You
can edit this one or copy the following code 
to create another one. 

I put this in a separate file so as to 
keep it organized. I find it easier to edit
and change things if they are concentrated
in their own file.

Developed by: Eddie Machado
URL: http://themble.com/bones/
*/

// Flush rewrite rules for custom post types
add_action( 'after_switch_theme', 'bones_flush_rewrite_rules' );

// Flush your rewrite rules
function bones_flush_rewrite_rules() {
	flush_rewrite_rules();
}

// let's create the function for the custom type
function custom_post_example() { 

	register_post_type( 'simple',
		// let's now add all the options for this post type
		array( 'labels' => array(
			'name' => __( 'Simple Post', 'bonestheme' ),
			'singular_name' => __( 'Simple Post', 'bonestheme' ),
			'all_items' => __( 'All Simple Posts', 'bonestheme' ),
			'add_new' => __( 'Add New', 'bonestheme' ),
			'add_new_item' => __( 'Add New Simple Post', 'bonestheme' ),
			'edit' => __( 'Edit', 'bonestheme' ),
			'edit_item' => __( 'Edit Simple Posts', 'bonestheme' ),
			'new_item' => __( 'New Simple Post', 'bonestheme' ),
			'view_item' => __( 'View Simple Post', 'bonestheme' ),
			'search_items' => __( 'Search Simple Post', 'bonestheme' ),
			'not_found' =>  __( 'Nothing found in the Database.', 'bonestheme' ),
			'not_found_in_trash' => __( 'Nothing found in Trash', 'bonestheme' ),
			'parent_item_colon' => ''
			),
			'description' => __( 'This is the Simple Post type', 'bonestheme' ),
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => false,
			'query_var' => true,
			'rewrite'	=> array( 'slug' => 'simple', 'with_front' => true ),
			'has_archive' => false,
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt')
		)
	);
		
	// creating (registering) the custom type 
	register_post_type( 'product', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array( 'labels' => array(
			'name' => __( 'Products', 'bonestheme' ), /* This is the Title of the Group */
			'singular_name' => __( 'Product', 'bonestheme' ), /* This is the individual type */
			'all_items' => __( 'All Products', 'bonestheme' ), /* the all items menu item */
			'add_new' => __( 'Add New', 'bonestheme' ), /* The add new menu item */
			'add_new_item' => __( 'Add New Product', 'bonestheme' ), /* Add New Display Title */
			'edit' => __( 'Edit', 'bonestheme' ), /* Edit Dialog */
			'edit_item' => __( 'Edit Products', 'bonestheme' ), /* Edit Display Title */
			'new_item' => __( 'New Product', 'bonestheme' ), /* New Display Title */
			'view_item' => __( 'View Product', 'bonestheme' ), /* View Display Title */
			'search_items' => __( 'Search Products', 'bonestheme' ), /* Search Custom Type Title */ 
			'not_found' =>  __( 'Nothing found in the Database.', 'bonestheme' ), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __( 'Nothing found in Trash', 'bonestheme' ), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'Products' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_stylesheet_directory_uri() . '/library/images/custom-post-icon.png', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'product', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'products', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt', 'sticky')
		) /* end of options */
	); /* end of register post type */
	
	
}

	// adding the function to the Wordpress init
	add_action( 'init', 'custom_post_example');
	
	/*
	for more information on taxonomies, go here:
	http://codex.wordpress.org/Function_Reference/register_taxonomy
	*/
	
	
	/*
		looking for custom meta boxes?
		check out this fantastic tool:
		https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
	*/
	

// require_once ABSPATH . '/wp-content/plugins/cmb2-taxonomy/init.php';

/* Add Meta Field to taxonomies */
add_filter('cmb2-taxonomy_meta_boxes', 'cmb2_taxonomy_metaboxes');

/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb2_taxonomy_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_events_';

	/**
	 * Events Categories metaboxes
	 */
	$meta_boxes['events_cats_metabox'] = array(
		'id'            => 'events_cats_metabox',
		'title'         => __( 'Colors', 'cmb2' ),
		'object_types'  => array( 'tribe_events_cat', ), // Taxonomy Type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		'fields'        => array(

			array(
				'name'    => __( 'Category color', 'cmb2' ),
				'desc'    => __( 'Appear through the site', 'cmb2' ),
				'id'      => $prefix . 'category_color',
		    'type'    => 'colorpicker',
		    'default' => '#005eb8',
			),			

		),
	);

	return $meta_boxes;
}

add_filter( 'cmb2_meta_boxes', 'cmb2_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb2_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_product_';

	/**
	 * product meta boxes
	 */
	$meta_boxes['product_metabox'] = array(
		'id'            => 'product_metabox',
		'title'         => __( 'Misc', 'cmb2' ),
		'object_types'  => array( 'product', ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
		'fields'        => array(

			array(
				'name' => 'Price',
				'id' => $prefix .'price',
				'type' => 'text_small',
			),

			array(
		    'name' => 'Additional images',
		    'desc' => 'Used on slider within a popup',
		    'id'   => $prefix . 'additional_images',
		    'type' => 'file_list',
		    'preview_size' => array( 200, 200 ), // Default: array( 50, 50 )
			),			


			array(
	    'name'    => 'Short info',
	    'desc'    => 'appears in the popup',
	    'id'      => $prefix . 'short_info',
	    'type'    => 'wysiwyg',
			),			

		),
	);	
	// Start with an underscore to hide fields from custom fields list
	$prefix = '_event_';

	/**
	 * product meta boxes
	 */
	$meta_boxes['event_metabox'] = array(
		'id'            => 'event_metabox',
		'title'         => __( 'Misc', 'cmb2' ),
		'object_types'  => array( 'tribe_events', ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
		'fields'        => array(

			array(
				'name' => 'Is Featured',
				'id' => $prefix .'is_featured',
				'type' => 'checkbox',
			),

		),
	);	

	// Add other metaboxes as needed
	return $meta_boxes;
}
