<?php

/*

@package BrewSite

---- Admin Enqueue Functions ----

*/

function brewsite_load_admin_scripts() {
    wp_register_style( 'brewsite_admin', get_template_directory_uri() . '/css/brewsite_admin.css', array(), '1.0.0', 'all' ); 
    wp_enqueue_style( 'brewsite_admin');

    wp_enqueue_media();

    wp_register_script( 'brewsite_admin_script', get_template_directory_uri() . '/js/brewsite_admin.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script( 'brewsite_admin_script');
}

add_action( 'admin_enqueue_scripts', 'brewsite_load_admin_scripts');

?>