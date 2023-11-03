<?php
/*
 * Header For Custom Theme.
 */
$custom_options = get_option('custom_theme_options');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width">
<title>
<?php wp_title('|', true, 'right'); ?>
</title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
<?php if (!empty($custom_options['favicon'])) { ?>
<link rel="shortcut icon" href="<?php echo esc_url($custom_options['favicon']); ?>">
<?php } ?>
<?php wp_head(); ?>
</head>
<body>