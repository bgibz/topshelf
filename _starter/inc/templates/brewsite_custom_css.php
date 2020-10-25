<h1>Customize Theme Styling</h1>
<?php settings_errors(); ?>

<?php

?>

<form method="post" action="options.php" class="brewsite-admin-form">
    <?php settings_fields( 'brewsite-custom-css-options' ); ?>
    <?php do_settings_sections( 'brewsite_theme_css' ); ?>
    <?php submit_button(); ?>
<form>
