<h1>BrewSite Theme Options</h1>
<?php settings_errors(); ?>

<?php

    $breweryName = esc_attr( get_option( 'brewery_name' ) );
    $breweryTagline = esc_attr( get_option( 'brewery_tagline' ) );
    $displayImg = esc_attr( get_option( 'display_picture' ) );
?>
<div class="brewsite-sidebar-preview">
    <div class="sidebar-preview">
        <div class="image-container">
           <div id="display-img-preview" class="display-img" style="background-image: url(<?php print $displayImg ?>)">
           </div> 
        </div>
        <h1 class="brewsite-name"><?php print $breweryName?></h1>
        <h2 class="brewsite-tagline"><?php print $breweryTagline?></h2>
    </div>
</div>
<form method="post" action="options.php" class="brewsite-admin-form">
    <?php settings_fields( 'brewsite-settings-group' ); ?>
    <?php do_settings_sections( 'brewsite_theme' ); ?>
    <?php submit_button() ?>
<form>
