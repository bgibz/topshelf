<?php
/**
 * The template for displaying the contact page
 *
 *
 * @package Brewsite
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'contact' );

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

	</main><!-- #main -->

<?php

get_footer();
