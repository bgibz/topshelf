<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @package BrewSite
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', '_starter' ); ?></a>

	<header id="masthead" class="site-header">
	<nav class="navbar navbar-expand-lg navbar-light">
			<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
			<?php
			if ( has_custom_logo() ) {
				$logo = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ) , 'full' );
				echo '<img class="custom-logo" src="' . esc_url( $logo[0] ) . '" width="80px;" height="80px;" alt="' . get_bloginfo( 'name' ) . '">';
			} else {
				echo bloginfo( 'name' );
			}
			?>	
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse bg-light" id="navbarNav">
				<?php
					wp_nav_menu(array(
						'theme_location' => 'primary',
						'container' => false,
						'menu' => 'NavBar',
						'menu_class' => 'navbar-nav',
						'walker' => new Walker_Nav_Primary()
						)
					);
				?>
  </div>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->
