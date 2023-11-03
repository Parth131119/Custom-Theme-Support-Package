<?php 
/*
 * Archive Template File.
 */
get_header(); ?>
<section>	
    <div class="custom_menu_bg">
    	<div class="webpage-container container">
       	<div class="custom_menu">
     	<h1><?php  if ( have_posts() ) : _e('Archives','custom'); echo " : ". get_the_date('M-Y');  endif;?></h1>
	    <div class="breadcrumb site-breadcumb">
			<?php if (function_exists('custom_custom_breadcrumbs')) custom_custom_breadcrumbs(); ?>
        </div>
       </div>
   	</div>
  </div>
    <div class="container webpage-container">
    	<article class="blog-article">        
            <div class="col-md-9 col-sm-8 blog-page">
		  <?php while ( have_posts() ) : the_post(); ?>
          <?php $custom_image = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) ); ?>
                <div class="blog">                
		 			
                    <div class="blog-data">
                        <div class="blog-date text-center">
                            <h2 class="color_txt"> <?php echo get_the_date('d'); ?></h2>
                            <h3><?php echo get_the_date('M'); ?></h3>
                        </div>
                        
                        <div class="blog-info">
                            <a href="<?php echo esc_url(get_permalink()); ?>" class="heading"><?php the_title(); ?></a>
                            <div class="breadcrumb blog-breadcumb">
                               <?php custom_entry_meta(); ?>   
                            </div>
                        </div>
                        
                        <?php if(!empty($custom_image)) { ?>
						<div class="blog-rightsidebar-img">
							<img src="<?php echo  esc_url($custom_image); ?>" class="img-responsive" alt="<?php the_title(); ?>" />
						</div>
                         <?php } ?>
                        
                        <div class="blog-content">
                            <?php the_excerpt(); ?>
                        </div>
                    </div>
                </div>	
     <?php endwhile; ?> 
        <?php   if (function_exists('faster_pagination') ) {?>
            <?php faster_pagination('','1');?>
        <?php }else { ?>
        <?php if(get_option('posts_per_page ') < $wp_query->found_posts) { ?>
        <div class="col-md-12 custom-default-pagination">
            <span class="custom-previous-link"><?php previous_posts_link(); ?></span>
            <span class="custom-next-link"><?php next_posts_link(); ?></span>
        </div>
        <?php } ?>
        <?php } ?>
            </div>
            <?php get_sidebar(); ?>
    	</article>
    </div>
</section>
<?php get_footer(); ?>
