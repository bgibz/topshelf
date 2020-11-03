<?php

/*

@package BrewSite

---- Admin Page ----

*/

function brewsite_add_admin_page() {
    // Generate Admin Page
    add_menu_page( 'BrewSite Theme Options', 'brewsite', 'manage_options', 'brewsite_theme', 'brewsite_admin_create_page',
    '', 111 );

    // Generate brewsite admin sub pages
    add_submenu_page( 'brewsite_theme',  'BrewSite Theme Options', 'Theme Settings', 'manage_options', 'brewsite_theme', 'brewsite_admin_create_page' );
    add_submenu_page( 'brewsite_theme',  'BrewSite Theme Support', 'Theme Support', 'manage_options', 'brewsite_support', 'brewsite_theme_admin_page' );
    add_submenu_page( 'brewsite_theme',  'BrewSite Contact Form', 'Contact Form', 'manage_options', ' brewsite_theme_contact', 'brewsite_theme_contact_page' );
    //add_submenu_page( 'brewsite_theme',  'BrewSite CSS Options', 'Custom Styling', 'manage_options', 'brewsite_theme_css', 'brewsite_css_settings' );

    // Custom Settings
    add_action( 'admin_init', 'brewsite_custom_settings' );
}
add_action( 'admin_menu', 'brewsite_add_admin_page' );

function brewsite_custom_settings() {
    // Header Options
    register_setting ('brewsite-settings-group', 'display_picture');
    register_setting( 'brewsite-settings-group', 'brewery_name' );
    register_setting( 'brewsite-settings-group', 'brewery_tagline');
    
    add_settings_section( 'brewsite-sidebar-options', 'Sidebar Options', 'brewsite_sidebar_options', 'brewsite_theme' );

    add_settings_field('sidebar-display-picture', 'Display Image', 'brewsite_display_image', 'brewsite_theme', 'brewsite-sidebar-options' );
    add_settings_field('sidebar-name', 'Brewery Name', 'brewsite_sidebar_name', 'brewsite_theme', 'brewsite-sidebar-options' );
    add_settings_field('sidebar-tagline', 'Tagline', 'brewsite_sidebar_tagline', 'brewsite_theme', 'brewsite-sidebar-options' );

    // Theme Support Options
    register_setting( 'brewsite-theme-support', 'post_formats' );
    register_setting( 'brewsite-theme-support', 'custom_header' );
	register_setting( 'brewsite-theme-support', 'custom_background' );

    add_settings_section( 'brewsite-theme-options', 'Theme Options', 'brewsite_theme_options', 'brewsite_support' );

    //add_settings_field( 'brewsite-post-formats', 'Post Formats', 'brewsite_post_formats', 'brewsite_support', 'brewsite-theme-options' );
    add_settings_field( 'custom-header', 'Custom Header', 'brewsite_custom_header', 'brewsite_support', 'brewsite-theme-options' );
    add_settings_field( 'custom-background', 'Custom Background', 'brewsite_custom_background', 'brewsite_support', 'brewsite-theme-options' );
    
    // Contact Form Options
    register_setting( 'brewsite-contact-options', 'activate_contact_form');
    register_setting( 'brewsite-contact-options', 'contact-form-target');
    add_settings_section( 'brewsite-contact-section', 'Contact Form', 'brewsite_contact_section', 'brewsite_theme_contact' );
    add_settings_field( 'activate-contact-form', 'Activate Contact Form', 'brewsite_activate_contact', 'brewsite_theme_contact', 'brewsite-contact-section' );
    add_settings_field( 'contact-form-target', 'Target E-mail For Contact Messages', 'brewsite_contact_target', 'brewsite_theme_contact', 'brewsite-contact-section' );
    
    /*
    register_setting( 'brewsite-custom-css-options', 'brewsite_css', 'brewsite_sanitize_custom_css' );
	
	add_settings_section( 'brewsite-custom-css-section', 'Custom CSS', 'brewsite_custom_css_section_callback', 'brewsite_theme_css' );
	
	add_settings_field( 'custom-css', 'Insert your Custom CSS', 'brewsite_custom_css_callback', 'brewsite_theme_css', 'brewsite-custom-css-section' );
    */
}

