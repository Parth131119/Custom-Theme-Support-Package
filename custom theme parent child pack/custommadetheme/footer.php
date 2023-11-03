<?php
/**
 * Footer For Custom Theme.
 */
$custom_options = get_option( 'custom_theme_options' );
?>

<footer>
  <div class="container webpage-container">
    <div class="row">
      <div class="col-sm-4 col-md-4 column-footer">
        <div class="bottum_hr">
          <?php if ( is_active_sidebar( 'footer-1' ) ) {  dynamic_sidebar( 'footer-1' ); } ?>
        </div>
      </div>
      <div class="col-sm-4 col-md-4 column-footer">
        <div class="bottum_hr">
          <?php if ( is_active_sidebar( 'footer-2' ) ) {  dynamic_sidebar( 'footer-2' ); } ?>
        </div>
      </div>
      <div class="col-sm-4 col-md-4 column-footer">
        <div class="bottum_hr">
          <?php if ( is_active_sidebar( 'footer-3' ) ) {  dynamic_sidebar( 'footer-3' ); } ?>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-6 col-md-9 ">
        <?php if(!empty($custom_options['footertext'])) {
			 	echo esc_attr($custom_options['footertext']).' '; 
			  }
			?>
        <span class='foot_txt text-left'>
        <?php _e('Powered by','custom'); ?>
        <a href='http://wordpress.org' target='_blank'>
        <?php _e('WordPress','custom'); ?>
        </a>
        <?php _e('and','custom'); ?>
        <a href='http://customthemes.com/wordpress-themes/custom' target='_blank'>  
        <?php _e('Custom','custom'); ?>
        </a> </span> </div>
      <div class="col-sm-6 col-md-3 ">
        <ul>
          <?php if(!empty($custom_options['facebook'])) { ?>
          <li><a href="<?php echo esc_url($custom_options['facebook']);?>"><i class="fa fa-facebook facebook-hover"></i></a></li>
          <?php } ?>
          <?php if(!empty($custom_options['twitter'])) { ?>
          <li><a href="<?php echo esc_url($custom_options['twitter']);?>"><i class="fa fa-twitter twitter-hover"></i></a></li>
          <?php } ?>
          <?php if(!empty($custom_options['googleplus'])) { ?>
          <li><a href="<?php echo esc_url($custom_options['googleplus']);?>"><i class="fa fa-google-plus googleplus-hover"></i></a></li>
          <?php } ?>
          <?php if(!empty($custom_options['linkedin'])) { ?>
          <li><a href="<?php echo esc_url($custom_options['linkedin']);?>"><i class="fa fa-linkedin linkedin-hover"></i> </a></li>
          <?php } ?>
        </ul>
      </div>
    </div>
  </div>
</footer>
<?php wp_footer(); ?>
</body></html>