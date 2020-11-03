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
     $title = wp_strip_all_tags($_POST["name"]);
     $name =wp_strip_all_tags( $_POST["name"]);
     $email = wp_strip_all_tags($_POST["email"]);
     $message = wp_strip_all_tags($_POST["message"]);

     $args = array(
         'post_title' => $title,
         'post_content' => $message,
         'post_author' => 1,
         'post_status' => 'publish',
         'post_type' => 'brewsite_contact',
         'meta_input' => array(
            '_contact_email_value_key' => $email
         )
     );

     $post_ID = wp_insert_post($args, $wp_error);

     if ($post_ID > 0) {
         $target_inbox = esc_attr( get_option( 'contact-form-target' ) );
         $subject = 'New Contact Form Submission';
         $mail_msg = $message . '\r\n From: ' . $title . '\r\n Email: ' . $email;
         $headers = array('Content-Type: text/html; charset=UTF-8');
         $mail_flag = $wp_mail( $target_inbox, $subject, $mail_msg, $headers );
         if ($mail_flag) {
             echo $post_ID;
         } else {
             echo 0;
         }
     } else {
        echo $post_ID;
     }

     die();
 }

