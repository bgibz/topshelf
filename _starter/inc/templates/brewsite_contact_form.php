<h1>BrewSite Contact Form</h1>
<?php settings_errors(); ?>

<?php

?>

<p> Insert a shortcode to activate the Contact Form inside a Page or Post.</P>
<p><code>[contact_form]</code></p>

<form method="post" action="options.php" class="brewsite-admin-form">
    <?php settings_fields( 'brewsite-contact-options' ); ?>
    <?php do_settings_sections( 'brewsite_theme_contact' ); ?>
    <?php submit_button(); ?>
<form>
