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
    add_submenu_page( 'brewsite_theme',  'BrewSite CSS Options', 'Custom Styling', 'manage_options', 'brewsite_theme_css', 'brewsite_css_settings' );
    add_submenu_page( 'brewsite_theme',  'BrewSite Theme Support', 'Theme Support', 'manage_options', 'brewsite_support', 'brewsite_theme_admin_page' );

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

}

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

function brewsite_admin_create_page() {
    require_once( get_template_directory() . '/inc/templates/brewsite_admin.php');
}

function brewsite_css_settings() {
    // generate admin page for custom css
    echo '<h1>Customize CSS</h1>';
}

// Theme Support Options
function brewsite_theme_admin_page() {
    require_once( get_template_directory() . '/inc/templates/brewsite_theme_support.php' );
}

function brewsite_theme_options() {
    echo 'Activate/Deactivate Theme Support Options';
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
*/
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
/*
function brewsite_post_formats_callback( $input ){
    return $input;
}
*/
?>