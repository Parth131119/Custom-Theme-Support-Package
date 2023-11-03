<?php
function custom_options_init(){
 register_setting( 'custom_options', 'custom_theme_options','custom_options_validate');
} 
add_action( 'admin_init', 'custom_options_init' );
function custom_options_validate($input)
{
	 $input['logo'] = custom_image_validation(esc_url_raw( $input['logo']));
	 $input['favicon'] = custom_image_validation(esc_url_raw( $input['favicon']));
	 $input['footertext'] = sanitize_text_field( $input['footertext'] );
	 	
	 $input['facebook'] = esc_url_raw( $input['facebook'] );
	 $input['twitter'] = esc_url_raw( $input['twitter'] );
	 $input['pinterest'] = esc_url_raw( $input['pinterest'] );
	 $input['googleplus'] = esc_url_raw( $input['googleplus'] );
	 $input['rss'] = esc_url_raw( $input['rss'] );
	 $input['linkedin'] = esc_url_raw( $input['linkedin'] );

	for($custom_i=1; $custom_i <=5 ;$custom_i++ ):
	 $input['slider-img-'.$custom_i] = custom_image_validation(esc_url( $input['slider-img-'.$custom_i]));
	 $input['slidelink-'.$custom_i] = esc_url( $input['slidelink-'.$custom_i]);
	 endfor;
	 
	 $input['home-title'] = sanitize_text_field( $input['home-title'] );
	 $input['home-content'] = sanitize_text_field( $input['home-content'] );
	 
	 for($custom_section_i=1; $custom_section_i <=4 ;$custom_section_i++ ):
	 $input['home-icon-'.$custom_section_i] = custom_image_validation(esc_url_raw( $input['home-icon-'.$custom_section_i]));
	 $input['section-title-'.$custom_section_i] = sanitize_text_field($input['section-title-'.$custom_section_i]);
	 $input['section-content-'.$custom_section_i] = sanitize_text_field($input['section-content-'.$custom_section_i]);
	 endfor;
	 
	 
    return $input;
}
function custom_image_validation($custom_imge_url){
	$custom_filetype = wp_check_filetype($custom_imge_url);
	$custom_supported_image = array('gif','jpg','jpeg','png','ico');
	if (in_array($custom_filetype['ext'], $custom_supported_image)) {
		return $custom_imge_url;
	} else {
	return '';
	}
}
function custom_framework_load_scripts(){
	wp_enqueue_media();
	wp_enqueue_style( 'custom_framework', get_template_directory_uri(). '/theme-options/css/customthemes_framework.css' ,false, '1.0.0');
	// Enqueue custom option panel JS
	wp_enqueue_script( 'options-custom', get_template_directory_uri(). '/theme-options/js/customthemes-custom.js', array( 'jquery' ) );
	wp_enqueue_script( 'media-uploader', get_template_directory_uri(). '/theme-options/js/media-uploader.js', array( 'jquery') );		
}
add_action( 'admin_enqueue_scripts', 'custom_framework_load_scripts' );
function custom_framework_menu_settings() {
	$custom_menu = array(
				'page_title' => __( 'CustomThemes Options', 'custom_framework'),
				'menu_title' => __('Theme Options', 'custom_framework'),
				'capability' => 'edit_theme_options',
				'menu_slug' => 'custom_framework',
				'callback' => 'custom_framework_page'
				);
	return apply_filters( 'customthemes_framework_menu', $custom_menu );
}
add_action( 'admin_menu', 'custom_options_add_page' ); 
function custom_options_add_page() {
	$custom_menu = custom_framework_menu_settings();
   	add_theme_page($custom_menu['page_title'],$custom_menu['menu_title'],$custom_menu['capability'],$custom_menu['menu_slug'],$custom_menu['callback']);
} 
function custom_framework_page(){ 
		global $select_options; 
		if ( ! isset( $_REQUEST['settings-updated'] ) ) 
		$_REQUEST['settings-updated'] = false;		

?>
<div class="customthemes-themes">
	<form method="post" action="options.php" id="form-option" class="theme_option_ft">
  <div class="customthemes-header">
    <div class="logo">
      <?php
		$custom_image=get_template_directory_uri().'/theme-options/images/logo.png';
		echo "<img src='".$custom_image."' alt='Custom Theme' />";
		?>
    </div>
    <div class="header-right">
		<h1> <?php _e( 'Custom Theme Options', 'custom' ) ?> </h1>
		<div class='btn-save'><input type='submit' class='button-primary' value='<?php _e('Save Options','custom') ?>' /></div>
    </div>
  </div>
  <div class="customthemes-details">
    <div class="customthemes-options">
      <div class="right-box">
        <div class="nav-tab-wrapper">
          <ul>
            <li><a id="options-group-1-tab" class="nav-tab basicsettings-tab" title="<?php _e('Basic Settings','custom'); ?>" href="#options-group-1"><?php _e('Basic Settings','custom'); ?></a></li>
            <li><a id="options-group-3-tab" class="nav-tab socialsettings-tab" title="<?php _e('Social Settings','custom'); ?>" href="#options-group-3"><?php _e('Social Settings','custom'); ?></a></li>
            <li><a id="options-group-2-tab" class="nav-tab homepagesettings-tab" title="<?php _e('Home page Settings','custom'); ?>" href="#options-group-2"> <?php _e('Home page Settings','custom'); ?></a></li>           
  		  </ul>
        </div>
      </div>
      <div class="right-box-bg"></div>
      <div class="postbox left-box"> 
        <!--======================== F I N A L - - T H E M E - - O P T I O N ===================-->
          <?php settings_fields( 'custom_options' );  
		$custom_options = get_option( 'custom_theme_options' );
		 ?>
        
            <!-------------- Header group ----------------->
          <div id="options-group-1" class="group faster-inner-tabs">   
          	<div class="section theme-tabs theme-logo">
            <a class="heading faster-inner-tab active" href="javascript:void(0)"><?php _e('Site Logo','custom'); ?></a>
            <div class="faster-inner-tab-group active">
              	<div class="ft-control">
                <input id="logo-img" class="upload" type="text" name="custom_theme_options[logo]" 
                            value="<?php if(!empty($custom_options['logo'])) { echo esc_url($custom_options['logo']); } ?>" placeholder="<?php _e('No file chosen','custom'); ?>" />
                <input id="upload_image_button" class="upload-button button" type="button" value="<?php _e('Upload','custom'); ?>" />
                <div class="screenshot" id="logo-image">
                  <?php if(!empty($custom_options['logo'])) { echo "<img src='".esc_url($custom_options['logo'])."' />
					  <a class='remove-image'></a>"; } ?>
                </div>
              </div>
            </div>
          </div>
            <div class="section theme-tabs theme-favicon">
              <a class="heading faster-inner-tab" href="javascript:void(0)"><?php _e('Favicon','custom'); ?></a>
              <div class="faster-inner-tab-group">
              	<div class="explain"><?php _e('Size of favicon should be exactly 32x32px for best results.','custom'); ?></div>
                <div class="ft-control">
                  <input id="favicon-img" class="upload" type="text" name="custom_theme_options[favicon]" 
                            value="<?php if(!empty($custom_options['favicon'])) { echo esc_url($custom_options['favicon']); } ?>" placeholder="<?php _e('No file chosen','custom'); ?>" />
                  <input id="upload_image_button1" class="upload-button button" type="button" value="<?php _e('Upload','custom'); ?>" />
                  <div class="screenshot" id="favicon-image">
                    <?php  if(!empty($custom_options['favicon'])) { echo "<img src='".esc_url($custom_options['favicon'])."' /><a class='remove-image'></a>"; } ?>
                  </div>
                </div>
              </div>
            </div>     
            <div id="section-footertext" class="section theme-tabs">
            	<a class="heading faster-inner-tab" href="javascript:void(0)"><?php _e('Copyright Text','custom'); ?></a>
              <div class="faster-inner-tab-group">
              	<div class="ft-control">
              		<div class="explain"><?php _e('Some text regarding copyright of your site, you would like to display in the footer.','custom'); ?></div>                
                  	<input type="text" id="footertext" class="of-input" name="custom_theme_options[footertext]" size="32"  value="<?php if(!empty($custom_options['footertext'])) { echo esc_attr($custom_options['footertext']); } ?>">
                </div>                
              </div>
            </div>
          </div>    
            
                   
          
          <!-- HOME PAGE -->
<div id="options-group-2" class="group faster-inner-tabs">  
	
	
	<h3><?php _e('Banner Slider','custom'); ?></h3>
            <?php for($custom_i=1; $custom_i <= 5 ;$custom_i++ ):?>
            <div class="section theme-tabs theme-slider-img"> <a class="heading faster-inner-tab" href="javascript:void(0)"><?php _e('Slider','custom');?> <?php echo $custom_i;?></a>
              <div class="faster-inner-tab-group">
                <div class="ft-control">
                  <input id="slider-img-<?php echo $custom_i;?>" class="upload" type="text" name="custom_theme_options[slider-img-<?php echo $custom_i;?>]" 
                            value="<?php if(!empty($custom_options['slider-img-'.$custom_i])) { echo esc_url($custom_options['slider-img-'.$custom_i]); } ?>" placeholder="<?php _e('No file chosen','placeholder'); ?>" />
                  <input id="1upload_image_button" class="upload-button button" type="button" value="<?php _e('Upload','custom'); ?>" />
                  <div class="screenshot" id="slider-img-<?php echo $custom_i;?>">
                    <?php if(!empty($custom_options['slider-img-'.$custom_i])) { echo "<img src='".esc_url($custom_options['slider-img-'.$custom_i])."' /><a class='remove-image'></a>"; } ?>
                  </div>
                </div>
                <div class="ft-control">
                  <input type="text" placeholder="<?php _e('Slide','custom');?><?php echo $custom_i; ?> <?php _e('Link','custom'); ?>" id="slidelink-<?php echo $custom_i;?>" class="of-input" name="custom_theme_options[slidelink-<?php echo $custom_i;?>]" size="32"  value="<?php if(!empty($custom_options['slidelink-'.$custom_i])) { echo esc_url($custom_options['slidelink-'.$custom_i]); } ?>">
                </div>
              </div>
            </div>
            <?php endfor; ?>
	
	
	
	<h3><?php _e('Title Bar','custom'); ?></h3>	
	<div id="section-title" class="section theme-tabs"> <a class="heading faster-inner-tab" href="javascript:void(0)"><?php _e('Title','custom'); ?></a>
              <div class="faster-inner-tab-group">
                <div class="ft-control">
                  <div class="explain"><?php _e('Enter home page title for your site , you would like to display in the Home Page.','custom'); ?></div>
                  <input id="title" class="of-input" name="custom_theme_options[home-title]" type="text" size="50" value="<?php if(!empty($custom_options['home-title'])) { echo esc_attr($custom_options['home-title']); } ?>" />
                </div>
              </div>
            </div>
            <div class="section theme-tabs theme-short_description"> <a class="heading faster-inner-tab" href="javascript:void(0)"><?php _e('Short Description','custom'); ?></a>
              <div class="faster-inner-tab-group">
                <div class="ft-control">
                  <div class="explain"><?php _e('Enter home content for your site , you would like to display in the Home Page.','custom'); ?></div>
                  <textarea name="custom_theme_options[home-content]" rows="6" id="home-content1" class="of-input"><?php if(!empty($custom_options['home-content'])) { echo esc_attr($custom_options['home-content']); } ?></textarea>
                </div>
              </div>
            </div>


   <h3><?php _e('First Section','custom'); ?></h3>
            <?php for($custom_section_i=1; $custom_section_i <=4 ;$custom_section_i++ ): ?>
            <div class="section theme-tabs theme-slider-img"> <a class="heading faster-inner-tab" href="javascript:void(0)"><?php _e('Tab','custom'); ?> <?php echo $custom_section_i; ?></a>
              <div class="faster-inner-tab-group">
                <div class="ft-control">
                  <input id="first-image-<?php echo $custom_section_i;?>" class="upload" type="text" name="custom_theme_options[home-icon-<?php echo $custom_section_i;?>]" 
                            value="<?php if(!empty($custom_options['home-icon-'.$custom_section_i])) { echo esc_url($custom_options['home-icon-'.$custom_section_i]); } ?>" placeholder="<?php _e('No file chosen','custom'); ?>" />
                  <input id="upload_image_button" class="upload-button button" type="button" value="<?php _e('Upload','custom'); ?>" />
                  <div class="screenshot" id="first-img-<?php echo $custom_section_i;?>">
                    <?php if(!empty($custom_options['home-icon-'.$custom_section_i])) { echo "<img src='".esc_url($custom_options['home-icon-'.$custom_section_i])."' /><a class='remove-image'></a>"; } ?>
                  </div>
                </div>
                <div class="ft-control">
                  <div class="explain"><?php _e('Enter secion title for your home template , you would like to display in the Home Page.','custom'); ?></div>
                  <input type="text" placeholder="<?php _e('Enter title here','custom'); ?>" id="title-<?php echo $custom_section_i;?>" class="of-input" name="custom_theme_options[section-title-<?php echo $custom_section_i;?>]" size="32"  value="<?php if(!empty($custom_options['section-title-'.$custom_section_i])) { echo esc_attr($custom_options['section-title-'.$custom_section_i]); } ?>">
                </div>
                <div class="ft-control">
                  <div class="explain"><?php _e('Enter secion post for your home template , you would like to display in the Home Page.','custom'); ?></div>
                  <input type="text" placeholder="<?php _e('Enter post here','custom'); ?>" id="post-<?php echo $custom_section_i;?>" class="of-input" name="custom_theme_options[section-post-<?php echo $custom_section_i;?>]" size="32"  value="<?php if(!empty($custom_options['section-post-'.$custom_section_i])) { echo esc_attr($custom_options['section-post-'.$custom_section_i]); } ?>">
                </div>
                <div class="ft-control">
                  <div class="explain"><?php _e('Enter section content for home template , you would like to display in the Home Page.','custom');?></div>
                  <textarea name="custom_theme_options[section-content-<?php echo $custom_section_i; ?>]" rows="6" id="content-<?php echo $custom_section_i; ?>" placeholder="<?php _e('Enter Content here','custom'); ?>" class="of-input"><?php if(!empty($custom_options['section-content-'.$custom_section_i])) { echo esc_attr($custom_options['section-content-'.$custom_section_i]); } ?></textarea>
                </div>
              </div>
            </div>
            <?php endfor; ?>

            <h3><?php _e('Second Section','custom'); ?></h3>
            <div id="section-recent-title" class="section theme-tabs"> <a class="heading faster-inner-tab" href="javascript:void(0)"><?php _e('Category post title','custom'); ?></a>
              <div class="faster-inner-tab-group">
                <div class="ft-control">
                  <div class="explain"><?php _e('Enter category post title for your site , you would like to display in the Home Page.','custom'); ?></div>
                  <input id="post" class="of-input" name="custom_theme_options[post-title]" type="text" size="50" value="<?php if(!empty($custom_options['post-title'])) { echo esc_attr($custom_options['post-title']); } ?>" />
                </div>
              </div>
            </div>
            <div class="section theme-tabs theme-short_description"> <a class="heading faster-inner-tab" href="javascript:void(0)"><?php _e('Category','custom'); ?></a>
              <div class="faster-inner-tab-group">
                <div class="ft-control">
                  <select name="custom_theme_options[post-category]" id="category">
                    <option value=""><?php echo esc_attr(__('Select Category','custom')); ?></option>
                    <?php 
				$custom_args = array(
				'meta_query' => array(
									array(
									'key' => '_thumbnail_id',
									'compare' => 'EXISTS'
										),
									)
								);  
				$custom_post = new WP_Query( $custom_args );
				$custom_cat_id=array();
				while($custom_post->have_posts()){
				$custom_post->the_post();
				$custom_post_categories = wp_get_post_categories( get_the_id());   
				$custom_cat_id[]=$custom_post_categories[0];
				}
				$custom_cat_id=array_unique($custom_cat_id);
				$custom_args = array(
				'orderby' => 'name',
				'parent' => 0,
				'include'=>$custom_cat_id
				);
				
				$custom_categories = get_categories($custom_args); 
			
                  foreach ($custom_categories as $custom_category) {
					  if($custom_category->term_id == $custom_options['post-category'])
					  	$custom_selected="selected=selected";
					  else
					  	$custom_selected='';
                    $custom_option = '<option value="'.$custom_category->term_id .'" '.$custom_selected.'>'; 
                    $custom_option .= $custom_category->cat_name;
                    $custom_option .= '</option>';
                    echo $custom_option;
                  }
                 ?>
                  </select>
                </div>
              </div>
            </div>
            
            <h3><?php _e('Third Section','custom'); ?></h3>
            <div id="section-latespost-title" class="section theme-tabs"> <a class="heading faster-inner-tab" href="javascript:void(0)"><?php _e('Latest Post Title','custom'); ?></a>
              <div class="faster-inner-tab-group">
                <div class="ft-control">
                  <div class="explain"><?php _e('Enter Latest post title for your site , you would like to display in the Home Page.','custom');?></div>
                  <input id="post" class="of-input" name="custom_theme_options[latestpost-title]" type="text" size="50" value="<?php if(!empty($custom_options['latestpost-title'])) { echo esc_attr($custom_options['latestpost-title']); } ?>" />
                </div>
              </div>
            </div>
          
          
</div>             
          <!-- END HOME PAGE -->
          
          <!-------------- Social group ----------------->
          <div id="options-group-3" class="group faster-inner-tabs">            
            <div id="section-facebook" class="section theme-tabs">
            	<a class="heading faster-inner-tab active" href="javascript:void(0)"><?php _e('Facebook','custom'); ?></a>
              <div class="faster-inner-tab-group active">
              	<div class="ft-control">
              		<div class="explain"><?php _e('Facebook profile or page URL i.e. ','custom'); ?> http://facebook.com/username/ </div>                
                  	<input id="facebook" class="of-input" name="custom_theme_options[facebook]" size="30" type="text" value="<?php if(!empty($custom_options['facebook'])) { echo esc_url($custom_options['facebook']); } ?>" />
                </div>                
              </div>
            </div>
            <div id="section-twitter" class="section theme-tabs">
            	<a class="heading faster-inner-tab" href="javascript:void(0)"><?php _e('Twitter','custom'); ?></a>
              <div class="faster-inner-tab-group">
              	<div class="ft-control">
              		<div class="explain"><?php _e('Twitter profile or page URL i.e. ','custom'); ?>http://www.twitter.com/username/</div>                
                  	<input id="twitter" class="of-input" name="custom_theme_options[twitter]" type="text" size="30" value="<?php if(!empty($custom_options['twitter'])) { echo esc_url($custom_options['twitter']); } ?>" />
                </div>                
              </div>
            </div>
            <div id="section-pinterest" class="section theme-tabs">
            	<a class="heading faster-inner-tab" href="javascript:void(0)"><?php _e('Pinterest','custom'); ?></a>
              <div class="faster-inner-tab-group">
              	<div class="ft-control">
              		<div class="explain"><?php _e('Pinterest profile or page URL i.e. ','custom'); ?>https://pinterest.com/username/</div>                
                  	 <input id="pinterest" class="of-input" name="custom_theme_options[pinterest]" type="text" size="30" value="<?php if(!empty($custom_options['pinterest'])) { echo esc_url($custom_options['pinterest']); } ?>" />
                </div>                
              </div>
            </div>
			<div id="section-googleplus" class="section theme-tabs">
            	<a class="heading faster-inner-tab" href="javascript:void(0)"><?php _e('Google plus','custom'); ?></a>
              <div class="faster-inner-tab-group">
              	<div class="ft-control">
              		<div class="explain"><?php _e('Google plus profile or page URL i.e.','custom'); ?> https://googleplus.com/username/</div>                
                  	 <input id="googleplus" class="of-input" name="custom_theme_options[googleplus]" type="text" size="30" value="<?php if(!empty($custom_options['googleplus'])) { echo esc_url($custom_options['googleplus']); } ?>" />
                </div>                
              </div>
            </div>
            <div id="section-rss" class="section theme-tabs">
            	<a class="heading faster-inner-tab" href="javascript:void(0)"><?php _e('RSS','custom'); ?></a>
              <div class="faster-inner-tab-group">
              	<div class="ft-control">
              		<div class="explain"><?php _e('RSS profile or page URL i.e.','custom'); ?> https://www.rss.com/username/</div>                
                  	<input id="rss" class="of-input" name="custom_theme_options[rss]" type="text" size="30" value="<?php if(!empty($custom_options['rss'])) { echo esc_url($custom_options['rss']); } ?>" />
                </div>                
              </div>
            </div>
            <div id="section-linkedin" class="section theme-tabs">
            	<a class="heading faster-inner-tab" href="javascript:void(0)"><?php _e('Linkedin','custom'); ?></a>
              <div class="faster-inner-tab-group">
              	<div class="ft-control">
              		<div class="explain"><?php _e('Linkedin profile or page URL i.e.','custom');?>https://www.linkedin.com/username/</div>                
                  	<input id="rss" class="of-input" name="custom_theme_options[linkedin]" type="text" size="30" value="<?php if(!empty($custom_options['linkedin'])) { echo esc_url($custom_options['linkedin']); } ?>" />
                </div>                
              </div>
            </div>
          </div>
          <!-------------- Social group ----------------->          
        
        <!--======================== F I N A L - - T H E M E - - O P T I O N S ===================--> 
      </div>
     </div>
	</div>
	<div class="customthemes-footer">
      	<ul>
            <li class="btn-save"><input type="submit" class="button-primary" value="<?php _e('Save Options','custom'); ?>" /></li>
        </ul>
    </div>
    </form>    
</div>
<div class="save-options"><h2><?php _e('Options saved successfully.','custom'); ?></h2></div>


<?php } ?>
