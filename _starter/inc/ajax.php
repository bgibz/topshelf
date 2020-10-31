<?php
/**
 * @package Brewsite
 * 
 *  ---- AJAX Functions ---
 * 
 */

 add_action( 'wp_ajax_nopriv_brewsite_submit_contact_form', 'brewsite_submit_contact_form' );
 add_action( 'wp_ajax_brewsite_submit_contact_form', 'brewsite_submit_contact_form');

 function brewsite_submit_contact_form() {
     $title = wp_strip_all_tags($_POST["title"]);
     $name =wp_strip_all_tags( $_POST["name"]);
     $email = wp_strip_all_tags($_POST["email"]);
     $message = wp_strip_all_tags($_POST["message"]);

     $args = array(
         'post_title' => $title,
         'post_message' => $message,
         'post_author' => 1,
         'post_status' => 'publish',
         'post_type' => 'brewsite_contact',
         'meta_input' => array(
            '_contact_email_value_key' => $email
         )
     );

     $post_ID = wp_insert_post($args, $wp_error);

     echo $post_ID;

     die();
 }