// Submenu Functions
function brewsite_admin_create_page() {
    require_once( get_template_directory() . '/inc/templates/brewsite_admin.php');
}

function brewsite_theme_admin_page() {
    require_once( get_template_directory() . '/inc/templates/brewsite_theme_support.php' );
}

function brewsite_theme_contact_page() {
    require_once( get_template_directory() . '/inc/templates/brewsite_contact_form.php' );
}
/*
function brewsite_css_settings()  {
    require_once( get_template_directory() . '/inc/templates/brewsite_custom_css.php' );
}
*/
// Header Options
function brewsite_sidebar_options() {
    echo 'Customize Sidebar Information';
}

function brewsite_display_image() {
    $displayImage = esc_attr( get_option( 'display_picture' ) );
    echo '<input type="button" class="button button-secondary" value="Upload Display Image" id="upload-image-button"> 
    <input type="hidden" id="display_image" name="display_picture" value="'.$displayImage.'" />
    <p id="display-img-file"></p>';
}
function brewsite_sidebar_name() {
    $breweryName = esc_attr( get_option( 'brewery_name' ) );
    echo '<input type="text" name="brewery_name" value="'.$breweryName.'" placeholder="Brewery Name" />';
}
function brewsite_sidebar_tagline() {
    $breweryTagline = esc_attr( get_option( 'brewery_tagline' ) );
    echo '<input type="text" name="brewery_tagline" value="'.$breweryTagline.'" placeholder="Tagline" />';
}

// CSS Options
/*
function brewsite_sanitize_custom_css( $input ){
	$output = esc_textarea( $input );
	return $output;
}

function brewsite_custom_css_section_callback() {
	echo 'Customize Theme with your own CSS';
}

function brewsite_custom_css_callback() {
	$css = get_option( 'brewsite_css' );
	$css = ( empty($css) ? ' Theme Custom CSS ' : $css );
	echo '<textarea id="brewsite_css" name="brewsite_css" >'.$css.'</textarea>';
}
*/
// Theme Support Options
function brewsite_theme_options() {
    echo 'Activate/Deactivate Theme Support Options';
}

function brewsite_custom_header() {
	$options = get_option( 'custom_header' );
	$checked = ( @$options == 1 ? 'checked' : '' );
	echo '<label><input type="checkbox" id="custom_header" name="custom_header" value="1" '.$checked.' /> Activate the Custom Header</label>';
}

function brewsite_custom_background() {
	$options = get_option( 'custom_background' );
	$checked = ( @$options == 1 ? 'checked' : '' );
	echo '<label><input type="checkbox" id="custom_background" name="custom_background" value="1" '.$checked.' /> Activate the Custom Background</label>';
}

// Contact Form Options
function brewsite_contact_section() {
    echo 'Activate/Deactivate Built-In Theme Contact Form';
}

function brewsite_activate_contact() {
    $option = get_option( 'activate_contact_form' );
    $checked = ( @$option == 1 ? 'checked' : '' );
    echo '<label><input type="checkbox" id="activate_contact_form" name="activate_contact_form" value="1" '.$checked.' /></label>';
}

function brewsite_contact_target() {
    $target_inbox = esc_attr( get_option( 'contact-form-target' ) );
    echo '<input type="text" name="contact-form-target" value="'.$target_inbox.'" placeholder="Target Inbox for Contact Form" />';
}

/*
function brewsite_post_formats() {
    $options = get_option( 'post_formats' );
	$formats = array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' );
	$output = '';
	foreach ( $formats as $format ){
		$checked = ( @$options[$format] == 1 ? 'checked' : '' );
		$output .= '<label><input type="checkbox" id="'.$format.'" name="post_formats['.$format.']" value="1" '.$checked.' /> '.$format.'</label><br>';
	}
	echo $output;
}

function brewsite_post_formats_callback( $input ){
    return $input;
}
*/
