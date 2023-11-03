<?php 
/*
 * Single Post Template File.
 */
get_header(); ?>
<section>	
    <div class="custom_menu_bg">
    	<div class="webpage-container container">
        	<div class="custom_menu">
        	<h1><?php the_title(); ?></h1>
            <div class="breadcrumb site-breadcumb">
				<?php if (function_exists('custom_custom_breadcrumbs')) custom_custom_breadcrumbs(); ?>
            </div>
            </div>
    	</div>
    </div>
    <div class="container webpage-container">
    	<article class="blog-article">        
				<div id="post-<?php the_ID(); ?>" <?php post_class("col-md-9 col-sm-8 blog-page"); ?>> 
      <?php while ( have_posts() ) : the_post(); ?>
      <?php $custom_image = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) ); ?>
                <div class="blog">                
                    
                    <div class="blog-data">
                        <div class="blog-date text-center">
                            <h2 class="color_txt"> <?php echo get_the_date('d'); ?></h2>
                            <h3><?php echo get_the_date('M'); ?></h3>
                        </div>
                        <div class="blog-info">
                            <h2><?php the_title(); ?></h2>
                            <div class="breadcrumb blog-breadcumb">
                               <?php custom_entry_meta(); ?>   
                            </div>
                        </div>
                        <div class="blog-rightsidebar-img">
					<?php if(!empty($custom_image)) { ?><img src="<?php echo esc_url($custom_image); ?>" class="img-responsive" alt="<?php the_title(); ?>" /><?php } ?>
                    </div>
                        <div class="blog-content">
                            <?php the_content();
								wp_link_pages( array(
                                'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'custom' ) . '</span>',
                                'after'       => '</div>',
                                'link_before' => '<span>',
                                'link_after'  => '</span>',
                            ) );
                             ?> 
                        </div>
                    </div>
                </div> 
          <?php endwhile; ?>  
          <div class="col-md-12 custom-default-pagination">
      		<span class="custom-previous-link"><?php previous_post_link(); ?></span>
            <span class="custom-next-link"><?php next_post_link(); ?></span>
          </div>     
                <div class="comments">
					 <?php  comments_template( '', true ); ?>
                </div>              
            </div>
                 <?php get_sidebar(); ?>       
    	</article>
    </div>
</section>
<?php get_footer(); ?>
