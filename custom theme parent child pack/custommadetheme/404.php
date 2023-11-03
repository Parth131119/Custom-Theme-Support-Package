<?php 
/**
 * 404 Template File.
**/
get_header(); 
?>
<div class="container webpage-container">
    <div class="col-md-12 no-padding">
            <div class="jumbotron">
            	 <h1><?php _e('Epic 404 - Article Not Found','custom') ?></h1>
            	<p><?php _e('This is embarrassing. We could not find what you were looking for.','custom') ?></p>
				<section class="post_content">
                <p><?php _e('Whatever you were looking for was not found, but maybe try looking again or search using the form below.','custom') ?></p>
                <div class="row">
                    <div class="col-sm-12">
                    <div class="search-form-404"><?php echo get_search_form(); ?></div>							
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<?php get_footer(); ?>
    