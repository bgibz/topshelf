<?php
/** 
 * 
 * A custom post type for beers consisting of a name, description,
 * style, media attachment, and other info
 * 
 * 
 */
function brewsite_beer_post_type(){
	$labels = array(
		'name' 				=> 'Beer',
		'singular_name' 	=> 'Beer',
		'add_new' 			=> 'Add Beer',
		'all_items' 		=> 'All Beers',
		'add_new_item' 		=> 'Add New Beer',
		'edit_item' 		=> 'Edit Beer',
		'new_item' 			=> 'New Beer',
		'view_item' 		=> 'View Beer',
		'search_item' 		=> 'Search Beers',
		'not_found'			=> 'No Beers Found',
		'not_found_in_trash' 	=> 'No Beers found in trash',
		'parent_item_Colon' 	=> 'Parent Beer'
	);
	$args =array(
	'labels' => $labels,
	$public => true,
	'hierarchical'         		=> true,
        'public'              	=> true,
        'show_ui'             	=> true,
        'show_in_menu'        	=> true,
        'show_in_nav_menus'   	=> true,
        'show_in_admin_bar'   	=> true,
        'menu_position'       	=> 5,
        'can_export'          	=> true,
        'has_archive'         	=> true,
        'exclude_from_search' 	=> false,
		'publicly_queryable'  	=> true,
		'query_var'			  	=> true,
        'capability_type'     	=> 'post',
		'show_in_rest' 		  	=> true,
		'supports'				=> array(
			'title',
			'editor',
			'excerpt',
			'thumbnail',
			'custom-fields'
		)
    );
     
    // Registering Custom Post Type
    register_post_type( 'beer', $args );
}

add_action('init', 'brewsite_beer_post_type');

/**
 * Add meta boxes to admin panel for custom fields
 */

 function add_beer_meta_boxes(){
    add_meta_box(
        "post_metadata_beer_name", // div id containing rendered fields
        "Beer Name", // section heading displayed as text
        "post_meta_box_beer_name", // callback function to render fields
        "beer", // name of post type on which to render fields
        "normal", // location on the screen
        "low" // placement priority
    );
 }
 add_action( "admin_init", "add_beer_meta_boxes");

 function post_meta_box_beer_name(){
    global $post;
    $custom = get_post_custom( $post->ID );
    $beer_name = $custom[ "_post_beer_name" ][ 0 ];
    echo "<label for='_post_beer_name'>Product Name: <input type='text' name='_post_beer_name' value='".$beer_name."' placeholder='Product Name' /></label>";
}
