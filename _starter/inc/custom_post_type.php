<?php

/*

@package BrewSite

---- Custom Post Types ----

*/


    
$contact = get_option( 'activate_contact_form' );
if( @$contact == 1 ){
    add_action( 'init', 'brewsite_contact_custom_post_type' );

    add_filter( 'manage_brewsite_contact_posts_columns', 'brewsite_set_contact_columns' );
    add_action( 'manage_brewsite_contact_posts_custom_column', 'brewsite_contact_custom_column', 10, 2 );
}

/* Contact CPT */

function brewsite_contact_custom_post_type() {
    $labels = array(
        'name'              => 'Messages',
        'singular_name'     => 'Message',
        'menu_name'         => 'Messages',
        'name_admin_bar'    => 'Message'
    );

    $args = array(
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_menu'      => true,
        'capability_type'   => 'post',
        'hierarchical'      => false,
        'menu_position'     => 26,
        'menu_icon'         => 'dashicons-email',
        'supports'          => array( 'title', 'editor', 'author' )
    );

    register_post_type( 'brewsite_contact', $args );
}

function brewsite_set_contact_columns( $columns ) {
    $newColumns = array();
	$newColumns['title'] = 'Name';
	$newColumns['message'] = 'Message';
	$newColumns['email'] = 'Email';
	$newColumns['date'] = 'Date';
	return $newColumns;
}

function brewsite_contact_custom_column( $column, $post_id ){
	
	switch( $column ){
		
		case 'message' :
			echo get_the_excerpt();
			break;
			
		case 'email' :
			//email column
			echo 'email address';
			break;
	}	
}






