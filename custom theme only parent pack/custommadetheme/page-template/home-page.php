<?php 
/*
 * Template Name: Home Page 
 */
get_header();
$custom_options = get_option( 'custom_theme_options' ); ?>

<section>
	
  <?php if ( have_posts() ) : ?>
			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>    
        	
    <div class="container webpage-container inner-content normal_content">
        <div class="header_line col-md-12 no-padding">
                     <h1 class="home_ttl upper clearfix home_back_img woo_ttl"><?php the_title(); ?></h1>
        </div>
       <div class="content-section cont_bot">
    	    <?php the_content(); ?>  
        </div>    
    </div>
    
    <?php endwhile; ?>
		<?php endif; ?>
    
</section>  
<?php get_footer(); ?>
