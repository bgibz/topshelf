<h1>BrewSite Theme Support</h1>
<?php settings_errors(); ?>

<?php

?>

<form method="post" action="options.php" class="brewsite-admin-form">
    <?php settings_fields( 'brewsite-theme-support' ); ?>
    <?php do_settings_sections( 'brewsite_support' ); ?>
    <?php submit_button(); ?>
<form>
