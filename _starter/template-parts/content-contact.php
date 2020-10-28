<?php
/**
 *
 * @package Brewsite
 * -- Contact Template
 * 
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header text-center">
        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
        
    </header>
    
    <div class="entry-content clearfix">
        <div class="container">
		
            <?php the_content(); ?>
            
        </div>
		
    </div><!-- .entry-content -->
    
</article>