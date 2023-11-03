<?php
/*
 * custom Breadcrumbs
*/
function custom_custom_breadcrumbs() { 

  $custom_showonhome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
  $custom_delimiter = '/'; // laurels_delimiter between crumbs
  $custom_home = __('Home','custom'); // text for the 'Home' link
  $custom_showcurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
  $custom_before = ' '; // tag before the current crumb
  $custom_after = ' '; // tag after the current crumb

  global $post;
  $custom_homelink = esc_url(home_url());

  if (is_home() || is_front_page()) {

    if ($custom_showonhome == 1) echo '<div id="crumbs" class="custom-breadcrumb"><a href="' . esc_url($custom_homelink) . '">' . $custom_home . '</a></div>';

  } else {

    echo '<div id="crumbs" class="custom-breadcrumb"><a href="' . esc_url($custom_homelink) . '">' . $custom_home . '</a> ' . $custom_delimiter . ' ';

    if ( is_category() ) {
      $custom_thisCat = get_category(get_query_var('cat'), false);
      if ($custom_thisCat->parent != 0) echo get_category_parents($custom_thisCat->parent, TRUE, ' ' . $custom_delimiter . ' ');
      echo $custom_before . _e('Archive by category','custom') .'"'. single_cat_title('', false) . '"' . $custom_after;

    } elseif ( is_search() ) {
      echo $custom_before . _e('Search results for','custom').' "' . get_search_query() . '"' . $custom_after;

    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $custom_delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $custom_delimiter . ' ';
      echo $custom_before . get_the_time('d') . $custom_after;

    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $custom_delimiter . ' ';
      echo $custom_before . get_the_time('F') . $custom_after;

    } elseif ( is_year() ) {
      echo $custom_before . get_the_time('Y') . $custom_after;

    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $custom_post_type = get_post_type_object(get_post_type());
        $custom_slug = $custom_post_type->rewrite;
        echo '<a href="' . $custom_homelink . '/' . $custom_slug['slug'] . '/">' . $custom_post_type->labels->singular_name . '</a>';
        if ($custom_showcurrent == 1) echo ' ' . $custom_delimiter . ' ' . $custom_before . get_the_title() . $custom_after;
      } else {
        $custom_cat = get_the_category(); $custom_cat = $custom_cat[0];
        $custom_cats = get_category_parents($custom_cat, TRUE, ' ' . $custom_delimiter . ' ');
        if ($custom_showcurrent == 0) $custom_cats = preg_replace("#^(.+)\s$custom_delimiter\s$#", "$1", $custom_cats);
        echo $custom_cats;
        if ($custom_showcurrent == 1) echo $custom_before . get_the_title() . $custom_after;
      }

    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      $custom_post_type = get_post_type_object(get_post_type());
      echo $custom_before . $custom_post_type->labels->singular_name . $custom_after;

    } elseif ( is_attachment() ) {
      $custom_parent = get_post($post->post_parent);
      $custom_cat = get_the_category($custom_parent->ID); $custom_cat = $custom_cat[0];
      echo get_category_parents($custom_cat, TRUE, ' ' . $custom_delimiter . ' ');
      echo '<a href="' . esc_url(get_permalink($custom_parent)) . '">' . $custom_parent->post_title . '</a>';
      if ($custom_showcurrent == 1) echo ' ' . $custom_delimiter . ' ' . $custom_before . get_the_title() . $custom_after;

    } elseif ( is_page() && !$post->post_parent ) {
      if ($custom_showcurrent == 1) echo $custom_before . get_the_title() . $custom_after;

    } elseif ( is_page() && $post->post_parent ) {
      $custom_parent_id  = $post->post_parent;
      $custom_breadcrumbs = array();
      while ($custom_parent_id) {
        $custom_page = get_page($custom_parent_id);
        $custom_breadcrumbs[] = '<a href="' . esc_url(get_permalink($custom_page->ID)) . '">' . get_the_title($custom_page->ID) . '</a>';
        $custom_parent_id  = $custom_page->post_parent;
      }
      $custom_breadcrumbs = array_reverse($custom_breadcrumbs);
      for ($i = 0; $i < count($custom_breadcrumbs); $i++) {
        echo $custom_breadcrumbs[$i];
        if ($i != count($custom_breadcrumbs)-1) echo ' ' . $custom_delimiter . ' ';
      }
      if ($custom_showcurrent == 1) echo ' ' . $custom_delimiter . ' ' . $custom_before . get_the_title() . $custom_after;

    } elseif ( is_tag() ) {
      echo $custom_before . _e('Posts tagged','custom') .' "' . single_tag_title('', false) . '"' . $custom_after;

    } elseif ( is_author() ) {
       global $author;
      $custom_userdata = get_userdata($author);
      echo $custom_before . _e('Articles posted by','custom') . $custom_userdata->display_name . $custom_after;

    } elseif ( is_404() ) {
      echo $custom_before . _e('Error 404','custom') . $custom_after;
    }

    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page','custom') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }

    echo '</div>';

  }
} // end laurels_custom_breadcrumbs()
