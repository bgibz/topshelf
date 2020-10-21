<h1>BrewSite Contact Form</h1>
<?php settings_errors(); ?>

<?php

?>

<form method="post" action="options.php" class="brewsite-admin-form">
    <?php settings_fields( 'brewsite-contact-options' ); ?>
    <?php do_settings_sections( 'brewsite_theme_contact' ); ?>
    <?php submit_button(); ?>
<form>
