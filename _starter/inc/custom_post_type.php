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

    add_action( 'add_meta_boxes', 'brewsite_contact_add_meta_box' );
    add_action( 'save_post', 'brewsite_save_contact_email_data'); 
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
            $email = get_post_meta( $post_id, '_contact_email_value_key', true );
			echo '<a href="mailto:'.$email.'">'.$email.'</a>';
			break;
	}	
}

/* Meta Box */

function brewsite_contact_add_meta_box() {
    add_meta_box( 'contact_email', 'Contact Email', 'brewsite_contact_email_callback', 'brewsite_contact', 'normal', 'high' );   
}

function brewsite_contact_email_callback( $post ){
    wp_nonce_field( 'brewsite_save_contact_email_data', 'brewsite_contact_email_meta_box_nonce' );
	
	$value = get_post_meta( $post->ID, '_contact_email_value_key', true );
	
	echo '<label for="brewsite_contact_email_field">User Email Address: </lable>';
	echo '<input type="email" id="brewsite_contact_email_field" name="brewsite_contact_email_field" value="' . esc_attr( $value ) . '" size="25" />';
}

function brewsite_save_contact_email_data( $post_id ) {
	// check if nonce is set
	if( ! isset( $_POST['brewsite_contact_email_meta_box_nonce'] ) ){
		return;
	}
	// verify nonce
	if( ! wp_verify_nonce( $_POST['brewsite_contact_email_meta_box_nonce'], 'brewsite_save_contact_email_data') ) {
		return;
	}
	// check is autosave
	if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
		return;
	}
	// check user permissions
	if( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	// check if email has been set
	if( ! isset( $_POST['brewsite_contact_email_field'] ) ) {
		return;
	}
	
	$my_data = sanitize_text_field( $_POST['brewsite_contact_email_field'] );
	
	update_post_meta( $post_id, '_contact_email_value_key', $my_data );
	
}

